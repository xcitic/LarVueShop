<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

  public function getOrders(Request $request) {
    $user = $request->user();

    if ($user) {

      $orders = $user->orders;
      $payments = [];
      foreach ($orders as $order) {
        $payment = $order->payment;
        array_push($payments, $payment);
      }
      $response = [
        'orders' => $orders,
        'payments' => $payments
      ];

      return response($response, 200);
    }

    return response('Unauthorized', 401);

  }

  public function updateUser(Request $request) {
    $user = $request->user();

    if($user) {
      // validate data
      // update new data
      // save
      // return object
    }

  }


}
