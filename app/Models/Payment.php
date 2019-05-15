<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{


    protected $table = 'payments';

    protected $fillable = [
      'status',
      'type',
      'token',
      'amount',
      'charge_time',
      'capture_time',
      'order_id',
      'user_id'
    ];


    public function owner()
    {
      return $this->belongsTo('App\User');
    }


    public function order()
    {
      return $this->hasOne('App\Order');
    }


}
