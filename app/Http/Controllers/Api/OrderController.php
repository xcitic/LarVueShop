<?php

namespace App\Http\Controllers\Api;


use App\Cart;
use App\CartItem;
use App\Product;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

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


    public function payment(Request $request)
    {

      $user = $request->user();

      if($user)
      {

      }

    }
}
