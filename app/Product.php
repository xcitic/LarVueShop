<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'Products';

    protected $fillable = [
      'title',
      'slug',
      'description',
      'price',
      'likes',
    ];



}
