@extends('layouts.master')
@section('content')

<div class="container" style="padding:50px">

	@if(session('thanhcong'))
		<div class="alert alert-success">
			{{session('thanhcong')}}
		</div>
	@endif

	<div class="form-group">
		<div class="row" style="background-color: AliceBlue">
				<h4><strong>Quản lý sản phẩm</strong></h4>
		</div>
	</div>
	
	<div class="form-group">
		<div class="form-group col-sm-8">
			<a href="{{route('createproduct')}}" class="btn btn-default"><span  class="glyphicon glyphicon-plus-sign"></span> Thêm sản phẩm</a>
		</div>

		<div class="form-group col-sm-3">
			<form method="get" action="{{route('searchproduct')}}">
				<div class="input-group">
					<input type="text" name="searchproduct" class="form-control" placeholder="Tìm kiếm sản phẩm">
					<span class="input-group-btn">
	                    <button type="submit" class="btn btn-flat"><i class="fa fa-search"></i>
	                    </button>
	                </span> 
				</div>
			</form>
		</div>
		
	</div>

	<div class="form-group">
		<table class="table table-hover table-striped table-condensed">
			<thead>
				<tr class="info">
					<th>Tên</th>
					<th>Giá</th>
					<th>Giá khuyến mãi</th>
					<th>Ảnh</th>
					<th>Màu sắc</th>
					<th>Số lượng</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $pr)
				<tr>
					<td><b>{{$pr->name}}</b></td>
					<td>{{number_format($pr->price)}} vnđ</td>
					<td>{{number_format($pr->promotion_price)}} vnđ</td>
					<td><img class="img-rounded" src="source/image/product/{{$pr->image}}" width="150px" height="150px"></td>
					<td><img style="background-color: {{$pr->color->code}};" width="20px" height="20px"></img> {{$pr->color->name}}</td>
					<td>
						@if($pr->amount > 0)
							{{$pr->amount}} sản phẩm
						@else
							<mark>Hết hàng</mark>
						@endif
					</td>
					<td>
						<!-- Click to View detail product -->
						<a href="#" class="viewClick" name="{{$pr->name}}" type="{{$pr->producttype->name}}" brand="{{$pr->brand->name}}" description="{{$pr->description}}" size="{{$pr->detailproduct->size}}" weight="{{$pr->detailproduct->weight}}" display="{{$pr->detailproduct->display}}" resolution="{{$pr->detailproduct->resolution}}" system="{{$pr->detailproduct->system}}" storage="{{$pr->detailproduct->storage}}" ram="{{$pr->detailproduct->ram}}" cpu="{{$pr->detailproduct->cpu}}" gpu="{{$pr->detailproduct->gpu}}" camera="{{$pr->detailproduct->camera}}" bluetooth="{{$pr->detailproduct->bluetooth}}" wlan="{{$pr->detailproduct->wlan}}" gps="{{$pr->detailproduct->gps}}" port="{{$pr->detailproduct->port}}" battery="{{$pr->detailproduct->battery}}" other="{{$pr->detailproduct->other}}" data-toggle="modal" data-target="#modelDetailProduct"><span class="glyphicon glyphicon-info-sign label label-info"> Xem</span></a>

						<!-- Click to update detail product -->
						<a href="#" uid="{{$pr->id}}" name="{{$pr->name}}"
							price="{{$pr->price}}" promotion_price="{{$pr->promotion_price}}" image="{{$pr->image}}" description="{{$pr->description}}" amount="{{$pr->amount}}" size="{{$pr->detailproduct->size}}" weight="{{$pr->detailproduct->weight}}" display="{{$pr->detailproduct->display}}" resolution="{{$pr->detailproduct->resolution}}" system="{{$pr->detailproduct->system}}" storage="{{$pr->detailproduct->storage}}" ram="{{$pr->detailproduct->ram}}" cpu="{{$pr->detailproduct->cpu}}" gpu="{{$pr->detailproduct->gpu}}" camera="{{$pr->detailproduct->camera}}" bluetooth="{{$pr->detailproduct->bluetooth}}" wlan="{{$pr->detailproduct->wlan}}" gps="{{$pr->detailproduct->gps}}" port="{{$pr->detailproduct->port}}" battery="{{$pr->detailproduct->battery}}" other="{{$pr->detailproduct->other}}" class="updateDetailClick" data-toggle="modal" data-target="#modalUpdateDetail"><span class="glyphicon glyphicon-pencil label label-warning"> Sửa</span></a>

						<!-- Click to Delete detail product -->
						<a href="{{route('deletedetail',$pr->id)}}" onclick="return confirm('Bạn có muốn xóa sản phẩm {{$pr->name}} không ?')"><span class="glyphicon glyphicon-remove-circle label label-danger"> Xóa</span></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="row">{{$products->links()}}</div>
