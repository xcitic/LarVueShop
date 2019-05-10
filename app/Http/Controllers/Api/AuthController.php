<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{


/**
 * Create a new User instance and persist to database
 * @param  Request $request Form input
 * @return User and authorization token
 */
  public function register (Request $request)
  {
    // Validate input
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6|confirmed'
    ]);

    if ($validator->fails())
    {
      return response([ 'errors' => $validator->errors()->all() ], 422);
    }
    // Hash password using password_hash, algoritm defaults to bcrypt
    $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
    $user = User::create($request->toArray());

    // TODO SETUP AUTH TOKEN
    $token = 'SETUP TOKEN';
    $response = ['token' => $token, 'user' => $user];
    // Send response with $token String and $user Object
    return response($response, 200);

  }


/**
 * Validate form data, and check database for user. If
 * @param  Request $request Form input
 * @return User object and $token string
 */
  public function login (Request $request)
  {
    // Validate login form data before processing
    $validator = Validator::make($request->all(), [
      'email' => 'required|string|email|max:255',
      'password' => 'required|string|max:255',
    ]);
    if ($validator->fails())
    {
      return response([ 'errors' => $validator->errors()->all()], 422);
    }

    $user = User::where('email', $request->email)->first();
    // if found user instance
    if ($user) {
      $password = password_verify($request->password, $user->password);
      if ($password)
      {
        // TODO SETUP AUTH TOKEN
        $token = 'SETUP TOKEN ';
        $response = ['token' => $token, 'user' => $user];
        return response($response, 200);
      }
      else
      {
        $response = 'Wrong email or password';
        return response($response, 422);
      }
    }
  }

}
