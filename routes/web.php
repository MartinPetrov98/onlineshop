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


Route::get('/', function () {
    return view('welcome');
});
 
 */


Route::get('/', 'IndexController@rendTemplate');




Route::get('/', 'IndexController@getData');


Route::get('register','RegisterController@Registerform');

Route::post('register','RegisterController@Registerauth');



Route::get('login','RegisterController@Loginform');

Route::post('login','RegisterController@Loginauth');


Route::get('Category/{name?}', 'DataController@GetCategories');

#Route::post('Category/{name?}', 'DataController@AjaxReturn');


Route::get('Category/{name}/Subcategory/{certainproduct?}', 'DataController@CertainProducts');

#Route::post('Category/{name}/Subcategory/{certainproduct?}', 'DataController@AjaxReturn');

Route::get('Category/{name}/Subcategory/{certainproduct}/Brand/{brand?}', 'DataController@getBrandItems');

Route::get('item/{id}','DataController@getItem');

#Route::post('Category/{name?}/Subcategory/{certainproduct?}/Brand/{brand?}', 'DataController@AjaxReturn');

Route::get('user','IndexController@receiveShippingData');


Route::get('search', ['as'=>'search','uses'=>'IndexController@globalData']);

Route::post('addtochart',['as'=>'addtochart','uses'=>'indexController@chartSession']);

/*
Route::get('Cart',function(){
    return view('templates.chart');
});
*/

Route::get('Cart','DataController@getShippingData');

Route::post('Order','DataController@postShoppingData');



#Route::post('Order','DataController@getShippingData');

Route::post('postcomment',['as'=>'postcomment','uses'=> 'DataController@comment']);



Route::delete('remove/{id}','indexController@deleteItem');



Route::get('exit', 'IndexController@SessDestroy');
























   