</div>

<!-- Modal Detail Product -->
<div class="modal fade" id="modelDetailProduct"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="titleDetail"></h4>
			</div>
			<div class="modal-body">
				<dl class="dl-horizontal">
				  <dt>Loại sản phẩm</dt>
				  <dd id="type"></dd>
				  <dt>Thương hiệu</dt>
				  <dd id="brand"></dd>
				  <dt>Kích thước</dt>
				  <dd id="size"></dd>
				  <dt>Trọng lượng</dt>
				  <dd id="weight"></dd>

				  <dt>Màn hình</dt>
				  <dd id="display"></dd>
				  <dt>Độ phân giải</dt>
				  <dd id="resolution"></dd>
				  <dt>Hệ điều hành</dt>
				  <dd id="system"></dd>
				  <dt>Bộ nhớ</dt>
				  <dd id="storage"></dd>
				  <dt>RAM</dt>
				  <dd id="ram"></dd>
				  <dt>CPU</dt>
				  <dd id="cpu"></dd>
				  <dt>GPU</dt>
				  <dd id="gpu"></dd>
				  <dt>Camera</dt>
				  <dd id="camera"></dd>
				  <dt>Bluetooth</dt>
				  <dd id="bluetooth"></dd>
				  <dt>WLAN</dt>
				  <dd id="wlan"></dd>
				  <dt>GPS</dt>
				  <dd id="gps"></dd>
				  <dt>Cổng</dt>
				  <dd id="port"></dd>
				  <dt>Pin</dt>
				  <dd id="battery"></dd>
				  <dt>Tính năng khác</dt>
				  <dd id="other"></dd>

				  <dt>Mô tả</dt>
				  <dd id="description"></dd>
				</dl>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Detail Product -->

