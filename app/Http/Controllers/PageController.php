<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
use App\Brand;
use App\DetailProduct;
use App\Color;
use App\Category;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function getProducts(){
    	$products = Product::orderBy('name')->paginate(6);
    	return view('page.products',compact('products'));
    }

    public function getSearchProduct(Request $rq){
    	$products = Product::where('name','like','%'.$rq->searchproduct.'%')
    						->orWhere('price','=',$rq->searchproduct)
    						->paginate(6);

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

    public function getViewAttributeProduct(){
    	$types = ProductType::orderBy('name')->get();
    	$brands = Brand::orderBy('name')->get();
    	$colors = Color::orderBy('name')->get();
    	return view('page.producttype',compact('types','brands','colors'));
    }

    public function postInsertProductType(Request $rq){
		$validator = Validator::make($rq->all(),[
			'nametype'=>'required|max:20|unique:product_types,name',
		],[
			'nametype.required'=>'Bạn chưa nhập tên loại',
			'nametype.max'=>'Tên loại quá dài.',
			'nametype.unique'=>'Tên loại sản phẩm này đã tồn tại'
		]);
		if($validator->fails()){
			return response()->json(['errorinserttype'=>$validator->errors()->all()]);
		}
			DB::table('product_types')->insert(['name'=>$rq->nametype]);

    	return response()->json(['successinserttype'=>'Bạn đã thêm loại sản phẩm thành công.']);
	}
	
	public function postUpdateProductType(Request $rq,$id){
		$validator = Validator::make($rq->all(),[
			'nametype'=>'required|max:20',
		],[
			'nametype.required'=>'Bạn chưa nhập tên loại',
			'nametype.max'=>'Tên loại quá dài.',
		]);
		if($validator->fails()){
			return response()->json(['errorupdatetype'=>$validator->errors()->all()]);
		}

		DB::table('product_types')->where('id',$id)->update(['name'=>$rq->nametype]);

		return response()->json(['successupdatetype'=>'Bạn đã cập nhật loại sản phẩm thành công.']);
	}

	public function getDeleteProductType($id){
		if(Product::where('product_type_id',$id)->count() > 0){
			return redirect()->back()->with('thatbai','Bạn không thể xóa loại sản phẩm này vì đã được liên kết với bảng Sản Phẩm');
		}
		DB::table('product_types')->where('id',$id)->delete();
		return redirect()->back()->with('thanhcong','Bạn đã xóa thành công.');
	}

	public function postInsertBrand(Request $rq){
		$validator = Validator::make($rq->all(),[
			'namebrand'=>'required|max:20|unique:brands,name',
		],[
			'namebrand.required'=>'Bạn chưa nhập tên thương hiệu',
			'namebrand.max'=>'Tên thương hiệu quá dài.',
			'namebrand.unique'=>'Tên thương hiệu này đã tồn tại'
		]);
		if($validator->fails()){
			return response()->json(['errorinsertbrand'=>$validator->errors()->all()]);
		}

		DB::table('brands')->insert([
			'name'=>$rq->namebrand,
			'description'=>$rq->descriptionBrand
			]);

		return response()->json(['successinsertbrand'=>'Bạn thêm thương hiệu thành công.']);
	}

	public function postUpdateBrand(Request $rq,$id){
		$validator = Validator::make($rq->all(),[
			'namebrand'=>'required|max:20',
		],[
			'namebrand.required'=>'Bạn chưa nhập tên thương hiệu',
			'namebrand.max'=>'Tên thương hiệu quá dài.',
		]);
		if($validator->fails()){
			return response()->json(['errorupdatebrand'=>$validator->errors()->all()]);
		}

		DB::table('brands')->where('id',$id)->update([
			'name'=>$rq->namebrand,
			'description'=>$rq->descriptionBrand
			]);

		return response()->json(['successupdatebrand'=>'Bạn đã cập nhật thương hiệu thành công.']);
	}

	public function getDeleteBrand($id){
		if(Product::where('brand_id',$id)->count() > 0){
			return redirect()->back()->with('thatbai','Bạn không thể xóa thương hiệu này vì đã được liên kết với bảng Sản Phẩm');
		}
		DB::table('brands')->where('id',$id)->delete();
		return redirect()->back()->with('thanhcong','Bạn đã xóa thành công.');
	}

	public function postInsertColor(Request $rq){
		$validator = Validator::make($rq->all(),[
			'nameColor'=>'required|max:20|unique:colors,name',
			'codeColor'=>'required|max:20'
		],[
			'nameColor.required'=>'Bạn chưa nhập tên màu',
			'nameColor.max'=>'Tên màu quá dài.',
			'nameColor.unique'=>'Tên màu này đã tồn tại.',
			'codeColor.required'=>'Bạn chưa nhập mã màu.',
			'codeColor.max'=>'Mã màu quá dài.'
		]);
		if($validator->fails()){
			return response()->json(['errorinsertcolor'=>$validator->errors()->all()]);
		}

		DB::table('colors')->insert([
			'name'=>$rq->nameColor,
			'code'=>$rq->codeColor
			]);

		return response()->json(['successinsertcolor'=>'Bạn đã thêm màu thành công.']);
	}

	public function postUpdateColor(Request $rq,$id){
		$validator = Validator::make($rq->all(),[
			'nameColor'=>'required|max:20',
			'codeColor'=>'required|max:20'
		],[
			'nameColor.required'=>'Bạn chưa nhập tên màu',
			'nameColor.max'=>'Tên màu quá dài.',
			'codeColor.required'=>'Bạn chưa nhập mã màu.',
			'codeColor.max'=>'Mã màu quá dài.'
		]);
		if($validator->fails()){
			return response()->json(['errorupdatecolor'=>$validator->errors()->all()]);
		}

		DB::table('colors')->where('id',$id)->update([
			'name'=>$rq->nameColor,
			'code'=>$rq->codeColor
		]);

		return response()->json(['successupdatecolor'=>'Bạn đã cập nhật màu thành công.']);
	}

	public function getDeleteColor($id){
		if(Product::where('color_id',$id)->count() > 0){
			return redirect()->back()->with('thatbai','Bạn không thể xóa màu sắc này vì đã được liên kết với bảng Sản Phẩm');
		}
		DB::table('colors')->where('id',$id)->delete();
		return redirect()->back()->with('thanhcong','Bạn đã xóa thành công.');
	}

	public function getViewCategory(){
		$category = Category::orderBy('name')->paginate(5);
		return view('page.category',compact('category'));
	}

	public function postInsertCategory(Request $rq){
		$validator = Validator::make($rq->all(),[
			'name'=>'required|max:20|unique:categories',
			'image'=>'required|image|max:2048'
		],[
			'name.required'=>'Bạn chưa nhập danh mục.',
			'name.max'=>'Danh mục quá dài.',
			'name.unique'=>'Danh mục này đã tồn tại',
			'image.required'=>'Bạn chưa chọn ảnh.',
			'image.image'=>'File ảnh không đúng định dạng.',
			'image.max'=>'Kích thước file quá lớn.'
		]);
		if($validator->fails()){
			return response()->json(['error'=>$validator->errors()->all()]);
		}
		
		$filename = '';
		if($rq->hasFile('image')){
    		$file = $rq->file('image');
    		$filename = $file->getClientOriginalName();
    		$file->move('source/image/Category/',$filename);
    	}

    	DB::table('categories')->insert(['name'=>$rq->name,'image'=>$filename]);

		return response()->json(['thanhcong'=>'Bạn đã thêm danh mục thành công.']);
	}

	public function postUpdateCategory(Request $rq,$id){
		$validator = Validator::make($rq->all(),[
			'name'=>'required|max:20',
			'image'=>'image|max:2048'
		],[
			'name.required'=>'Bạn chưa nhập danh mục.',
			'name.max'=>'Danh mục quá dài.',
			'image.image'=>'File ảnh không đúng định dạng.',
			'image.max'=>'Kích thước file quá lớn.'
		]);
		if($validator->fails()){
			return response()->json(['error'=>$validator->errors()->all()]);
		}
		$filename ='';
		if($rq->hasFile('image')){
			$file = $rq->file('image');
			$filename = $file->getClientOriginalName();
			$file->move('source/image/Category/',$filename);
		}

		if($filename){
			DB::table('categories')->where('id',$id)->update(['name'=>$rq->name,'image'=>$filename]);
		}else{
			DB::table('categories')->where('id',$id)->update(['name'=>$rq->name]);
		}

		return response()->json(['thanhcong'=>'Bạn đã cập nhật danh mục thành công.']);
	}

	public function getDeleteCategory($id){
		DB::table('categories')->where('id',$id)->delete();
		return redirect()->back()->with(['thanhcong'=>'Bạn đã xóa thành công.']);
	}
}
