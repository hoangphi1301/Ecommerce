@extends('layouts.master')
@section('content')
<div class="box box-primary" style="padding: 50px 150px 50px 150px">
            <div class="box-header with-border" style="background-color: AliceBlue">
              <h4 class="box-title"><b>Thêm User</b></h4>
            </div>
          
          <!-- Show messages from Server -->

            @if(count($errors)>0)
            <div class="alert alert-danger">
              @foreach($errors->all() as $err)
                  {{$err}}<br>
              @endforeach
            </div>
            @endif
          
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
          <!-- End show messages -->


          <!-- Start Form Here -->

            <form role="form" action="{{route('dangky')}}" method="post">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="box-body">

                <div class="form-group">
                       <label class="col-sm-offset-1">Họ Tên</label>
                        <div class="input-group col-sm-offset-1 col-sm-10">
                          <span class="input-group-addon"><i class="fa  fa-user"></i></span>
                          <input type="text" name="name" class="form-control" placeholder="Nhập họ tên">
                        </div>
                      </div>

                <div class="form-group">
                    <label class="col-sm-offset-1">Email</label>
                    <div class="input-group col-sm-offset-1 col-sm-10">
                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                      <input type="email" name="email" class="form-control" placeholder="Nhập Email">
                    </div>
                  </div>
              
                  <div class="form-group">
                      <label class="col-sm-offset-1">Số điện thoại</label>
                      <div class="input-group col-sm-offset-1 col-sm-10">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại">
                      </div>
                    </div>

                <div class="form-group">
                    <label class="col-sm-offset-1">Chức vụ</label>
                    <div class="input-group col-sm-offset-1 col-sm-10">
                       <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                        <select class="form-control select2" name="position" data-placeholder="Select a State">     
                             <option value="nhanvien">Nhân Viên</option>
                             <option value="truongnhom">Trưởng Nhóm</option>
                             <option value="truongphong">Trưởng Phòng</option>
                             <option value="giamdoc">Giám Đốc</option>
                      </select>
                    </div>
                  </div>

                <div class="form-group">
                     <label class="col-sm-offset-1">Mật khẩu</label>
                    <div class="input-group col-sm-offset-1 col-sm-10">
                      <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                      <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
                    </div>
                  </div>

                <div class="form-group">
                     <label class="col-sm-offset-1">Xác nhận mật khẩu</label>
                    <div class="input-group col-sm-offset-1 col-sm-10">
                      <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                      <input type="password" name="re_password" class="form-control" placeholder="Xác nhận mật khẩu">
                    </div>
                  </div>

                <div class="form-group">
                    <fieldset>
                        <legend><label class="col-sm-offset-1" style="font-size: 15px">Quyền Admin</label></legend>
                        <div class="input-group col-sm-offset-1 col-sm-10">
                          <label class="radio-inline">
                            <input type="radio" name="is_admin" value="0" checked="checked" > Tài khoản thường
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="is_admin" value="1"> Tài khoản Admin
                          </label>
                        </div>
                      </fieldset>
                    </div>

                <div class="form-group">
                  <fieldset>
                      <legend><label class="col-sm-offset-1" style="font-size: 15px">Trạng Thái</label></legend>
                      <div class="input-group col-sm-offset-1 col-sm-10">
                        <label class="radio-inline">
                          <input type="radio" name="active" value="1" checked="" > Kích Hoạt
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="active" value="0" > Không Kích Hoạt
                        </label>
                      </div>
                    </fieldset>
                  </div>

              </div>
              <!-- /.box-body -->
              
              <div class="box-footer col-sm-offset-1" >
                <button type="submit" class="btn btn-primary">Xác Nhận</button>
              </div>

            </form>

            <!-- End Form Here -->

          </div>
  @endsection