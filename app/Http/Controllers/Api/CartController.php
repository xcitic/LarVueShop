<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\CartItem;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    public function getCart(Request $request)
    {
      // Get the user making the request
      $user = $request->user();
      if ($user)
      {
        // If user has an associated cart return the cart items
        // $cart = Cart::where('user_id', $user->id)->first();
        $cart = $user->cart;
        if ($cart)
        {
          $response = $cart->items->toArray();

          return response($response, 200);
        }
        // If user does not have a cart, create one and return it.
        else
        {
          $cart = $this->createCart($user);
          $response = $cart->items->toArray();
          return response($response, 200);
        }
      }

    }



    public function addToCart(Request $request, $id, $quantity = 1)
    {
      // find the user making the request
      $user = $request->user();

      if ($user)
      {
        // $cart = Cart::where('user_id', $user->id)->first();
        $cart = $user->cart;
        // If user has no cart, create a new cart.
        if($cart === null)
        {
          $cart = $this->createCart($user);
        }

        $product = Product::find($id);

        // if no product is found with ID from frontend return error
        if($product === null)
        {
          return response('Error product not found', 406);
        }

        // Check if product already is in the cart, then increase the quantity in the cart.
        $cartItem = CartItem::where(['cart_id' => $cart->id, 'product_id' => $product->id])->first();
        if ($cartItem)
        {
          $curr_quantity = $cartItem->quantity;
          $cartItem->quantity = $curr_quantity + $quantity;
          $cartItem->update();
        }
        // If new product is added to cart create and persist it.
        else
        {
          $cartItem = new CartItem([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => $quantity
          ]);
          $cartItem->save();
        }
        $response = $cart->items->toArray();
        return response($response, 201);
      }

      // Is the user is not authenticated, return unauthorized. fail silently.
      return response('Unauthorized', 401);

    }

    // TODO
    public function removeFromCart(Request $request, $id)
    {

      $user = $request->user();
      if($user) {
        // Retrieve the user cart
        $cart = $user->cart;
        if ($cart) {
          $product = Product::find($id);
          // if no product is found with ID from frontend return error
          if($product === null)
          {
            return response('Error product not found', 406);
          }

          // locate the cart item
          $cartItem = CartItem::where(['cart_id' => $cart->id, 'product_id' => $product->id])->first();
          // remove the selected amount
          $cartItem->delete();
          $cart->update();
          $response = $cart->items->toArray();

          return response($response, 200);
        }
      }

    }

    // TODO
    public function emptyCart(Request $request, $id)
    {
      $user = $request->user();
    }

    public function createCart(User $user)
    {
      $cart = new Cart([
        'user_id' => $user->id
      ]);
      $cart->save();
      return $cart;
    }


}
