<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('thong-bao',function(){
	return view('message');
})->name('message');

Route::get('dang-xuat','AdminController@getLogout')->name('dangxuat');

Route::group(['prefix'=>'admin','middleware'=>'checkadminlogin'],function(){

		Route::get('quan-ly-user','AdminController@getUsers')->name('quanlyuser');

		Route::get('dang-ky','AdminController@getRegister')->name('dangky');

		Route::post('dang-ky','AdminController@postRegister')->name('dangky');
			
		Route::post('doi-mat-khau/{id}','AdminController@postChangePassword')->name('changepassword');

		Route::get('xoa-user/{id}','AdminController@getDeleteUser')->name('deleteuser');

		Route::post('cap-nhat-user/{id}','AdminController@postUpdateUser')->name('updateuser');

		Route::get('tim-kiem','AdminController@getSearchUser')->name('searchuser');

		Route::get('ho-so/{id}','AdminController@getProfile')->name('profile');
			
		Route::get('chinh-sua-ho-so/{id}','AdminController@getUpdateProfile')->name('updateprofile');
			
		Route::post('chinh-sua-ho-so/{id}','AdminController@postUpdateProfile')->name('updateprofile');
			
});

Route::group(['prefix'=>'page','middleware'=>'checkadminlogin'],function(){

	Route::get('san-pham','PageController@getProducts')->name('products');

	Route::get('them-san-pham','PageController@getCreateProduct')->name('createproduct');

	Route::post('them-san-pham','PageController@postCreateProduct')->name('createproduct');

	Route::get('tim-kiem-san-pham','PageController@getSearchProduct')->name('searchproduct');

	Route::post('cap-nhat-chi-tiet/{id}','PageController@postUpdateDetailProduct')->name('updatedetail');

	Route::get('xoa-san-pham/{id}','PageController@getDeleteDetailProduct')->name('deletedetail');

	Route::get('thuoc-tinh-san-pham','PageController@getViewAttributeProduct')->name('viewattributeproduct');

	Route::post('them-loai-san-pham','PageController@postInsertProductType')->name('insertproducttype');

	Route::post('sua-loai-san-pham/{id}','PageController@postUpdateProductType')->name('updateproducttype');

	Route::get('xoa-loai-san-pham/{id}','PageController@getDeleteProductType')->name('deleteproducttype');

	Route::post('them-thuong-hieu','PageController@postInsertBrand')->name('insertbrand');

	Route::post('sua-thuong-hieu/{id}','PageController@postUpdateBrand')->name('updatebrand');

	Route::get('xoa-thuong-hieu/{id}','PageController@getDeleteBrand')->name('deletebrand');

	Route::post('them-mau-sac','PageController@postInsertColor')->name('insertcolor');

	Route::post('sua-mau-sac/{id}','PageController@postUpdateColor')->name('updatecolor');

	Route::get('xoa-mau-sac/{id}','PageController@getDeleteColor')->name('deletecolor');

	Route::get('category','PageController@getViewCategory')->name('viewcategory');

	Route::post('them-category','PageController@postInsertCategory')->name('insertcategory');

	Route::post('cap-nhat-category/{id}','PageController@postUpdateCategory')->name('updatecategory');

	Route::get('xoa-category/{id}','PageController@getDeleteCategory')->name('deletecategory');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
