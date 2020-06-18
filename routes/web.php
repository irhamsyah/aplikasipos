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

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();
Route::get('/', function(){
    return view('auth.login1');
});

//Route unutk menghindari langsung ke DASHBOARD
Route::get('login', function(){
    return view('auth.login1');
})->name('login');
//-------Batas-----------

Route::get('/home', 'HomeController@index')->name('home');

Route::get('adminlogin', function () {
    // Only authenticated users may enter...
    return view('getting');

})->middleware('auth');

Route::post('adminlogin',             [
    'as'=>'adminlogin',
    'uses'=>'BarangController@adminlogin'
    ]);

// Route::get('inputdata', function () {
//     return view('forminputdata');
// })->name('inputdata')->middleware('auth');

Route::get('inputdatabarang', 
[   
    'middleware'=>'auth',
    'as'=>'inputdatabarang',
    'uses'=>'BarangController@createbarang'
]);

Route::post('simpaninputbarang', 
[
    'as'=>'simpaninputbarang',
    'uses'=>'BarangController@simpaninputbarang'
]
);

Route::get('editdatabarang', 
[
    'middleware'=>'auth',
    'as'=>'editdatabarang',
    'uses'=>'BarangController@editbarang'
]
);

/*Proses setelah pilih data yg akan diedit atau di delete*/
Route::get('editbarang/{id}',
[
    'middleware'=>'auth',
    'as'=>'editbarang',
    'uses'=>'BarangController@editbarangid'
]
);

Route::post('updatedatabarang',
[
    'as'=>'updatedatabarang',
    'uses'=>'BarangController@updatedatabarang'
]);

Route::delete('/hapusbarang/{barang_id?}',
[
    'as'=>'hapusbarang',
    'uses'=>'BarangController@hapusbarang'

]);

