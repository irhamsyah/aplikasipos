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

//Route unutk menghindari langsung ke DASHBOARD
Route::get('login', function(){
    return view('auth.login1');
})->name('login');
//-------Batas-----------

Route::get('/home', 'HomeController@index')->name('home');

Route::get('adminlogin',
[
    'middleware'=>'auth',
    'as'=>'lihatproduk',
    'uses'=>'BarangController@index'

]);

Route::post('adminlogin',       
[
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
Route::get('/',
[
    'middleware'=>'auth',
    'as'=>'index',
    'uses'=>'BarangController@index'
]);

Route::get('/produk/{id}','BarangController@detail')->name('produkdetail');

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


Route::post('simpantransaksi',
[
    'as'=>'simpantransaksi',
    'uses'=>'BarangController@simpantransaksi'
]);

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

Route::get('inputdatareseller', 
[
    'as'=>'inputdatareseller',
    'uses'=>'BarangController@inputdatareseller'
]);

Route::post('simpaninputreseller',
[
    'as'=>'simpaninputreseller',
    'uses'=>'BarangController@simpaninputreseller'
]);

Route::get('listreseller', 
[   
    'middleware'=>'auth',
    'as'=>'listreseller',
    'uses'=>'BarangController@listreseller'
]);

Route::delete('hapusreseller/{id}', 
[
    'as'=>'hapusreseller',
    'uses'=>'BarangController@hapusreseller'
]);

Route::get('editreseller/{id}',
[
    'middleware'=>'auth',
    'as'=>'editreseller',
    'uses'=>'BarangController@editreseller'
]);

Route::get('inputransaksireseller', 
[   
    'middleware'=>'auth',
    'as'=>'inputransaksireseller',
    'uses'=>'BarangController@inputransaksireseller'
]);

Route::get('detailproduk/{id}',
[
    'middleware'=>'auth',
    'as'=>'detailproduk',
    'uses'=>'BarangController@detailproduk'
]);

Route::get('keranjang',
[
    'middleware'=>'auth',
    'as'=>'keranjang',
    'uses'=>'BarangController@keranjangindex'
]);

Route::post('keranjang/{id}',
[
    'middleware'=>'auth',
    'as'=>'keranjang.simpan',
    'uses'=>'BarangController@keranjang'
]);

Route::post('keranjangupdate',
[
    'middleware'=>'auth',
    'as'=>'keranjang.update',
    'uses'=>'BarangController@keranjangupdate'
]);

Route::get('keranjangdelete/{id}',
[
    'middleware'=>'auth',
    'as'=>'keranjang.delete',
    'uses'=>'BarangController@keranjangdelete'
]);

Route::get('keranjangcheckout',
[
    'middleware'=>'auth',
    'as'=>'keranjang.checkout',
    'uses'=>'BarangController@keranjangcheckout'
]);

Route::post('simpancheckout',
[
    'as'=>'simpan.checkout',
    'uses'=>'BarangController@simpancheckout'
]);

Route::get('formcarijt',
[
    'middleware'=>'auth',
    'as'=>'lihatjatuhtempo',
    'uses'=>'BarangController@lihatjatuhtempo'
]);

route::post('carijatuhtempo',
[
    'middleware'=>'auth',
    'as'=>'cari.jatuh.tempo',
    'uses'=>'BarangController@carijatuhtempo'
]);
route::get('report',
[
    'as'=>'tesreport',
    'uses'=>'BarangController@tesreport'
]);

route::get('lihatsalesreport',
[
    'middleware'=>'auth',
    'as'=>'lihatsalesreport',
    'uses'=>'BarangController@formlihatsalesreport'

]);
route::post('carisalesreport',
[
    'middleware'=>'auth',
    'as'=>'cari.sales.report',
    'uses'=>'BarangController@carisalesreport'

]);

Route::get('trans/export/', 'ExportController@export');