@extends('layouts.master')
@section('content')

<div class="container" style="padding: 50px 150px 50px 150px">
	<div class="panel panel-default">
	@if(count($errors)>0)
	<div class="alert alert-danger">
		@foreach($errors->all() as $err)
		{{$err}}<br>
		@endforeach
	</div>
	@endif

	@if(session('thanhcong'))
		<div class="alert alert-success">
			{{session('thanhcong')}}
		</div>
	@endif

	<div class="panel-heading" style="background-color: AliceBlue">
		<h4><b>Thêm sản phẩm</b></h4>
	</div>

	<div class="panel-body">
		<form action="{{route('createproduct')}}" method="post" enctype="multipart/form-data">
		<div class="form-group col-sm-6">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="form-group">
			<label>Tên sản phẩm</label>
			<div class="input-group col-sm-12">
				<span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
				<input type="text" name="name" placeholder="Nhập tên sản phẩm" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label>Loại sản phẩm</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-tasks"></i></span>
				<select class="form-control" name="product_type">
					@foreach($types as $types)
					<option value="{{$types->id}}">{{$types->name}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group">
			<label>Thương hiệu</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
				<select class="form-control" name="brand">
					@foreach($brands as $brands)
					<option value="{{$brands->id}}">{{$brands->name}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group">
			<label>Giá sản phẩm (nghìn vnđ)</label>
			<div class="input-group col-sm-12">
				<span class="input-group-addon"><i class="glyphicon glyphicon-eur"></i></span>
				<input type="number" value="0" name="price" placeholder="Nhập giá sản phẩm (vnđ)" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label>Giá khuyến mãi (nghìn vnđ)</label>
			<div class="input-group col-sm-12">
				<span class="input-group-addon"><i class="glyphicon glyphicon-eur"></i></span>
				<input type="number" value="0" name="promotion_price" placeholder="Nhập giá khuyến mãi (vnđ)" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-12">Ảnh</label>
				<img id="imgChooseFile" class="img-thumbnail" src="source/image/product/default.jpg" alt="Click Here to Choose File" width="300px" height="200px">
				<input type="file" name="image" style="display: none" id="ipChooseFile"  accept="image/*" >	
		</div>

		</div>
		<div class="form-group col-sm-6">

		<div class="form-group">
			<label>Mô tả</label>
				<textarea name="description" rows="5" placeholder="Nhập mô tả sản phẩm" class="form-control"></textarea>
		</div>

		<div class="form-group">
				<label>Màu sắc</label>
				<div class="input-group col-sm-12">
					<span class="input-group-addon"><i class="glyphicon glyphicon-tint"></i></span>
					<select class="form-control" name="color">
						@foreach($colors as $color)
						<option value="{{$color->id}}">{{$color->name}}</option>
						@endforeach
					</select>
				</div>
		</div>

		<div class="form-group">
			<div class="input-group col-sm-12">
				<label>Nhập số lượng sản phẩm</label>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
					<input type="number" value="1" name="amount" class="form-control">
				</div>
			</div>
		</div>

	</div>

		<div class="panel-footer col-sm-12 text-center">
			<input type="submit" class="btn btn-primary" value="Xác Nhận">
		</div>
	</form>
		
	</div>
</div>
</div>

@endsection

@section('footer_scripts')
<script type="text/javascript">
$(document).ready(function(){
	$('#imgChooseFile').click(function(){
		$('#ipChooseFile').click();
	});

	// Script Change Image when click chose file
          function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#imgChooseFile').attr('src', e.target.result);
              }            
              reader.readAsDataURL(input.files[0]);                       
            }
          }

          $("#ipChooseFile").change(function(){
              readURL(this);
          });
          // End Script change image
    });
	
</script>
@endsection