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
    Route::get('/games/catan/cardposition/{game_number}','CatanController@getCatanCardPosition');
    Route::get('games/catan/coordinateelements','CatanController@getCatanCoordinateElements');
    Route::get('/games/catan/playercolor/{game_number}','CatanController@getCatanPlayerColor');
    Route::get('/games/catan/buildings/{game_number}','CatanController@getBuildings');
    Route::get('/games/catan/playercards/{game_number}','CatanController@getPlayerCards');
    Route::get('/games/catan/getknightposition/{game_number}','CatanController@getKnightPosition');
    Route::get('/games/catan/getplayers/{game_number}','CatanController@getPlayers');
//    Route::get('/games/catan/addresfromdice/{game_number}','CatanController@AddResourceFromDice');

    Route::resource('/games/catan', 'CatanController')->except([
        'store', 'update', 'destroy'
    ])->names('catan');
    Route::post('/games/catan/color','CatanController@ChoseColor');
    Route::post('/games/catan/addbuildingtodb','CatanController@AddBuildingToDb');
    Route::post('/games/catan/delbuildingfromdb','CatanController@DelBuildingFromDb');
    Route::post('/games/catan/addresourcetoplayer','CatanController@AddResToPlayer');
    Route::post('/games/catan/addresourcetoplayerfromtable','CatanController@AddResToPlayerFromtable');
    Route::post('/games/catan/delresourcefromplayer','CatanController@DelResFromPlayer');
    Route::post('/games/catan/changeknightposition','CatanController@changeKnightPosition');
    Route::post('/games/catan/trowdice','CatanController@TrowDice');
    Route::post('/games/catan/stealres','CatanController@StealRes');
    Route::post('/games/catan/addresfromdice','CatanController@AddResourceFromDice');
});




Route::group(['namespace' => 'Games\CardWars'], function (){

    Route::resource('/games/cardwars', 'CardWarsController')->except([
        'update', 'destroy','edit','create'
    ])->names('cardwars');

});