<!-- Modal Update Detail Product -->
<div class="modal fade" id="modalUpdateDetail">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="titleUpdate"></h4>
			</div>
			<form id="frmUpdateDetail" method="" action="#" enctype="multipart/form-data">
				<div class="modal-body" style="padding: 10px 40px 10px 40px">
					<!-- Input Product -->
					<div class="row">
						<fieldset>
						<legend><h5>Sản phẩm</h5></legend>
						<div class="form-group col-sm-6">
							<div class="form-group">
								<label>Giá sản phẩm</label>
								<input id="price" name="price" type="number" class="form-control">
							</div>
							<div class="form-group">
								<label>Giá khuyến mãi</label>
								<input id="promotion_price" name="promotion_price" type="number" class="form-control">
							</div>
							<div class="form-group">
								<label>Ảnh</label>
								<img src="#" id="imageClick" width="150px" height="150px" alt="Click Here to Choose File" class="img-thumbnail">
								<input id="ipFileClick" accept="image/*" style="display:none" type="file">
							</div>
						</div>

						<div class="form-group col-sm-6">
							<div class="form-group">
								<label>Mô tả</label>
								<textarea id="description" name="description" rows="4" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label>Số lượng</label>
								<input id="amount" name="amount" type="number" class="form-control">
							</div>
						</div>
						</fieldset>
					</div>
					<!-- Input detail product -->
					<div class="row">
					<fieldset>
					<legend><h5>Chi tiết sản phẩm</h5></legend>
						<div class="form-group col-sm-6">
							<div class="form-goup">
								<label>Kích thước</label>
								<input id="usize" type="text" name="size" class="form-control">
							</div>
							<div class="form-goup">
								<label>Trọng lượng</label>
								<input id="uweight" type="text" name="weight" class="form-control">
							</div>
							<div class="form-goup">
								<label>Màn hình</label>
								<input id="udisplay" type="text" name="display" class="form-control">
							</div>
							<div class="form-goup">
								<label>Độ phân giải</label>
								<input id="uresolution" type="text" name="resolution" class="form-control">
							</div>
							<div class="form-goup">
								<label>Hệ điều hành</label>
								<input id="usystem" type="text" name="system" class="form-control">
							</div>
							<div class="form-goup">
								<label>Bộ nhớ</label>
								<input id="ustorage" type="text" name="storage" class="form-control">
							</div>
							<div class="form-goup">
								<label>RAM</label>
								<input id="uram" type="text" name="ram" class="form-control">
							</div>
							<div class="form-goup">
								<label>CPU</label>
								<input id="ucpu" type="text" name="cpu" class="form-control">
							</div>
						</div>

						<div class="form-group col-sm-6">
							<div class="form-goup">
								<label>GPU</label>
								<input id="ugpu" type="text" name="gpu" class="form-control">
							</div>
							<div class="form-goup">
								<label>Camera</label>
								<input id="ucamera" type="text" name="camera" class="form-control">
							</div>
							<div class="form-goup">
								<label>Bluetooth</label>
								<input id="ubluetooth" type="text" name="bluetooth" class="form-control">
							</div>
							<div class="form-goup">
								<label>WLAN</label>
								<input id="uwlan" type="text" name="wlan" class="form-control">
							</div>
							<div class="form-goup">
								<label>GPS</label>
								<input id="ugps" type="text" name="gps" class="form-control">
							</div>
							<div class="form-goup">
								<label>Port</label>
								<input id="uport" type="text" name="port" class="form-control">
							</div>
							<div class="form-goup">
								<label>Pin</label>
								<input id="ubattery" type="text" name="battery" class="form-control">
							</div>
							<div class="form-goup">
								<label>Tính năng khác</label>
								<textarea id="uother" rows="4" name="other" class="form-control"></textarea>
							</div>
						</div>

					</fieldset>
					</div>
				</div>
			</form>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Hủy</button>
				<button id="btnUpdate" class="btn btn-primary">Xác Nhận</button>
			</div>
			<div id="message"></div>
		</div>
	</div>
</div>
<!-- End Modal Update Detail Product -->
@endsection

