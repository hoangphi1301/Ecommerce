@extends('layouts.master')
@section('content')
<div class="box box-primary" style="padding:50px 150px 50px 150px">
            <div class="box-header with-border" style="background-color:AliceBlue">
              <h4 class="box-title"><b>Chỉnh sửa Profile của bạn</b></h4>
            
            </div>
          <!-- Show messages from Server -->
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
          <!-- End Show messages -->

          <!-- Start Form -->

            <form role="form" action="{{route('updateprofile',$user->id)}}" method="post" enctype="multipart/form-data" >
              <input type="hidden" name="_token" value="{{csrf_token()}}">

              <div class="box-body">
                <div align="center">
                  <label style="display: block;">Ảnh Đại Diện Của Bạn</label>
                  <img id="imgClick" class="img-circle" src="source/avatar/{{$user->userprofile->avatar}}" width="100px" height="100px">
                  <input type="file" name="avatar" style="display: none;" id="ipFile" accept="image/*" >
                </div>

                <div class="form-group">
                     <label class="col-sm-offset-1">Họ Tên</label>
                    <div class="input-group col-sm-offset-1 col-sm-10">
                      <span class="input-group-addon"><i class="fa  fa-user"></i></span>
                      <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Nhập họ tên">
                    </div>
                  </div>

                <div class="form-group">
                    <label class="col-sm-offset-1">Email</label>
                    <div class="input-group col-sm-offset-1 col-sm-10">
                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                      <input disabled="true" value="{{$user->email}}" type="email" class="form-control" placeholder="Email">
                    </div>
                  </div>
              
                <div class="form-group">
                      <label class="col-sm-offset-1">Số điện thoại</label>
                    <div class="input-group col-sm-offset-1 col-sm-10">
                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                      <input type="text" name="phone" value="{{$user->phone}}" class="form-control" placeholder="Nhập số điện thoại">
                    </div>
                  </div>

                <div class="form-group">
                    <label class="col-sm-offset-1">Ngày Sinh</label>
                    <div class="input-group col-sm-offset-1 col-sm-10">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input class="form-control" name="birthday" type="date" value="{{$user->userprofile->birthday}}" min="1945-01-01" max="2020-01-01">
                   </div>
                 </div>

                <div class="form-group">
                    <label class="col-sm-offset-1">Địa chỉ</label>
                     <div class="input-group col-sm-offset-1 col-sm-10">
                      <span class="input-group-addon"><i class="fa fa-home"></i></span>
                      <input type="text" value="{{$user->userprofile->address}}" name="address" class="form-control" placeholder="Nhập địa chỉ">
                    </div>
                  </div>
                
                <div class="form-group">
                      <label class="col-sm-offset-1" style="font-size: 15px">Giới tính</label>
                     <div class="input-group col-sm-offset-1 col-sm-10">
                      @if($user->userprofile->sex == 0)
                      <label class="radio-inline">
                          <input type="radio" name="sex" value="1"> Nam
                        </label>
                      <label class="radio-inline">
                           <input type="radio" checked="" name="sex" value="0"> Nữ
                      </label>
                       @else
                       <label class="radio-inline">
                          <input type="radio" checked name="sex" value="1"> Nam
                        </label>
                       <label class="radio-inline">
                          <input type="radio" name="sex" value="0"> Nữ
                      </label>
                      @endif
                    </div>
                </div>
            
              <div class="form-group">
                    <label class="form-group col-sm-offset-1">Thêm về bạn</label>
                    <div class="form-group col-sm-offset-1 col-sm-10">
                    <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{$user->userprofile->description}}</textarea>
                  </div>
              </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer col-sm-offset-1">
                <button type="submit" class="btn btn-primary">Thay Đổi</button>
              </div>
            </form>

<!-- End Form Here -->

          </div>

@endsection

@section('footer_scripts')

<script type="text/javascript">
  
  $(document).ready(function(){
        $('#imgClick').click(function(){
            $('#ipFile').click();
        });

        // Script Change avatar when click chose file
          function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#imgClick').attr('src', e.target.result);
              }            
              reader.readAsDataURL(input.files[0]);                       
            }
          }

          $("#ipFile").change(function(){
              readURL(this);
          });
          // End Script change avatar
  });

</script>

@endsection