<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{


    public function __constructor(Request $request) {

      if ($request->user()->role !== 'admin')
      {
        abort('Unauthorized', 401);
      }

    }

    public function dashboard(Request $request) {
      $role = $request->user()->role;


      if ($role === 'admin')
      {

        $users = \App\User::get();

        $products = \App\Product::get();

        $orders = \App\Order::get();

        $payments = \App\Payment::get();

        $response = [
          'users' => $users,
          'products' => $products,
          'orders' => $orders,
          'payments' => $payments,
        ];

        return response($response, 200);
      }
      // default response
      return response('Unauthorized', 401);

    }

    public function createProduct(Request $request) {

      $role = $request->user()->role;

      if ($role === 'admin')
      {
        $validator = Validator::make($request->all(), [
          'title'       => 'required|string|max:255',
          'description' => 'required|string|max:650',
          'slug'        => 'required|string|max:150',
          'price'       => 'required|max:50',
          'image'       => 'required|string|max:255',
        ]);

        if ($validator->fails())
        {

          return response(['errors' => $validator->errors()->all()], 422);
        }



        try {

          $product = new \App\Product([
            'title'       => $request->title,
            'description' => $request->title,
            'slug'        => $request->slug,
            'price'       => $request->price,
            'likes'       => 0,
          ]);

          $product->save();

          return response($product, 201);
        } catch (\Exception $e) {
          return response('Error '.$e, 400);
        }

      }

      return response('Unauthorized', 401);
    }
}
