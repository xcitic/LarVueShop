<?php

namespace App\Http\Controllers\Api;


use App\Cart;
use App\CartItem;
use App\Product;
use Illuminate\Http\Request;
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

    }


    public function payment(Request $request)
    {

    }
}
