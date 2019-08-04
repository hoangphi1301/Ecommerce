@extends('layouts.master')
@section('content')

<div class="container">
  <div class="table-wrapper" style="padding:50px">
    <div class="table-title">
       <div class="row" style="background-color: AliceBlue;margin-bottom: 10px">
              <h4><b>Quản lý Users</b></h4>
        </div>
        
        <div class="row">
           
          <!-- Button Add User here -->
          @can('create-user',Auth::user())
          <div class="col-sm-8">
            <a href="{{route('dangky')}}" class="btn btn-default"><img src="source/icon/icon_add_user.png" width="20px"> <span>Thêm User</span></a>
          </div>
          @endcan
          <div class="col-sm-3">
              <form method="get" action="{{route('searchuser')}}">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Tìm kiếm User">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                      </span> 
                </div>
               </form>
          </div>

        </div>
    </div>

<div class="box-body">
<table id="myTable" class="table table-condensed table-striped table-hover">
  <!-- Tittle of Table data users -->
    <thead>
          <tr class="info">
              <th>Tên</th>           
              <th>Email</th>
              <th>Số điện thoại</th>
              <th>Chức vụ</th>
              <th>Trạng Thái</th>
              <th>Quyền</th>
              @can('update-user',Auth::user())
              <th>Sửa</th>
              @endcan
              @can('delete-user',Auth::user())
              <th>Xóa</th>
              @endcan
          </tr>
    </thead>
    <tbody>
          <!-- Show Messages form Server -->
              @if(session('error'))
              <div class="alert alert-danger">
                  {{session('error')}}<br>
                </div>
              @endif
               @if(session('thanhcong'))
               <div class="alert alert-success">
                  {{session('thanhcong')}}<br>
                </div>
              @endif
              @if(session('thongbao'))
               <div class="alert alert-danger">
                  {{session('thongbao')}}<br>
                </div>
              @endif
           <!-- End Messages -->
      @foreach($users as $u)
        @can('view-user',Auth::user())
        <tr>
            <td><img src="source/avatar/{{$u->userprofile->avatar}}" width="35px" height="35px" class="img-circle" alt="Avatar"><strong style="margin-left: 10px;">{{$u->name}}</strong></td>
            <td>{{$u->email}}</td>                        
            <td>{{$u->phone}}</td>
            <td>
                 
                  @switch($u->position)
                  @case ("nhanvien")
                     Nhân viên
                      @break

                  @case ("truongnhom")
                      Trưởng nhóm
                      @break

                   @case ("truongphong")
                      Trưởng phòng
                      @break

                   @case ("giamdoc")
                      Giám đốc
                      @break

                  @default
                      Default case...
                @endswitch
            </td>
            <td>
                @if($u->active==1)
                  Đang hoạt động
                  @else
                  Ngừng hoạt động
                @endif
            </td>
            <td>
               @if($u->is_admin==1)
                  <mark><b>Admin</b></mark>
                  @else
                  <i>Thường</i>
                @endif
            </td>
            @can('update-user',Auth::user())
            <td>
              <!-- Click show Modal Update User -->
          
              <a href="" class="aClick" uid="{{$u->id}}" email="{{$u->email}}" position="{{$u->position}}" active="{{$u->active}}" is_admin="{{$u->is_admin}}" permit="<?php foreach($u->userpermit as $permit){
                    echo $permit->permit.'.';
              } ?>" data-toggle="modal" data-target="#myModal" data-backdrop="static"><img src="source/icon/icon_update_user.png" width="20px"></a>
            </td>
            @endcan
            @can('delete-user',Auth::user())
            <td>
              <!-- Click to Delete User -->
              <a href="{{route('deleteuser',$u->id)}}" onclick="return confirm('Bạn có muốn xóa tài khoản {{$u->email}} ?');" class="aDelete" ><img src="source/icon/icon_delete_user.png" width="20px"></a>    
            </td>  
            @endcan
        </tr>
        @endcan
       @endforeach
    </tbody>
</table>
</div>
<div class="row">{{$users->links()}}</div>

  </div>
