<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Validator;
use Gate;
use Auth;
use App\User;
use App\UserProfile;
use App\UserPermit;
use Hash;

class AdminController extends Controller
{
     public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function getUsers(){
    	$users = User::orderBy('name')->paginate(8);
    	return view('admin.users',compact('users'));
    }

    public function getRegister(){
        if(Gate::allows('create-user',Auth::user()))
        {
    	   return view('admin.register');
        }

        return redirect()->back();
        
    }

    public function postChangePassword(Request $rq,$id){
            $validator = Validator::make($rq->all(),[
                    'old_password' => 'required',
                    'password'=>'required|min:6|max:50',
                    're_password'=>'same:password'
                ],[
                    'old_password.required'=> 'Bạn chưa nhập mật khẩu cũ.',
                    'password.required' => 'Bạn chưa nhập mật khẩu mới.',
                    'password.min' => 'Mật khẩu mới phải lơn hơn 6 ký tự.',
                    'password.max' => 'Mật khẩu mới quá dài.',
                    're_password.same' => 'Mật khẩu không khớp.'
                ]);
             
             // Get Json validate data send to Ajax
            if ($validator->fails())
                {
                    return response()->json(['errors'=>$validator->errors()->all()]);
                }

            $user = User::find($id);
            if(Hash::check($rq->old_password, $user->password)){
                $user->password = bcrypt($rq->password);
                $user->save();
                return response()->json(['thanhcong'=>'Đổi mật khẩu thành công !']);
            }else{
              
                return response()->json(['thatbai'=>'Mật khẩu cũ không chính xác.']);
            }
    }

    public function getDeleteUser($id){
        if(Gate::allows('delete-user',Auth::user()))
        {
            if(Auth::user()->id==$id){
                 return redirect()->route('quanlyuser')->with('error','Bạn không thể xóa tài khoản của chính mình');
            }
            else{
                $users = User::all();
                foreach($users as $u){
                    if($u->id == $id){
                        User::find($id)->delete();
                        return redirect()->route('quanlyuser')->with('thanhcong','Đã xóa thành công !');
                    }
                }
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    public function postUpdateUser(Request $rq,$id){
        if(Gate::allows('update-user',Auth::user()))
        {
                if(Auth::user()->id==$id){
                     return response()->json(['thatbai'=>'Bạn không thể cập nhật tài khoản của chính mình']);
                 }
                else{
                    $user = User::find($id);
                    $user->position = $rq->position;
                    $user->is_admin = $rq->is_admin;
                    $user->active = $rq->active;
                 
                 //Set view-user permission
                    if(UserPermit::where('user_id',$id)->where('permit','view-user')->count()==0){
                        if($rq->has('view')){
                            $permit = new UserPermit();
                            $permit->user_id = $id;
                            $permit->permit = $rq->view;
                            $permit->save();
                        }
                    }else{
                        if($rq->has('view')){
                            
                        }else{
                            UserPermit::where('user_id',$id)->where('permit','view-user')->delete();
                        }
                    }

                //Set create-user permission
                    if(UserPermit::where('user_id',$id)->where('permit','create-user')->count()==0){
                        if($rq->has('create')){
                            $permit = new UserPermit();
                            $permit->user_id = $id;
                            $permit->permit = $rq->create;
                            $permit->save();
                        }
                    }else{
                        if($rq->has('create')){
                            
                        }else{
                            UserPermit::where('user_id',$id)->where('permit','create-user')->delete();
                        }
                    }

                //Set update-user permission
                    if(UserPermit::where('user_id',$id)->where('permit','update-user')->count()==0){
                        if($rq->has('update')){
                            $permit = new UserPermit();
                            $permit->user_id = $id;
                            $permit->permit = $rq->update;
                            $permit->save();
                        }
                    }else{
                        if($rq->has('update')){
                           
                        }else{
                             UserPermit::where('user_id',$id)->where('permit','update-user')->delete();
                        }
                    }

                //Set delete-user permission
                    if(UserPermit::where('user_id',$id)->where('permit','delete-user')->count()==0){
                        if($rq->has('delete')){
                            $permit = new UserPermit();
                            $permit->user_id = $id;
                            $permit->permit = $rq->delete;
                            $permit->save();
                        }
                    }else{
                        if($rq->has('delete')){
                            
                        }else{
                            UserPermit::where('user_id',$id)->where('permit','delete-user')->delete();
                        }
                    }
                // End check Permissions

                $user->save();
                return response()->json(['thanhcong'=>'Cập nhật tài khoản thành công']);
                }
        }
            return redirect()->back();
    }

    public function getSearchUser(Request $rq){
        if($rq->search == ''){
            return redirect()->route('quanlyuser');
        }else{
            $users = User::where('email','like','%'.$rq->search.'%')
                        ->where('name','like','%'.$rq->name.'%')
                        ->orWhere('phone','like','%'.$rq->search.'%')->paginate(7);

            if($users->count() == 0){
                return redirect()->back()->with('thongbao','Không tìm thấy kết quả nào phù hợp.');
            }

            return view('admin.users',compact('users'));
        }
    }

    public function getProfile($id){
        if(Auth::user()->id == $id){
        	$user = User::find($id);
        	return view('admin.profile',compact('user'));
        }else{
            return redirect()->back();
        }
    }

    public function getUpdateProfile($id){
        if(Auth::user()->id == $id){
                $user = User::find($id);
                return view('admin.updateprofile',compact('user'));
            }
            else{
                return redirect()->back();
        }
    }

    public function postUpdateProfile(UpdateProfileRequest $rq,$id){
       $user = User::find($id);
       $user->name = $rq->name;
       $user->phone = $rq->phone;
       $user->userprofile->user_id=$id;
       $user->userprofile->birthday = $rq->birthday;
       $user->userprofile->address = $rq->address;
       $user->userprofile->sex = $rq->sex;
       $user->userprofile->description = $rq->description;

       if($rq->hasFile('avatar')){
            $file = $rq->file('avatar');
            $filename = $file->getClientOriginalName();
            $file->move('source/avatar/',$filename);
            $user->userprofile->avatar = $filename;
       }

       $user->save();
       $user->userprofile->save();

       return redirect()->route('profile',$id)->with('thanhcong','Cập nhật thành công !');
    }

    public function postRegister(RegisterRequest $rq){
    	$user = new User();
        $profile = new UserProfile();
    	$user->name = $rq->name;
    	$user->email = $rq->email;
    	$user->phone = $rq->phone;
    	$user->position = $rq->position;
    	$user->password = bcrypt($rq->password);
    	$user->is_admin = $rq->is_admin;
    	$user->active = $rq->active;
    	$user->save();
        $profile->user_id=$user->id;
        $profile->avatar = 'avatar_default.png';
        $profile->save();

    	return redirect()->route('quanlyuser')->with('thanhcong','Bạn đã tạo tài khoản thành công !');
    }

}
