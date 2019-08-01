@extends('layouts.master')
@section('content')

<div class="container" style="padding: 50px 150px 50px 150px">
	<div class="row" style="background-color: AliceBlue">
		<h4><b>Thêm sản phẩm</b></h4>
	</div>

	<div class="row" style="margin: 10px 100px 10px 100px">
		<form action="" method="post">
		<div class="form-group">
			<label>Tên sản phẩm</label>
			<div class="input-group col-sm-12">
				<span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
				<input type="text" name="name" placeholder="Nhập tên sản phẩm" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label>Giá sản phẩm</label>
			<div class="input-group col-sm-12">
				<span class="input-group-addon"><i class="glyphicon glyphicon-eur"></i></span>
				<input type="text" name="name" placeholder="Nhập giá sản phẩm" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label>Giá khuyến mãi</label>
			<div class="input-group col-sm-12">
				<span class="input-group-addon"><i class="glyphicon glyphicon-eur"></i></span>
				<input type="text" name="name" placeholder="Nhập giá khuyến mãi" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-12">Ảnh</label>
				<img class="img-thumbnail" src="source/avatar/avatar_01.jpg" width="300px" height="200px">
				<input type="file" name="image" accept="image/*" style="display: none">	
		</div>

		<div class="form-group">
			<label>Mô tả</label>
				<textarea name="description" rows="3" placeholder="Nhập mô tả sản phẩm" class="form-control"></textarea>
		</div>

		<div class="form-group">
				<label>Màu sắc</label>
				<div class="input-group col-sm-4">
					<span class="input-group-addon"><i class="glyphicon glyphicon-tint"></i></span>
					<select class="form-control" name="color">
						<option value="black">Đen</option>
						<option value="white">Trắng</option>
					</select>
				</div>
		</div>

		<div class="form-group">
			<label>Trọng lượng</label>
			<div class="input-group col-sm-4">	
				<span class="input-group-addon"><i class="glyphicon glyphicon-scale"></i></span>
				<input type="number" name="weight" placeholder="Trọng lượng (kg)" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<div class="input-group col-sm-12">
				<fieldset>
					<legend><label style="font-size: 15px">Trong kho</label></legend>
					<label class="radio-inline">
						<input type="radio" name="stock" value="1" checked="checked">Còn hàng
					</label>
					<label class="radio-inline">
						<input type="radio" name="stock" value="0">Hết hàng
					</label>
				</fieldset>
			</div>
		</div>

		<div class="form-group">
			<label>Đơn vị</label>
			<div class="input-group col-sm-4">
				<span class="input-group-addon"><i class="glyphicon glyphicon-yen"></i></span>
				<select class="form-control" name="unit">
					<option>Máy</option>
					<option>Chiếc</option>
					<option>Bộ</option>
				</select>
			</div>
		</div>

		<div class="form-group text-center">
			<input type="submit" class="btn btn-primary" value="Xác Nhận">
			<button class="btn btn-default">Reset</button>
		</div>

	</form>
		
	</div>
</div>

@endsection