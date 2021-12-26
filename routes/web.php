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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','SKOIRegister\routingManagement@index');
Route::match(['get','post'],'/register','SKOIRegister\routingManagement@register');
Route::get('/rule','SKOIRegister\routingManagement@rule');
Route::get('/contact','SKOIRegister\routingManagement@contact');
Route::match(['get','post'],'/viewregisterlist','SKOIRegister\routingManagement@viewregisterlist');
Route::any('{query}','SKOIRegister\routingManagement@redirecthome')->where('query','.*');
