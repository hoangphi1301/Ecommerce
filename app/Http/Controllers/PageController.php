<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
use App\Brand;
use App\DetailProduct;
use App\Color;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function getProducts(){
    	$products = Product::orderBy('name')->paginate(5);
    	return view('page.products',compact('products'));
    }

    public function getSearchProduct(Request $rq){
    	$products = Product::where('name','like','%'.$rq->searchproduct.'%')
    						->orWhere('price','=',$rq->searchproduct)
    						->paginate(5);

    	return view('page.products',compact('products'));
    }

    public function getDeleteDetailProduct($id){
    	Product::find($id)->delete();
    	return redirect()->route('products')->with('thanhcong','Bạn đã xóa thành công.');
    }

    public function postUpdateDetailProduct(Request $rq,$id){
    	$validator = Validator::make($rq->all(),[
    		'price'=>'required|integer|min:1',
    		'promotion_price'=>'integer|min:0',
    		'image'=>'image|max:2048',
    		'amount'=>'integer|min:0'
    	],[
    		'price.required'=>'Bạn chưa nhập giá sản phẩm',
    		'price.integer'=>'Giá sản phẩm sai định dạng',
    		'price.min'=>'Giá sản phẩm phải lớn hơn 0',
    		'promotion_price.integer'=>'Giá khuyến mãi sai định dạng',
    		'image.image'=>'File ảnh không đúng định dạng',
    		'image.max'=>'Dung lượng file quá lớn',
    		'amount.integer'=>'Sai định dạng số lượng',
    		'amount.min'=>'Số lượng phải là số dương'
    	]);

    	if($validator->fails()){
    		return response()->json(['errors'=>$validator->errors()->all()]);
    	}

    	$product = Product::find($id);
    	$product->price = $rq->price;
    	$product->promotion_price = $rq->promotion_price;
    	$product->description = $rq->description;
    	$product->amount = $rq->amount;
    	if($rq->hasFile('image')){
    		$file = $rq->file('image');
    		$filename = $file->getClientOriginalName();
    		$file->move('source/image/product/',$filename);
    		$product->image = $filename;
    	}
    	$product->save();

    	$detail = DetailProduct::where('product_id',$id)->first();
    	$detail->size = $rq->size;
    	$detail->weight = $rq->weight;
    	$detail->display = $rq->display;
    	$detail->resolution = $rq->resolution;
    	$detail->system = $rq->system;
    	$detail->storage = $rq->storage;
    	$detail->ram = $rq->ram;
    	$detail->cpu = $rq->cpu;
    	$detail->gpu = $rq->gpu;
    	$detail->camera = $rq->camera;
    	$detail->bluetooth = $rq->bluetooth;
    	$detail->wlan = $rq->wlan;
    	$detail->gps = $rq->gps;
    	$detail->port = $rq->port;
    	$detail->battery = $rq->battery;
    	$detail->other = $rq->other;
    	$detail->save();

    	return response()->json(['thanhcong'=>'Bạn đã cập nhật chi tiết sản phẩm thành công !']);
    }

    public function postCreateProduct(Request $rq){
    	$rq->validate([
    		'name' => 'required|min:2|max:50',
    		'price'=> 'required|integer|min:1',
    		'promotion_price' => 'integer|min:0',
    		'image' => 'image|max:2048',
    		'amount'=>'integer|min:0'
    	],[
    		'name.required'=>'Bạn chưa nhập tên sản phẩm',
    		'name.min'=>'Tên sản phẩm phải lơn hơn 3 ký tự',
    		'name.max'=>'Tên sản phẩm quá dài',
    		'price.required'=>'Bạn chưa nhập giá sản phẩm',
    		'price.min'=>'Giá sản phẩm phải lớn hơn 0',
    		'price.integer'=>'Giá sản phẩm quá lớn hoặc sai định dạng',
    		'promotion_price.integer'=>'Giá khuyến mãi quá lớn hoặc sai định dạng',
    		'promotion_price.min'=>'Giá khuyến mãi phải lớn hơn hoặc bằng 0',
    		'image.image'=>'File không đúng định dạng',
    		'image.max'=>'Dung lượng file ảnh quá lớn',
    		'amount.integer'=>'Bạn chưa nhập đúng số lượng',
    		'amount.min'=>'Số lượng phải là số dương.'
    	]);

    	$products = new Product();
    	$detailproduct = new DetailProduct();
    	$products->name = $rq->name;
    	$products->product_type_id = $rq->product_type;
    	$products->brand_id = $rq->brand;
    	$products->color_id = $rq->color;
    	$products->price = $rq->price;
    	$products->promotion_price = $rq->promotion_price;
    	$products->description = $rq->description;
    	$products->amount = $rq->amount;

    	if($rq->hasFile('image')){
            $file = $rq->file('image');
            $filename = $file->getClientOriginalName();
            $file->move('source/image/product/',$filename);
            $products->image = $filename;
       }

    	$products->save();
    	$detailproduct->product_id = $products->id;
    	$detailproduct->save();

    	return redirect()->back()->with('thanhcong','Bạn đã thêm sản phẩm thành công !');
    }

    public function getCreateProduct(){
    	$types = ProductType::all();
    	$brands = Brand::all();
    	$colors = Color::all();
    	return view('page.createproduct',compact('types','brands','colors'));
    }
}
