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
    // return view('auth.login1');
    return view('getting');
})->middleware('auth');;

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

Route::get('/logout',
[
        'as'=>'logout',
        'uses'=>'BarangController@logout'
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

//Proses memunculkan list barang yg akan diedit atau didelete
Route::get('editdatabarang', 
[
    'middleware'=>'auth',
    'as'=>'editdatabarang',
    'uses'=>'BarangController@editbarang'
]
);

/*Proses setelah pilih data yg akan diedit serta memunculkan form edit*/
Route::get('editbarang/{id}',
[
    'middleware'=>'auth',
    'as'=>'editbarang',
    'uses'=>'BarangController@editbarangid'
]
);
//proses update pada database
Route::post('updatedatabarang',
[
    'as'=>'updatedatabarang',
    'uses'=>'BarangController@updatedatabarang'
]);
//Prose delete pada database
Route::delete('/hapusbarang/{barang_id?}',
[
    'as'=>'hapusbarang',
    'uses'=>'BarangController@hapusbarang'

]);
//Proses tampilan data yang akan ditransaksikan
Route::get('inputransaksi', 
[   
    'middleware'=>'auth',
    'as'=>'inputransaksi',
    'uses'=>'BarangController@inputransaksi'
]);

//Menampilakn form yang ditransaksikan
Route::get('inputtransaksi/{id}', 
[   
    'middleware'=>'auth',
    'as'=>'inputtransaksiid',
    'uses'=>'BarangController@inputtransaksiid'
]);


Route::post('/simpantransaksi/{id}',
[
    'as'=>'simpantransaksi',
    'uses'=>'BarangController@simpantransaksi'
]
);

Route::get('listtransaksi', 
[   
    'middleware'=>'auth',
    'as'=>'listtransaksi',
    'uses'=>'BarangController@listtransaksi'
]);

Route::delete('hapustransaksi/{id}', 
[
    'as'=>'hapustransaksi',
    'uses'=>'BarangController@hapustransaksi'

]);

Route::get('edittransaksi/{id}',
[
    'middleware'=>'auth',
    'as'=>'edittransaksi',
    'uses'=>'BarangController@edittransaksi'

]);
Route::post('simpanupdatetransaksi/{id}',
[
    'as'=>'simpanupdatetransaksi',
    'uses'=>'BarangController@simpanupdatetransaksi'
]);

Route::get('tes', 
[
    'as'=>'tes',
    'uses'=>'BarangController@tes'
]
);