<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    protected $table = "detail_product";

    public function product(){
    	return $this->belongsTo('App\Product','product_id','id');
    }
}
