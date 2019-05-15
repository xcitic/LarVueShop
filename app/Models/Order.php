<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'Orders';

    protected $fillable = [
      'order_status',
      'shipping_address',
      'shipping_type',
      'shipping_price',
      'contact_person',
      'contact_number',
      'tax_number',
      'user_id',
      'cart_id',
      'payment_id'
    ];

    public function owner()
    {
      $this->belongsTo('App\User');
    }

    public function cart()
    {
      $this->hasOne('App\Cart');
    }

    public function payment()
    {
      $this->hasOne('App\Payment');
    }

}
