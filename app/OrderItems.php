<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{	

	//protected $table = 'order_items';

  	public function products()
    {
    	return $this->belongsTo('App\Product');
        //return $this->belongsTo('App\Product','product_id','id');
    }

    public function orders()
    {
       return $this->belongsTo('App\Order');
      //return $this->belongsTo('App\Order','order_id','id');
    }
}
 