<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\CartItem;
use App\Product;
use App\Order;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentController extends Controller
{

    protected $total;

    public function guestPayment(Request $request) {

      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'country' => 'required|string|max:50',
        'address' => 'required|string|max:255',
        'zip' => 'required|string|max:25',
        'phone' => 'required|string|max:50',
        'token' => 'required|string|max:255',
      ]);

      if($validator->fails())
      {
        return response([ 'errors' => $validator->errors()->all() ], 422);
      }

      $userIp = $request->ip();

      try {
        $cart = Cart::where('user_id', $userIp)->where('status', 'active')->first();
      } catch (ModelNotFoundException $e) {
        report($e);
        return 'Could not find cart';
      }

      $items = $cart->items;
      $products = [];
      $total = 0.00;

      foreach($items as $item) {
        $product = $item->product;
        $product->quantity = $item->quantity;
        $total += $product->quantity * $product->price;
        array_push($products, $product);
      }


      try {
        $order = Order::create([
          'order_status'      => 'created',
          'shipping_address'  => $request->address . ' ' . $request->zip . ' ' . $request->country,
          'shipping_type'     => 'default',
          'total_price'       => $total,
          'contanct_person'   => $request->name,
          'contact_number'    => $request->phone,
          'user_id'           => $userIp,
          'cart_id'           => $cart->id
        ]);

        $order->save();
      } catch (ModelNotFoundException $e) {
        return $e;
      }

      $orderId = $order->id;

      // set the stripe private key
      \Stripe\Stripe::setApiKey(config('keys.stripe_token_private'));

      try {
        $charge = \Stripe\Charge::create([
          'amount'        => $total *100,
          'currency'      => 'usd',
          'description'   => 'VueShop Products',
          'source'        => $request->token,
          'capture'       => true,
        ]);
        $paymentStatus = $charge->status;
        $paymentType = $charge->object;
        $paymentToken = $charge->id;

      } catch (Exception $e) {

        return response('Payment failed, please try again', 422);

      }

      try {
        $payment = Payment::create([
          'user_id' => $userIp,
          'order_id' => $orderId,
          'type' => $paymentType,
          'token' => $paymentToken,
          'status' => $paymentStatus,
          'amount' => floatval($total),
          'charge_time' => Carbon::now(),
        ]);

        $payment->save();


        $order->payment_id = $payment->id;
        $order->order_status = 'paid';
        $order->update();

        $cart->status = 'complete';
        $cart->update();

        $payload = ['order' => $order, 'products' => $products];

        // TODO send email to user with confirmation
        return response($payload, 201);

      } catch (Exception $e) {

        return response($e, 422);

      }

      return response('Something went wrong', 422);


    }
}
