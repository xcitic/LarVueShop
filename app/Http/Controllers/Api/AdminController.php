<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

      return response('Unauthorized', 401);

    }
}
