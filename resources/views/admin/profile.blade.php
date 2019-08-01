@extends('layouts.master')
@section('content')

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
             

<div id="content" style="display: contents;">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="source/avatar/{{$user->userprofile->avatar}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$user->name}}</h3>

              <p class="text-muted text-center"><i>Ngày tham gia {{$user->created_at}}</i></p>

              <ul class="list-group list-group-unbordered" style="width: 400px;margin: auto; ">
                <li class="list-group-item">
                  <b>Email</b> <p class="pull-right">{{$user->email}}</p>
                </li>
                <li class="list-group-item">
                  <b>Số điện thoại</b> <p class="pull-right">{{$user->phone}}</p>
                </li>
                <li class="list-group-item">
                  <b>Ngày sinh</b> <p class="pull-right">    
                    {{$user->userprofile->birthday}}
                  </p>
                </li>
                 <li class="list-group-item">
                  <b>Địa chỉ</b> <p class="pull-right">
                    
                    {{$user->userprofile->address}}
                   
                  </p>
                </li>
                 <li class="list-group-item">
                  <b>Giới tính</b> <p class="pull-right">
                  @if($user->userprofile->sex == 0)
                      Nữ
                      @else
                      Nam
                  @endif
                  </p>
                </li>
                <li >
                  <!-- Click show Modal Change Password -->
                  <a href="" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" class="pull-right" style="margin:10px;"><u><i>Đổi mật khẩu?</i></u></a>
              
                </li>
              </ul>
              
              <a href="{{route('updateprofile',$user->id)}}" class="btn btn-primary btn-block" style="width: 150px; margin: 20px auto;"><b>Chỉnh sửa</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About you box -->
          <div class="box box-info">
                <div class="callout callout-info">
                <h4 style="color: AliceBlue;">Thêm về bạn</h4>
                <p>{{$user->userprofile->description}}.</p>
              </div>     
          </div>
          <!-- /.box -->
        </div>



     <!-- Start Modal Change Password-->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content" >

                <div class="modal-header" style="background-color: AliceBlue">          
                    <h4 class="modal-title"><b>Đổi mật khẩu</b></h4>
                </div>

                <div class="modal-body">
                     <form id="frmChangePasswrd" role="form" action="{{route('changepassword',$user->id)}}" method="post">
                     

                      <div class="form-group">

                          <label class="col-sm-offset-1">Mật khẩu cũ</label>
                          <div class="input-group col-sm-9 col-sm-offset-1">
                            <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                            <input type="password" name="old_password" class="form-control ipPassword" placeholder="Nhập mật khẩu cũ">
                          </div>
                        </div>

                        <div class="form-group">
                         <label class="col-sm-offset-1">Mật khẩu mới</label>
                          <div class="input-group col-sm-9 col-sm-offset-1">
                            <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                            <input type="password" name="password" class="form-control ipPassword" placeholder="Nhập mật khẩu mới">
                          </div>
                        </div>

                        <div class="form-group">
                         <label class="col-sm-offset-1">Xác nhận mật khẩu</label>
                          <div class="input-group col-sm-9 col-sm-offset-1">
                            <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                            <input type="password" name="re_password" class="form-control ipPassword" placeholder="Xác nhận mật khẩu">
                          </div>
                        </div>

                      </div>

                      <div class="modal-footer" style="background-color:AliceBlue">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <input type="submit"  id="btnSubmit" class="btn btn-primary" value="Xác Nhận">
                        </div>

                      </div>

                    </form>
                   
                      <div id="thongbao"></div>
                </div>
                
              </div>
            </div>
          </div>

          <!-- End Modal Change Password -->

@endsection

@section('footer_scripts')  

<script type="text/javascript">
$(document).ready(function(){
   $(function(){

    // CSRF Token Here
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

      // Ajax Change Password
      $('#btnSubmit').click(function(e){
          e.preventDefault();
          $.ajax({
              url: $('#frmChangePasswrd').attr('action'),
              type: 'POST', 
              data: $('#frmChangePasswrd').serialize(),
              success: function(data){
                   console.log(data);
                   $.each(data,function(key,value){
                    $('#thongbao').html(''); 
                          for($i=0;$i<value.length;$i++){
                            if(key=='errors'){
                              $('#thongbao').attr('class','alert alert-danger');
                              $('#thongbao').append(value[$i] + '<br>');            
                            }
                           
                            if(key=='thatbai'){
                              $('#thongbao').attr('class','alert alert-danger');
                              $('#thongbao').append(value[$i]);  
                            }

                           if(key=='thanhcong'){
                              $('.ipPassword').val('');
                              $('#thongbao').attr('class','alert alert-success');
                              $('#thongbao').append(value[$i]);  
                            }
                            
                          }
                   });

              }
          });
      });
      // End Ajax
    });
});
       
</script>

@endsection