</div>      

 <!-- Start Modal Update User -->
        <div class="modal  fade" id="myModal" >
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: AliceBlue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4><strong class="modal-title" id="titleModal" style="display: inline;"></strong></h4>
              </div>
              <!-- Start Form -->
              <form id="frmUpdateUser" action="" method="post" >

                <div class="modal-body" style="padding: 10px 50px 20px 50px">
                 <!-- Body Model -->
                   <label>Chức vụ</label>
                  <div class="input-group col-sm-6">
                         <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                          <select id="slPosition" class="form-control select2" name="position" data-placeholder="Select a State">     
                               <option value="nhanvien">Nhân Viên</option>
                               <option value="truongnhom">Trưởng Nhóm</option>
                               <option value="truongphong">Trưởng Phòng</option>
                               <option value="giamdoc">Giám Đốc</option>
                        </select>
                  </div>
              
                  <fieldset>
                      <legend><label style="font-size: 15px">Admin</label></legend>
                      <div class="form-group">
                        <label class="radio-inline">
                          <input type="radio" name="is_admin" value="0" >Tài khoản thường
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="is_admin" value="1">Tài khoản Admin
                        </label>
                      </div>
                    </fieldset>

                  <fieldset>
                      <legend><label style="font-size: 15px">Trạng Thái</label></legend>
                      <div class="form-group">
                        <label class="radio-inline">
                          <input type="radio" name="active" value="1">Kích Hoạt
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="active" value="0">Không Kích Hoạt
                        </label>
                      </div>
                    </fieldset>

                    <fieldset>
                      <legend><label style="font-size: 15px">Quyền</label></legend>
                    
                      <label>User Permissions  </label>
                      <div class="form-group" style="margin-left: 30px;">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="cbview" name="view" value="view-user" > Hiển Thị User 
                           </label>
                           <label class="checkbox-inline">
                              <input type="checkbox" id="cbcreate" name="create" value="create-user" > Tạo User
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" id="cbupdate" name="update" value="update-user"> Sửa User
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" id="cbdelete" name="delete" value="delete-user" > Xóa User
                            </label>
                      </div>
                    </fieldset>

                    <!-- End Body Modal -->

                </div>
              </form>
            
              <div class="modal-footer" style="background-color: AliceBlue">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <button type="button" id="btnSave" class="btn btn-primary">Thay Đổi</button>
               
              </div>
              <div id="thongbao"></div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      <!-- End Modal Update User -->

@endsection

@section('footer_scripts')   
<script type="text/javascript">

$(document).ready(function(){

var reload = false;

// Token here
$.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // Click link to get data to Modal
      $('.aClick').click(function(){
        //Get data from <a> element
        var id = $(this).attr('uid');
        var email = $(this).attr('email');
        var position = $(this).attr('position');
        var is_admin = $(this).attr('is_admin');
        var active = $(this).attr('active');
        var permit = $(this).attr('permit');
        
        $('#frmUpdateUser').attr('value',id);
        $('#slPosition').val(position);
        $('input[name=is_admin][value='+is_admin+']').prop('checked',true);
        $('input[name=active][value='+active+']').prop('checked',true);
        // Checkbox permission
            if(permit.search('view') >= 0)
                $('input[name=view]').prop('checked',true);
              else
                $('input[name=view]').prop('checked',false);

            if(permit.search('create') >= 0)
                $('input[name=create]').prop('checked',true);
              else
                $('input[name=create]').prop('checked',false);

            if(permit.search('update') >= 0)
                $('input[name=update]').prop('checked',true);
              else
                $('input[name=update]').prop('checked',false);

            if(permit.search('delete') >= 0)
                $('input[name=delete]').prop('checked',true);
              else
                $('input[name=delete]').prop('checked',false);

        $('#titleModal').html('Cập nhật cho tài khoản : <mark>' + email + '</mark>');
      });

      // Process checkbox permission
      $('#cbview').click(function(){
        if(!$(this).prop('checked')){
            $('#cbcreate').prop('checked',false);
            $('#cbupdate').prop('checked',false);
            $('#cbdelete').prop('checked',false);

            $('#cbcreate').prop('disabled',true);
            $('#cbupdate').prop('disabled',true);
            $('#cbdelete').prop('disabled',true);
        }else{
            $('#cbcreate').prop('disabled',false);
            $('#cbupdate').prop('disabled',false);
            $('#cbdelete').prop('disabled',false);
        }
      })
      $('#myModal').on('show.bs.modal',function(){
          if(!$('#cbview').prop('checked')){
            $('#cbcreate').prop('disabled',true);
            $('#cbupdate').prop('disabled',true);
            $('#cbdelete').prop('disabled',true);
        }else{
            $('#cbcreate').prop('disabled',false);
            $('#cbupdate').prop('disabled',false);
            $('#cbdelete').prop('disabled',false);
        }
      })

      // Ajax Update User
      $('#btnSave').click(function(e){
        e.preventDefault();
        $.ajax({
            url: 'admin/cap-nhat-user/' + $('#frmUpdateUser').attr('value'),
            type: 'POST',
            data: $('#frmUpdateUser').serialize(),
            success: function(data){
              console.log(data);
              $.each(data,function(key,value){
                    if(key=='thatbai'){
                      $('#thongbao').attr('class','alert alert-danger');
                      $('#thongbao').html(value);
                    }
                    if(key=='thanhcong'){
                      $('#thongbao').attr('class','alert alert-success');
                      $('#thongbao').html(value);
                      reload = true;
                    }
              });
            }
        });

      });
      // End Ajax

      // Process when hide Modal
      $('#myModal').on('hidden.bs.modal',function(e){
        $('#thongbao').attr('class','');
          $('#thongbao').html('');
          if(reload){
            window.location.href = "/admin/quan-ly-user";
          }
      });
  });
</script>
@endsection