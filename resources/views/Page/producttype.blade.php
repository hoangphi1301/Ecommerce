@extends('layouts.master')
@section('content')

<div class="container" style="padding: 50px">
	@if(session('thanhcong'))
		<div class="alert alert-success">{{session('thanhcong')}}</div>
	@endif
	@if(session('thatbai'))
		<div class="alert alert-danger">{{session('thatbai')}}</div>
	@endif
	<div class="form-group">
		<div class="row" style="background-color: AliceBlue">
			<h4>Quản lý các thuộc tính sản phẩm</h4>
		</div>
	</div>
	
	<!-- Form group table product type and brand -->
	<div class="form-group row">
		<div class="col-sm-6">
			<div class="row text-center">
					<b>Bảng loại sản phẩm</b>
			</div>
			<!-- Click here to Create Product Type -->
			<div class="form-group">
			<a href="#" id="clickCreateType" class="btn btn-default" data-toggle="modal" data-target="#modalCreateType" ><i class="glyphicon glyphicon-plus-sign"></i> Thêm</a>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr class="info">
						<th>Tên loại sản phẩm</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($types as $type)
					<tr>
						<td style="display:none">{{$type->id}}</td>
						<td><b>{{$type->name}}</b></td>
						<td>
							<!-- Click here to Update Product Type -->
							<a href="#" data-toggle="modal" data-target="#modalUpdateType" name="{{$type->name}}" class="getdata"><i class="glyphicon glyphicon-pencil label label-warning"> Sửa</i></a>
							<!-- Click here to Delete Product Type -->
							<a href="{{route('deleteproducttype',$type->id)}}" id="deleteType" onclick="return confirm('Bạn có muốn xóa loại sản phẩm {{$type->name}} không ?')"><i class="glyphicon glyphicon-remove-circle label label-danger"> Xóa</i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="col-sm-6">
			<div class="row text-center">
					<b>Bảng thương hiệu</b>
			</div>
			<!-- Click here to Create Brand -->
			<div class="form-group">
			<a href="#" id="clickCreateBrand" class="btn btn-default" data-toggle="modal" data-target="#modalCreateBrand" ><i class="glyphicon glyphicon-plus-sign"></i> Thêm</a>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr class="info">
						<th>Tên thương hiệu</th>
						<th>Mô tả</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($brands as $brand)
					<tr>
						<td style="display:none">{{$brand->id}}</td>
						<td><b>{{$brand->name}}</b></td>
						<td>{{$brand->description}}</td>
						<td>
							<!-- Click here to Update Brand -->
							<a href="#" class="getdata" data-toggle="modal" data-target="#modalUpdateBrand" name="{{$brand->name}}" description="{{$brand->description}}" id="dataBrand"><i class="glyphicon glyphicon-pencil label label-warning"> Sửa</i></a>
							<!-- Click here to Delete Brand -->
							<a href="{{route('deletebrand',$brand->id)}}" onclick="return confirm('Bạn có muốn xóa thương hiệu {{$brand->name}} không ?')"><i class="glyphicon glyphicon-remove-circle label label-danger"> Xóa</i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<!-- Form Group table Color -->
	<div class="form-group row">
		<div class="col-sm-6">
			<div class="row text-center">
					<b>Bảng màu sắc</b>
			</div>
			<!-- Click here to Create Color-->
			<div class="form-group">
			<a href="#" id="clickCreateColor" class="btn btn-default" data-toggle="modal" data-target="#modalInsertColor" ><i class="glyphicon glyphicon-plus-sign"></i> Thêm</a>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr class="info">
						<th>Tên màu</th>
						<th>Mã màu</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($colors as $color)
					<tr>
						<td style="display:none">{{$color->id}}</td>
						<td><b>{{$color->name}}</b></td>
						<td>{{$color->code}}</td>
						<td>
							<!-- Click here to Update Color -->
							<a href="#" class="getdata" data-toggle="modal" data-target="#modalUpdateColor" name="{{$color->name}}" code="{{$color->code}}" id="dataColor"><i class="glyphicon glyphicon-pencil label label-warning"> Sửa</i></a>
							<!-- Click here to Delete Color -->
							<a href="{{route('deletecolor',$color->id)}}" onclick="return confirm('Bạn có muốn xóa màu {{$color->name}} không ?')"><i class="glyphicon glyphicon-remove-circle label label-danger"> Xóa</i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

</div>

