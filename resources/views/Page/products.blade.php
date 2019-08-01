@extends('layouts.master')
@section('content')

<div class="container" style="padding:50px">

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
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm">
				<span class="input-group-btn">
                    <button type="submit" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span> 
			</div>
		</div>
		
	</div>

	<div class="form-group">
		<table class="table table-hover table-striped">
			<thead>
				<tr class="info">
					<th>Tên</th>
					<th>Giá</th>
					<th>Giá khuyến mãi</th>
					<th>Ảnh</th>
					<th>Miêu tả</th>
					<th>Màu sắc</th>
					<th>Trọng lượng</th>
					<th>Trong kho</th>
					<th>Đơn vị</th>
					<th>Sửa</th>
					<th>Xóa</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $pr)
				<tr>
					<td>{{$pr->name}}</td>
					<td>{{$pr->price}}</td>
					<td>{{$pr->promotion_price}}</td>
					<td>{{$pr->image}}</td>
					<td>{{$pr->description}}</td>
					<td>{{$pr->color}}</td>
					<td>{{$pr->weight}}kg</td>
					<td>
						@if($pr->stock == 1)
							Còn hàng
						@else
							Hết hàng
						@endif
					</td>
					<td>{{$pr->unit}}</td>
					<td><a><span class="glyphicon glyphicon-pencil"></span></a></td>
					<td><a><span class="glyphicon glyphicon-remove-circle"></span></a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection