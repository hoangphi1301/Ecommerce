<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public function producttypes(){
    	return $this->belongsTo('App\ProductType','product_type_id','id');
    }

    public function brand(){
    	return $this->belongsTo('App\Brand','brand_id','id');
    }
}