<!-- All Modal Start Here -->

	<!-- Modal create product type -->
	<div class="modal fade" id="modalCreateType">
		<div class="modal-dialog">
			<form id="frmCreateType">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titleCreateType">Thêm loại sản phẩm</h4>
				</div>

				<div class="modal-body" style="padding: 10px 100px 10px 100px">
					<div class="form-group">
						<label>Loại sản phẩm</label>
						<input name="nametype" class="form-control" type="text">
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Hủy</button>
					<input id="btnCreateType" type="submit" class="btn btn-primary" value="Xác Nhận">
				</div>
				<div id="messageInsertType"></div>
			</div>
		</form>
		</div>
	</div>

	<!-- Modal update product type -->
	<div class="modal fade" id="modalUpdateType">
		<div class="modal-dialog">
		<form id="frmUpdateType">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titleUpdateType">Cập nhật loại sản phẩm</h4>
				</div>

				<div class="modal-body" style="padding:10px 100px 10px 100px">
					<div class="form-group"> 
						<label>Tên loại sản phẩm</label>
						<input type="hidden" class="idData">
						<input name="nametype" class="form-control nameData" type="text">
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Hủy</button>
					<button id="btnUpdateType" class="btn btn-primary" >Xác Nhận</button>
				</div>
				<div id="messageupdatetype"></div>
			</div>
			</form>
		</div>
	</div>

	<!-- Modal create Brand -->
	<div class="modal fade" id="modalCreateBrand">
		<div class="modal-dialog">
		<form id="frmInsertBrand">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titleCreateBrand">Thêm thương hiệu</h4>
				</div>

				<div class="modal-body" style="padding:10px 100px 10px 100px">
					<div class="form-group">
						<label>Tên thương hiệu</label>
						<input type="text" name="namebrand" class="form-control">
					</div>
					<div class="form-group">
						<label>Mô tả</label>
						<textarea name="descriptionBrand" rows="4" type="text" class="form-control"></textarea>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Hủy</button>
					<button id="btnInsertBrand" class="btn btn-primary">Xác Nhận</button>
				</div>
				<div id="messageInsertBrand"></div>
			</div>
		</form>
		</div>
	</div>

	<!-- Modal update Brand -->
	<div class="modal fade" id="modalUpdateBrand">
		<div class="modal-dialog">
		<form id="frmUpdateBrand">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titleUpdateBrand">Cập nhật thương hiệu</h4>
				</div>

				<div class="modal-body" style="padding:10px 100px 10px 100px">
					<div class="form-group">
						<label>Tên thương hiệu</label>
						<input type="hidden" class="idData">
						<input name="namebrand" type="text" class="form-control nameData">
					</div>
					<div class="form-group">
						<label>Mô tả</label>
						<textarea name="descriptionBrand" rows="4" type="text" class="form-control descriptionBrand"></textarea>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Hủy</button>
					<button id="btnUpdateBrand" class="btn btn-primary">Xác Nhận</button>
				</div>
				<div id="messageUpdateBrand"></div>
			</div>
			</form>
		</div>
	</div>

	<!-- Modal insert Color-->
	<div class="modal fade" id="modalInsertColor">
		<div class="modal-dialog">
		<form id="frmInsertColor">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titleCreateColor">Thêm màu sắc</h4>
				</div>

				<div class="modal-body" style="padding:10px 100px 10px 100px">
					<div class="form-group">
						<label>Tên màu</label>
						<input name="nameColor" type="text" class="form-control">
					</div>
					<div class="form-group">
						<label>Mã màu</label>
						<input name="codeColor" type="text" class="form-control">
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Hủy</button>
					<button id="btnInsertColor" class="btn btn-primary">Xác Nhận</button>
				</div>
				<div id="messageInsertColor"></div>
			</div>
			</form>
		</div>
	</div>

	<!-- Modal update Color -->
	<div class="modal fade" id="modalUpdateColor">
		<div class="modal-dialog">
		<form id="frmUpdateColor">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="titleUpdateColor">Cập nhật màu sắc</h4>
				</div>

				<div class="modal-body" style="padding:10px 100px 10px 100px">
					<div class="form-group">
						<label>Tên màu</label>
						<input type="hidden" class="idData">
						<input name="nameColor" type="text" class="form-control nameData">
					</div>
					<div class="form-group">
						<label>Mã màu</label>
						<input name="codeColor" type="text" class="form-control codeColor">
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Hủy</button>
					<button id="btnUpdateColor" class="btn btn-primary">Xác Nhận</button>
				</div>
				<div id="messageUpdateColor"></div>
			</div>
			</form>
		</div>
	</div>

@endsection

