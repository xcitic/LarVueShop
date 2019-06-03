<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
      'order_status',
      'shipping_address',
      'shipping_type',
      'shipping_price',
      'contact_person',
      'contact_number',
      'total_price',
      'tax_number',
      'user_id',
      'cart_id',
      'payment_id'
    ];

    public function owner()
    {
      return $this->belongsTo('App\User');
    }

    public function cart()
    {
      return $this->hasOne('App\Cart');
    }

    public function payment()
    {
      return $this->hasOne('App\Payment');
    }

}
