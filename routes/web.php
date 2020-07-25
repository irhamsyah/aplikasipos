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

// Auth::routes(['verify'=> true]);
Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

//Route unutk menghindari langsung ke DASHBOARD
Route::get('login', function(){
    return view('auth.login1');
})->name('login');
//-------Batas-----------

Route::get('register',
[
    'middleware'=>'auth',
    'as'=>'register',
    'uses'=>'DaftarController@TampilkanFormRegistrasi'
]);

Route::post('register',
[
    'middleware'=>'auth',
    'as'=>'register',
    'uses'=>'Auth\RegisterController@register'

]);


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
    'uses'=>'BarangController@keranjangsimpan'
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

Route::get('simpancheckout',
[
    'as'=>'simpan.checkout.get',
    'uses'=>'BarangController@keranjangcheckout'
]);

Route::get('carijatuhtempo',
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
route::post('lihatsalesreport',
[
    'middleware'=>'auth',
    'as'=>'cari.sales.report',
    'uses'=>'ExportController@export'

]);

Route::get('trans/export/', 'ExportController@export');

Route::get('tesday',function(){
    /**jumlah hari bulan ini*/
    $days1month=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
    
    $d=date('Y-m-d');
    $tglawalbln = date('Y-m-d', strtotime('-'.date('d').' days',strtotime($d))); //operasi penjumlahan tanggal sebanyak 6 hari
    
    /**jumlah hari bulan lalu*/
        /***tgl akhir bulan lalu*/
        $tglakhirbln_blnlalu = date('Y-m-d', strtotime('-'.date('d').' days',strtotime($d)));

    $days1monthbulanlalu=cal_days_in_month(CAL_GREGORIAN,date('m',strtotime($tglakhirbln_blnlalu)),date('Y',strtotime($tglakhirbln_blnlalu)));

    $tglawaltahun = date('Y')."-01-01";
    $tglakhirtahun = date('Y')."-12-31";

    $tglawalbulan_blnlalu=date('Y-m-d', strtotime('-'.$days1monthbulanlalu.' days',strtotime($tglakhirbln_blnlalu)));

    return $tglakhirtahun;
});

Route::get('resetpassword',
[
    'middleware'=>'auth',
    'as'=>'reset.password',
    'uses'=>'Auth\ResetPasswordController@bukafomreset'
]);

Route::post('simpanresetpaswd',
[
    'middleware'=>'auth',
    'as'=>'reset.password.save',
    'uses'=>'Auth\ResetPasswordController@simpanresetpasswd'
]);
