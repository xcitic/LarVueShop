<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = ['user_id', 'status'];

    public function owner()
    {
      return $this->belongsTo('App\User');
    }

    public function items()
    {
      return $this->hasMany('App\CartItem', 'cart_id', 'id');
    }


}
