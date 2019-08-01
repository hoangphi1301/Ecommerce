<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class PageController extends Controller
{
    public function getProducts(){
    	$products = Product::all();
    	return view('page.products',compact('products'));
    }

    public function getCreateProduct(){
    	return view('page.createproduct');
    }
}
