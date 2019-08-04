<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public function producttype(){
    	return $this->belongsTo('App\ProductType','product_type_id','id');
    }

    public function brand(){
    	return $this->belongsTo('App\Brand','brand_id','id');
    }

    public function color(){
        return $this->belongsTo('App\Color','color_id','id');
    }

    public function detailproduct(){
        return $this->hasOne('App\DetailProduct','product_id','id');
    }
}
