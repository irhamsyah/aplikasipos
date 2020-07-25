<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;

use Auth;
use Validator;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transharian=DB::table('transaksi')
        ->select('tgl_trans', DB::raw('SUM(jumlah_transaksi) as total_sales'))
        ->where('tgl_trans', date('Y-m-d'))
        ->groupBy('tgl_trans')
        ->get();
        /***Mencari tgl awal dan akhir bulan **/
        $days1month=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
    
        $d=date('Y-m-d');
        /***tgl akhir bulan kemaren**/
        $tglawal = date('Y-m-d', strtotime('-'.date('d').' days',strtotime($d))); 
                
        /***tgl akhir bulan ini**/
        $akhirbulan=date('Y-m-d', strtotime('+'.$days1month.' days',strtotime($tglawal)));
    
        /****/
        $transbulanini=DB::table('transaksi')
        ->select(DB::raw('SUM(jumlah_transaksi) as total_sales'))
        ->where('tgl_trans','>',$tglawal)
        ->where('tgl_trans','<=',$akhirbulan)
        ->get();

        /***MENCARI TGL AWAL BULAN DAN AKHIR BULAN DARI BULAN LALU***/
        /***tgl akhir bulan lalu*/
        $tglakhirbln_blnlalu = date('Y-m-d', strtotime('-'.date('d').' days',strtotime($d)));

        $days1monthbulanlalu=cal_days_in_month(CAL_GREGORIAN,date('m',strtotime($tglakhirbln_blnlalu)),date('Y',strtotime($tglakhirbln_blnlalu)));

        $tglawalbulan_blnlalu=date('Y-m-d', strtotime('-'.$days1monthbulanlalu.' days',strtotime($tglakhirbln_blnlalu)));

        $transbulanlalu=DB::table('transaksi')
        ->select(DB::raw('SUM(jumlah_transaksi) as total_sales'))
        ->where('tgl_trans','>',$tglawalbulan_blnlalu)
        ->where('tgl_trans','<=',$tglakhirbln_blnlalu)
        ->get();
        /*********************************/

        /***************Sales 1 tahun*******************/
        $tglawaltahun = date('Y')."-01-01";
        $tglakhirtahun = date('Y')."-12-31";
    
        $transsatutahun=DB::table('transaksi')
        ->select(DB::raw('SUM(jumlah_transaksi) as total_sales'))
        ->where('tgl_trans','>=',$tglawaltahun)
        ->where('tgl_trans','<=',$tglakhirtahun)
        ->get();

        /************************************************/
        $produks = Barang::paginate(8);
        return view('getting',['produks'=>$produks,'transharian'=>$transharian,'transbulanini'=>$transbulanini,'transbulanlalu'=>$transbulanlalu,'transsatutahun'=>$transsatutahun]);
    }

}
