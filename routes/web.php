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

Route::get('/','ProductController@index')->name('index');
Route::get('/contact','PageController@contact')->name('contact');
Route::resource('products','ProductController');
Route::post('/products/search','ProductController@searchProduct')->name('product.search');
Route::get('/products/category/{id}','ProductController@categorySearch')->name('product.categorySearch');
Route::get('/products/brand/{id}','ProductController@brandSearch')->name('product.brandSearch');
Route::get('/admin_page/products','AdminPageController@products')->name('admin_page.products');
Route::post('/admin_page/imgDelete/{id}','AdminPageController@imgDelete')->name('admin_page.imgDelete');

Route::resource('admin_page','AdminPageController');
Route::resource('categories','CategoryController');
Route::resource('brands','BrandController');
Route::resource('users','UserController');
Route::resource('carts','CartController');
Route::resource('orders','orderController');
//Route::resource('admins','AdminController');

//admin login

Route::get('/admin/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login/submit', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
Route::post('/admin/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');

//admin forget password
Route::get('admin/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin/password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
//admin password reset

Route::get('admin/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm' )->name('admin.password.reset');
Route::post('admin/password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('admin.password.update');

//admin logout
Route::post('admin/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/{token}', 'VerificationController@verify')->name('user.verification');
Auth::routes();

Route::get('/users/change/password','UserController@changePasswordView')->name('users.change.password.view');
Route::post('/users/change/password','UserController@changePassword')->name('users.change.password');