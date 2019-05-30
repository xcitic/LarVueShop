<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    public function cart()
    {
      return $this->belongsTo('App/Cart', 'cart_id', 'id');
    }

    public function product()
    {
      return $this->hasOne('App\Product', 'id', 'product_id');
    }

}
