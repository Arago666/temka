<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    broadcast(new \App\Events\WebsocketDemoEvent('some data'));
    return view('welcome');
});

Route::get('/chats','ChatsController@index');
Route::get('/messages','ChatsController@fetchMessages');
Route::post('/messages','ChatsController@sendMessage');



Route::group(['namespace' => 'Games\Catan'], function (){
//    Route::get('/games/catan','CatanController@index');
    Route::get('/games/cardposition/{game_number}','CatanController@getCatanCardPosition');
    Route::get('games/coordinateelements','CatanController@getCatanCoordinateElements');
    Route::get('/games/playercolor/{game_number}','CatanController@getCatanPlayerColor');
    Route::get('/games/buildings/{game_number}','CatanController@getBuildings');
    Route::get('/games/playercards/{game_number}','CatanController@getPlayerCards');
    Route::get('/games/getknightposition/{game_number}','CatanController@getKnightPosition');


    Route::resource('/games/catan', 'CatanController')->except([
        'store', 'update', 'destroy'
    ])->names('catan');
    Route::post('/games/catan/color','CatanController@ChoseColor');
    Route::post('/games/catan/addbuildingtodb','CatanController@AddBuildingToDb');
    Route::post('/games/catan/delbuildingfromdb','CatanController@DelBuildingFromDb');
    Route::post('/games/catan/addresourcetoplayer','CatanController@AddResToPlayer');
    Route::post('/games/catan/delresourcefromplayer','CatanController@DelResFromPlayer');
    Route::post('/games/catan/changeknightposition','CatanController@changeKnightPosition');






});