@section('footer_scripts')
<script type="text/javascript">
$(document).ready(function(){

	var reload = false;
	var datatable;

	// Token here
	$.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

	// ajax create product type
	$('#btnCreateType').on('click',function(e){
		e.preventDefault();
		var formData = new FormData($('#frmCreateType')[0]);
		var url = 'page/them-loai-san-pham';
		createAjax(url,formData);
	});

	// ajax update product type
	$('#btnUpdateType').click(function(e){
		e.preventDefault();
		var formData = new FormData($('#frmUpdateType')[0]);
		var url = 'page/sua-loai-san-pham/' + $('.idData').val();
		createAjax(url,formData);
	});

	// ajax insert brand
	$('#btnInsertBrand').click(function(e){
		e.preventDefault();
		var formData = new FormData($('#frmInsertBrand')[0]);
		var url = 'page/them-thuong-hieu';
		createAjax(url,formData);
	})

	// ajax update brand
	$('#btnUpdateBrand').click(function(e){
		e.preventDefault();
		var formData = new FormData($('#frmUpdateBrand')[0]);
		var url = 'page/sua-thuong-hieu/' + $('.idData').val();
		createAjax(url,formData);
	});

	// ajax insert color
	$('#btnInsertColor').click(function(e){
		e.preventDefault();
		var formData = new FormData($('#frmInsertColor')[0]);
		var url = 'page/them-mau-sac';
		createAjax(url,formData);
	});

	// ajax update color
	$('#btnUpdateColor').click(function(e){
		e.preventDefault();
		var formData = new FormData($('#frmUpdateColor')[0]);
		var url = 'page/sua-mau-sac/' + $('.idData').val();
		createAjax(url,formData);
	});

	// Get data to Update
	$('.getdata').click(function(){
		var tr = $(this).closest('tr');
		datatable = tr.children('td').map(function(){
			return $(this).text();
		}).get();
		$('.idData').val(datatable[0]);
		$('.nameData').val(datatable[1]);
		$('.descriptionBrand').val(datatable[2]);
		$('.codeColor').val(datatable[2]);
	});

	// Function create ajax
	function createAjax(url,frmData){
		$.ajax({
			type: 'post',
			data: frmData,
			processData: false,
  			contentType: false,
			url: url,
			success: function(data){
				console.log(data);
				$.each(data,function(key,value){
					// response to product types table
					if(key=='successinserttype'){
						$('#messageInsertType').attr('class','alert alert-success');
						$('#messageInsertType').text(value);
						reload = true;
					}
					if(key=="errorinserttype"){
						$('#messageInsertType').attr('class','alert alert-danger');
						$.each(value,function(key,value){
							$('#messageInsertType').append(value + '<br>');
						});
						
					}
					if(key=='successupdatetype'){
						$('#messageupdatetype').attr('class','alert alert-success');
						$('#messageupdatetype').text(value);
						reload = true;
					}
					if(key=="errorupdatetype"){
						$('#messageupdatetype').attr('class','alert alert-danger');
						$.each(value,function(key,value){
							$('#messageupdatetype').append(value + '<br>');
						});
						
					}

					// response to brands table
					if(key=='successinsertbrand'){
						$('#messageInsertBrand').attr('class','alert alert-success');
						$('#messageInsertBrand').text(value);
						reload = true;
					}
					if(key=="errorinsertbrand"){
						$('#messageInsertBrand').attr('class','alert alert-danger');
						$.each(value,function(key,value){
							$('#messageInsertBrand').append(value + '<br>');
						});
						
					}
					if(key=='successupdatebrand'){
						$('#messageUpdateBrand').attr('class','alert alert-success');
						$('#messageUpdateBrand').text(value);
						reload = true;
					}
					if(key=="errorupdatebrand"){
						$('#messageUpdateBrand').attr('class','alert alert-danger');
						$.each(value,function(key,value){
							$('#messageUpdateBrand').append(value + '<br>');
						});
					}

					// response to colors table
					if(key=='successinsertcolor'){
						$('#messageInsertColor').attr('class','alert alert-success');
						$('#messageInsertColor').text(value);
						reload = true;
					}
					if(key=='errorinsertcolor'){
						$('#messageInsertColor').attr('class','alert alert-danger');
						$.each(value,function(key,value){
							$('#messageInsertColor').append(value + '<br>');
						});
					}
					if(key=='successupdatecolor'){
						$('#messageUpdateColor').attr('class','alert alert-success');
						$('#messageUpdateColor').text(value);
						reload = true;
					}
					if(key=='errorupdatecolor'){
						$('#messageUpdateColor').attr('class','alert alert-danger');
						$.each(value,function(key,value){
							$('#messageUpdateColor').append(value + '<br>');
						});
					}
				});
			}
		});
	}

	// Reload page when hide modal
	$('.modal').on('hidden.bs.modal',function(e){
		$('#messageInsertType').attr('class','');
		$('#messageInsertType').html('');
		$('#messageUpdateType').attr('class','');
		$('#messageUpdateType').html('');
		$('#messageInsertBrand').attr('class','');
		$('#messageInsertBrand').html('');
		$('#messageUpdateBrand').attr('class','');
		$('#messageUpdateBrand').html('');
		$('#messageInsertColor').attr('class','');
		$('#messageInsertColor').html('');
		$('#messageUpdateColor').attr('class','');
		$('#messageUpdateColor').html('');

		if(reload){
			location.reload();
		}
	});
});
</script>
@endsection