<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

// note that  the prefix is admin for all file route

Route::group([
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth:admin' , 'prefix'=>'admin'], function () {
    
   Route::get('/','DashboardController@index')->name('admin.dashboard'); // the first page admin visits if auth;
    
    Route::group(['prefix' => 'settings'],function(){
      
      Route::get('shipping-methods/{type}','SettingsController@editShippingMethods')-> name('edit.shippings.methods');
      Route::PUT('shipping-methods/{id}','SettingsController@updateShippingMethods')-> name('update.shippings.methods');
    });

 });


 Route::group(['namespace' => 'Dashboard','prefix'=>'admin'],function(){
   
    Route::get('login','LoginController@login')-> name('admin.login');
    Route::post('login','LoginController@postLogin')-> name('admin.post.login');
 });

 

});