@extends('layouts.master')
@section('content')
<div class="container" style="padding:50px">
    @if(session('thanhcong'))
        <div class="alert alert-success">{{session('thanhcong')}}</div>
    @endif
    <div class="form-group">
        <div class="row" style="background-color: aliceblue">
            <h4>Quản lý Danh Mục</h4>
        </div>
    </div>
    <div class="form-group">
        <div class="form-group">
            <a class="btn btn-default" href="#" data-toggle="modal" data-target="#modalInsertCategory"><span  class="glyphicon glyphicon-plus-sign"></span> Thêm</a>
        </div>
    </div>

    <div class="form-group">
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="info">
                    <th>Tên</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category as $category)
                <tr>
                <td style="display:none">{{$category->id}}</td>
                    <td><b>{{$category->name}}</b></td>
                    <td>
                        <a class="getData" href="#" data-toggle="modal" data-target="#modalUpdateCategory"><span class="glyphicon glyphicon-pencil label label-warning"> Sửa</span></a>
                    <a href="{{route('deletecategory',$category->id)}}" onclick="return confirm('Bạn có muốn xóa danh mục {{$category->name}} không ?')"><span class="glyphicon glyphicon-remove-circle label label-danger"> Xóa</span></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">{{ $category->paginate(6)->links() }}</div>
</div>

{{-- Modal Insert Category Here --}}
<div class="modal fade" id="modalInsertCategory">
    <div class="modal-dialog">
        <form id="frmInsertCategory">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thêm danh mục</h4>
            </div>
            <div class="modal-body" style="padding:10px 100px 10px 100px">
                <div class="form-group">
                    <label>Tên danh mục</label>
                    <input name="name" type="text" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Hủy</button>
                <button id="btnInsertCategory" class="btn btn-primary">Xác Nhận</button>
            </div>
            <div id="messageInsertCategory"></div>
        </div>
        </form>
    </div>
</div>

{{-- Modal update Category here --}}
<div class="modal fade" id="modalUpdateCategory">
    <div class="modal-dialog">
        <form id="frmUpdateCategory">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4>Chỉnh sửa danh mục</h4>
            </div>
            <div class="modal-body" style="padding:10px 100px 10px 100px">
                <div class="form-group">
                    <label>Tên danh mục</label>
                    <input type="hidden" id="ipid">
                    <input id="ipname" name="name" type="text" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal"> Hủy</button>
                <button class="btn btn-primary" id="btnUpdateCategory"> Xác Nhận</button>
            </div>
            <div id="messageUpdateCategory"></div>
        </div>
    </form>
    </div>
</div>
@endsection

@section('footer_scripts')
<script>
$(document).ready(function(){
    var reload = false;
    var datatable;
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

        // Get data to Modal
        $('.getData').click(function(){
            var tr = $(this).closest('tr');
            datatable = tr.children('td').map(function(){
                return $(this).text();
            });
            $('#ipid').val(datatable[0]);
            $('#ipname').val(datatable[1]);
        });

        // Ajax insert category
        $('#btnInsertCategory').click(function(e){
            e.preventDefault();
            $.ajax({
            type: 'post',
            data: $('#frmInsertCategory').serialize(),
            url: 'page/them-category',
            success: function(data){
                // console.log(data);
                $.each(data,function(key,value){
                    if(key=='thanhcong'){
                        $('#messageInsertCategory').attr('class','alert alert-success');
                        $('#messageInsertCategory').text(value);
                        reload = true;
                    }
                    if(key=='error'){
                        $.each(value,function(key,value){
                            $('#messageInsertCategory').attr('class','alert alert-danger');
                            $('#messageInsertCategory').append(value + '<br>');
                        });
                      
                    }
                });
                }
            });
        });

        // Ajax update category
        $('#btnUpdateCategory').click(function(e){
            e.preventDefault();
            $.ajax({
                type: 'post',
                data: $('#frmUpdateCategory').serialize(),
                url: 'page/cap-nhat-category/' + $('#ipid').val(),
                success: function(data){
                    console.log(data);
                    $.each(data,function(key,value){
                        if(key=='thanhcong'){
                            $('#messageUpdateCategory').attr('class','alert alert-success');
                            $('#messageUpdateCategory').text(value);
                            reload = true;
                        }
                        if(key=='error'){
                            $.each(value,function(key,value){
                                $('#messageUpdateCategory').attr('class','alert alert-danger');
                                $('#messageUpdateCategory').append(value + '<br>');
                            });
                        }
                    });
                }
            });
        });

        $('div.modal').on('hidden.bs.modal',function(e){
            $('#messageInsertCategory').attr('class','');
            $('#messageInsertCategory').text('');
            $('#messageUpdateCategory').attr('class','');
            $('#messageUpdateCategory').text('');
            if(reload){
                location.reload();
            }
        });
});
</script>
@endsection