@section('footer_scripts')
<script type="text/javascript">
$(document).ready(function(){
	var reload=false;
	// Token here
	$.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

	// Get data to Modal Detail Product
	$('.viewClick').click(function(){
		var name = $(this).attr('name');
		var type = $(this).attr('type');
		var brand = $(this).attr('brand');
		var size = $(this).attr('size');
		var weight = $(this).attr('weight');
		var display = $(this).attr('display');
		var resolution = $(this).attr('resolution');
		var system = $(this).attr('system');
		var storage = $(this).attr('storage');
		var ram = $(this).attr('ram');
		var cpu = $(this).attr('cpu');
		var gpu = $(this).attr('gpu');
		var camera = $(this).attr('camera');
		var bluetooth = $(this).attr('bluetooth');
		var wlan = $(this).attr('wlan');
		var gps = $(this).attr('gps');
		var port = $(this).attr('port');
		var battery = $(this).attr('battery');
		var other = $(this).attr('other');
		var description = $(this).attr('description');

		$('#titleDetail').html(name);
		$('#type').html(type);
		$('#brand').html(brand);
		$('#size').html(size);
		$('#weight').html(weight);
		$('#display').html(display);
		$('#resolution').html(resolution);
		$('#system').html(system);
		$('#storage').html(storage);
		$('#ram').html(ram);
		$('#cpu').html(cpu);
		$('#gpu').html(gpu);
		$('#camera').html(camera);
		$('#bluetooth').html(bluetooth);
		$('#wlan').html(wlan);
		$('#gps').html(gps);
		$('#port').html(port);
		$('#battery').html(battery);
		$('#other').html(other);
		$('#description').html(description);
	});
	// End get data detail

	// Get data to Modal Update Detail
	$('.updateDetailClick').click(function(){
		var id = $(this).attr('uid');
		var name = $(this).attr('name');
		var price = $(this).attr('price');
		var promotion_price = $(this).attr('promotion_price');
		var image = $(this).attr('image');
		var description = $(this).attr('description');
		var amount = $(this).attr('amount');
		var size = $(this).attr('size');
		var weight = $(this).attr('weight');
		var display = $(this).attr('display');
		var resolution = $(this).attr('resolution');
		var system = $(this).attr('system');
		var storage = $(this).attr('storage');
		var ram = $(this).attr('ram');
		var cpu = $(this).attr('cpu');
		var gpu = $(this).attr('gpu');
		var camera = $(this).attr('camera');
		var bluetooth = $(this).attr('bluetooth');
		var wlan = $(this).attr('wlan');
		var gps = $(this).attr('gps');
		var port = $(this).attr('port');
		var battery = $(this).attr('battery');
		var other = $(this).attr('other');

		$('#frmUpdateDetail').attr('value',id);
		$('#titleUpdate').html(name);
		$('#price').val(price);
		$('#promotion_price').val(promotion_price);
		$('#imageClick').attr('src','source/image/product/' + image);
		$('textarea#description').val(description);
		$('#amount').val(amount);
		$('#usize').val(size);
		$('#uweight').val(weight);
		$('#udisplay').val(display);
		$('#uresolution').val(resolution);
		$('#usystem').val(system);
		$('#ustorage').val(storage);
		$('#uram').val(ram);
		$('#ucpu').val(cpu);
		$('#ugpu').val(gpu);
		$('#ucamera').val(camera);
		$('#ubluetooth').val(bluetooth);
		$('#uwlan').val(wlan);
		$('#ugps').val(gps);
		$('#uport').val(port);
		$('#ubattery').val(battery);
		$('#uother').val(other);
	});
	// End get data update detail

	// Ajax Update Detail Product
	$('#btnUpdate').click(function(e){
		e.preventDefault();
		var frmData = new FormData($('form#frmUpdateDetail')[0]);
		frmData.append('image',$('#ipFileClick')[0].files[0]);
		if(frmData.get('image')=='undefined'){
			frmData.delete('image');
		}

		$.ajax({
			type: 'post',
			data: frmData,
			processData: false,
  			contentType: false,
			url: 'page/cap-nhat-chi-tiet/' + $('#frmUpdateDetail').attr('value'),
			success: function(data){
				// console.log(data);
				$.each(data,function(key,value){
					if(key=='thanhcong'){
						$('#message').attr('class','alert alert-success');
						$('#message').html(value);
						reload=true;
					}
					if(key=='errors'){
						$.each(value,function(key,value){
							$('#message').attr('class','alert alert-danger');
							$('#message').append(value + '<br>');
						});
						
					}
				});
			}
		});
	});
	// End Ajax update detail product

	$('#modalUpdateDetail').on('hidden.bs.modal',function(e){
		$('#message').attr('class','');
		$('#message').html('');
		if(reload){
			window.location.href = "page/san-pham";
		}
	});

	// Click image to Choose file
	$('#imageClick').click(function(){
		$('#ipFileClick').click();
	});
	// Script Change Image when click chose file
          function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#imageClick').attr('src', e.target.result);
              }            
              reader.readAsDataURL(input.files[0]);                       
            }
          }

          $("#ipFileClick").change(function(){
              readURL(this);
          });
          // End Script change image
});
</script>
@endsection