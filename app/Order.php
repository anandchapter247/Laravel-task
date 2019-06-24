<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  	public function customers()
    {
        return $this->belongsTo('App\Customer');
    }

    public function order_items(){

    	return $this->hasMany(App\OrderItems::class);
    }
}
 