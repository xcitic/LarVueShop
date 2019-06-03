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

class OrderController extends Controller
{

    /**
     * Fetch the Product info for each Item in the Cart
     * @param  Request $request->user() to get the user by token
     * @return Array of Product(s)
     */
    public function getProducts(Request $request)
    {
      $user = $request->user();

      if($user) {
        $items = $user->cart->items;
        $orderArray = [];
        foreach($items as $item) {
          $product = $item->product;
          $product->quantity = $item->quantity;
          array_push($orderArray, $product);
        }
        return response($orderArray, 200);
      }
        return response('Unauthorized', 401);
    }


    public function createOrder(Request $request)
    {
      $user = $request->user();

      if($user)
      {
        $validator = Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255',
          'country' => 'required|string|max:50',
          'address' => 'required|string|max:255',
          'zip' => 'required|string|max:25',
          'phone' => 'required|string|max:50'
        ]);

        if($validator->fails())
        {
          return response([ 'errors' => $validator->errors()->all() ], 422);
        }

        $cart = $user->cart;

        $order = Order::create([
          'order_status'      => 'created',
          'shipping_address'  => $request->address . ' ' . $request->zip . ' ' . $request->country,
          'shipping_type'     => 'default',
          'contanct_person'   => $user->name,
          'contact_number'    => $request->phone,
          'user_id'           => $user->id,
          'cart_id'           => $cart->id
        ]);

        $order->save();

        return response($order, 200);

      }
    }

    public function guestOrder(Request $request) {
      // Validate the products received
      $validator = Validator::make($request->all(), [
        '*.id'    => 'required|integer|max:10',
        '*.price' => 'required|string|max:10',
        '*.quantity' => 'required|integer|max:10'
      ]);

      if($validator->fails()) {
        return response(['errors' => $validator->errors()->all()], 422);
      }

      $userIp = request()->ip();

      $cart = Cart::create([
        'user_id' => $userIp
      ]);
      $cart->save();

      $cartId = $cart->id;

      $products = $request->only('*.id', '*.price', '*.quantity');
      //
      $products = [
        'id' => $request->input('*.id'),
        'price' => $request->input('*.price'),
        'quantity' => $request->input('*.quantity')
      ];
      $products = $request->all();

      // return $products;
      // for($products as $product)
      for($i=0; $i < sizeOf($products); $i++) {
        // check if product id matches database
        // return $item;
        $product = $products[$i];
        $productId = $product['id'];

        try {
          $dbProduct = Product::findOrFail($productId);
        }
        catch (ModelNotFoundException $e) {
          report($e);
          return false;
        }
        // check if price matches database
        $price = $product['price'];
        try {
          $dbPrice = $dbProduct->price;
          $dbPrice === $price;
        }
         catch (ModelNotFoundException $e) {
           report($e);
           return false;
         }

         $cartItem = CartItem::create([
           'cart_id'    => $cartId,
           'product_id' => $productId,
           'quantity'   => $product['quantity']
         ]);
         $cartItem->save();
      }


      return response('success', 201);

    }


    public function payment(Request $request)
    {

      $user = $request->user();

      // TODO Change cart logic soon, to make only one cart be active at any given time.
      $cart = $user->cart;

      $items = $cart->items;

      $total = 0.00;

      foreach($items as $item)
      {
        $product = $item->product;
        $price = $product->price;
        $total += $price * $item->quantity;
      }

      if($user)
      {
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

        $cart = $user->cart;

        $order = Order::create([
          'order_status'      => 'created',
          'shipping_address'  => $request->address . ' ' . $request->zip . ' ' . $request->country,
          'shipping_type'     => 'default',
          'contanct_person'   => $user->name,
          'contact_number'    => $request->phone,
          'user_id'           => $user->id,
          'cart_id'           => $cart->id
        ]);

        $order->save();

        $order_id = $order->id;

        // set the stripe private key
        \Stripe\Stripe::setApiKey(config('keys.stripe_token_private'));

        try {
          $charge = \Stripe\Charge::create([
            'amount' => $total * 100,
            'currency' => 'usd',
            'description' => 'VueShop Products',
            'source' => $request->token,
            'capture' => true,
          ]);
          $payment_status = $charge->status;
          $payment_type = $charge->object;
          $payment_token = $charge->id;



        $payment = Payment::create([
          'user_id' => $user->id,
          'order_id' => $order_id,
          'type' => $payment_type,
          'token' => $payment_token,
          'status' => $payment_status,
          'amount' => $total,
          'charge_time' => Carbon::now(),
        ]);
        $payment->save();

        $order->payment_id = $payment->id;
        $order->order_status = 'paid';
        $order->update();

        // $response = [$order, $payment];
        $cart->status = 'complete';
        $cart->update();

        return response('success', 201);


        } catch(Exception $e) {
          return response($e, 422);
        }

      }

      return response('Unauthorized', 401);

    }


    public function paymentGuest(Request $request) {

      // Create order from the cart the user has

      // Validate the input
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

      $order = Order::create([
        'order_status'      => 'created',
        'shipping_address'  => $request->address . ' ' . $request->zip . ' ' . $request->country,
        'shipping_type'     => 'default',
        'contanct_person'   => $request->name,
        'contact_number'    => $request->phone,
        'user_id'           => $user->id,
        'cart_id'           => $cart->id
      ]);
      $order->save();

      // set the stripe private key
      \Stripe\Stripe::setApiKey(config('keys.stripe_token_private'));

      try {
        $charge = \Stripe\Charge::create([
          'amount' => $total * 100,
          'currency' => 'usd',
          'description' => 'VueShop Products',
          'source' => $request->token,
          'capture' => true,
        ]);
        $payment_status = $charge->status;
        $payment_type = $charge->object;
        $payment_token = $charge->id;



      $payment = Payment::create([
        'user_id' => $user->id,
        'order_id' => $order_id,
        'type' => $payment_type,
        'token' => $payment_token,
        'status' => $payment_status,
        'amount' => $total,
        'charge_time' => Carbon::now(),
      ]);
      $payment->save();

      $order->payment_id = $payment->id;
      $order->order_status = 'paid';
      $order->update();

      // $response = [$order, $payment];
      $cart->status = 'complete';
      $cart->update();

      return response('success', 201);


      } catch(Exception $e) {
        return response($e, 422);
      }

    }

}
