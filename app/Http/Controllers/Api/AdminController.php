<?php

namespace App\Http\Controllers\Api;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __constructor(Request $request) {
      if ($request->user()->isAdmin() !== 'admin')
      {
        abort('Unauthorized', 401);
      }

      $this->user = $request->user();
    }

    public function dashboard(Request $request) {
      $user = $this->user;

      if ($user->isAdmin())
      {
        $users = App\User::get()->toArray();

        $products = App\Product::get()->toArray();

        $orders = App\Order::get()->toArray();

        $payments = App\Payment::get()->toArray();

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
