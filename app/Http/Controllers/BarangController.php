<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Satuan;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Reseller;
use App\Models\Keranjang;
use App\Models\Pembeli;
use App\Models\Suratjalan;
use App\Models\Fakturjual;

use App\Users;
use App;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use Hash;
use Image;
use Mail;
use PDF;

class BarangController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
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

    public function detail($id)
    {
        return $id;
    }
    public function logout()
    {
            Auth::logout();
            return view('auth.login1');
    }

    public function adminlogin(Request $req)
    {
        if(Auth::attempt(['email'=>$req->input('email'),'password'=>$req->input('password')]))
        {
            // return view('getting',array('request'=>$req));
            // dd($req);
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
        else
        {
        return view('auth.login1');
        }
        // dd($req);
    }

    public function createbarang()
    {
        return view('forminputdata');
    }

    public function simpaninputbarang(Request $request)
    {
        // dd($request);
        $this->validate($request, [ 
            'barang_id' => 'required|unique:barang',
            'nama_brg' => 'required',
            'harga_brg'=>'required',
            'harga_jual'=>'required',
            // 'harga_jual_reseller'=>'required',
            'satuan',
            'isi_persatuan',
            'jumlah_brg',

            // not using `image` rule, as that will allow 
            'photo'
        ]);
        
        if (!empty($request->barang_id)){
            // $data = $request->only('barang_id', 'nama_brg','harga_brg','harga_jual','harga_jual_reseller','satuan','isi_persatuan','jumlah_brg','photo');
            $data = $request->only('barang_id', 'nama_brg','harga_brg','harga_jual','satuan','isi_persatuan','jumlah_brg','photo');

        }
        // else{
        // $data = $request->only('productandalus_id', 'namaproduk','jenispenerbangan','lama','photo','rundown','regidr');
        // }

        // Don't overcomplicate, just upload to public/img folder and log the file name
        // In the future, maybe we would do some processing like resize or crop it.
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            Image::make($file)->resize(198, 132)->save('img/'.$file->getClientOriginalName());
            // $file->move('./img',$file->getClientOriginalName());
            $data['photo'] = $file->getClientOriginalName();
        }

        $barang = Barang::create($data);

            session()->flash('message', 'Data' . $barang->nama_brg .' Saved');
            session()->flash('type', 'success');
            return redirect()->route('inputdatabarang');
        
    }

    //Munculkan list data barang yg akan Edit or delete
    public function editbarang()
    {
        $barang = Barang::latest()->get();
        return view('listbarang', compact('barang'));
    }
    
    public function editbarangid($barang_id)
    {
        $hasil_a=Barang::findOrFail($barang_id);
        return view('frmeditbarang',['hasil'=>$hasil_a]);
    }

    public function updatedatabarang(Request $request)
    {
        // dd($request);
        $barang = Barang::findOrFail($request->id);
        $this->validate($request,
            [   
                'barang_id' => 'required',
                'nama_brg' => 'required',
                'harga_brg'=>'required',
                'harga_jual'=>'required',
                'satuan',
                'isi_persatuan',
                'jumlah_brg'
            ]);
        // $data = $request->only('barang_id','nama_brg','harga_brg','harga_jual','harga_jual_reseller','satuan','isi_persatuan','jumlah_brg');
        $data = $request->only('barang_id','nama_brg','harga_brg','harga_jual','satuan','isi_persatuan','jumlah_brg');

        //Ngecek Jika Perubahan Pada File Photo
        if ($request->hasFile('photo')) {

            $file=$request->file('photo');
            Image::make($file)->resize(198, 132)->save('img/'.$file->getClientOriginalName());
            // $file->move('./img',$file->getClientOriginalName());
            $data['photo'] = $file->getClientOriginalName();

        }
        $barang->update($data);

        session()->flash('message', 'Data' . $barang->nama_brg .' Updated');
        session()->flash('type', 'success');
        return redirect()->route('inputdatabarang');

    }
    public function hapusbarang($barang_id)
    {
        // dd($barang_id);
        $databrg = Barang::find($barang_id);
        $hapusbarang = Barang::where('barang_id','=', $barang_id)->delete();
        return redirect()->route('editdatabarang')->with('success',$databrg->nama_brg .' Deleted');
    }

    public function inputransaksi()
    {
        $barang = Barang::latest()->get();
        return view('formtransaksi', compact('barang'));
    }

    public function inputtransaksiid($id)
    {
        // return $id;
        $hasil_a=Barang::findOrFail($id);
        return view('forminputtransaksi',['hasil'=>$hasil_a]);
    }

    public function simpantransaksi(Request $request)
    {
        // dd($request);
        // $carinota=Pembeli::where('nota',$request->nota);
        // if(!empty($carinota))
        // {
        //     session()->flash('message', 'Nota' . $request->nota .' Sudah Ada');
        //     session()->flash('type', 'success');
        //     return redirect()->route('simpantransaksi');
        // }
        // else
        // {
            // dd($request);
            $data = $request->only('barang_id','qty');
            $cari=Keranjang::where('barang_id','=',trim($request->barang_id))->get();
            $test=0;
            foreach($cari as $value)
            {
                $test=$value->qty;
            }
            if($test>0)
            {
                $total=$test + $request->input('qty');
                /* Udapte Kernjang */
                $barang2 = Keranjang::where('barang_id',$request->barang_id)
                ->update(['qty'=>$total]) ;
            }else{
                            $data['jumlah_transaksi']=($request->input('harga_jual')-($request->input('harga_jual')*$request->input('discount')/100))*$request->input('jumlah_item_trans');

                Keranjang::create($data);
            }
            return redirect()->route('keranjang');

                   /* Proses Update Data Barang */


    //    $barang = Barang::find($id);
    //    $this->validate($request,
    //        [   
    //            'jumlah_brg' => 'required',
    //            'jumlah_item_trans' => 'required',
    //            'discount',
    //            'tgl_trans'
    //        ]);

    //    $data = $request->only('jumlah_brg');
    //    //Ngecek Jika jumlah persediaan lebih kecil dari item dijual
    //    if ($request->input('jumlah_item_trans')>$request->input('jumlah_brg')) {
    //     session()->flash('message', 'Jumlah Item yg dijual lebih besar dari persedian');
    //     session()->flash('type', 'error');
    //     return redirect()->route('inputransaksi');
    //     }
    //     else{
    //         $data['jumlah_brg']=$request->input('jumlah_brg')-$request->input('jumlah_item_trans');
    //         $barang->update($data);

    //     /*Proses Insert Transaksi*/
    //     if (!empty($id)){
    //         $data = $request->only('barang_id', 'nama_brg','jumlah_transaksi','jumlah_item_trans','tgl_trans','discount');
    //     }   
    //         $data['barang_id']=$id;
    //         $data['jumlah_transaksi']=($request->input('harga_jual')-($request->input('harga_jual')*$request->input('discount')/100))*$request->input('jumlah_item_trans');
    //         $data['tgl_trans']=date('Y-m-d',strtotime($request->input('tgl_trans')));

    //         $barang = Transaksi::create($data);
    //     /******************************************/
    //         session()->flash('message', 'Data Transaksi' . $barang->nama_brg .' Saved');
    //         session()->flash('type', 'success');
    //         return redirect()->route('inputransaksi');

    //     }

        // }

    }
    public function listtransaksi()
    {
        $transaksi = Transaksi::latest()->get();
        return view('listtransaksi', compact('transaksi'));
    }

    public function hapustransaksi($id)
    {
        // dd($id);
        $transaksi = Transaksi::find($id);
        $barang=Barang::find($transaksi['barang_id']);
        $jmlitem=$barang['jumlah_brg']+$transaksi['jumlah_item_trans'];
        /* Mengembalikan jumlah barang pada tabel Barang ke jumah Awal sebelum transaksi*/
        Barang::where('barang_id', $transaksi['barang_id'])
                ->update(['jumlah_brg' => $jmlitem]);

        $hapustransaksi = Transaksi::where('id','=', $id)->delete();
        return redirect()->route('listtransaksi')->with('success',$transaksi->nama_brg .' Deleted');

    }

    public function edittransaksi($id)
    {
        // dd($id);
        $hasil = Transaksi::find($id);
        $hasil2=Barang::find($hasil->barang_id);
        $hasil['harga_jual']=$hasil2->harga_jual;
        $hasil['harga_brg']=$hasil2->harga_brg;
        $hasil['jumlah_brg']=$hasil2->jumlah_brg;

        return view('formedittransaksi',compact('hasil'));
    }

    public function simpanupdatetransaksi(Request $request,$id)
    {
        /* Proses Update Data Barang saat barang di batalkan atau hapus transaksi*/
       $barang = Barang::find($request->barang_id);
       $jumlahbrg=$barang['jumlah_brg']+$request->jumlah_item_trans_sebelum;
       Barang::where('barang_id', $request->barang_id)
                ->update(['jumlah_brg' => $jumlahbrg]);
       $this->validate($request,
           [   
               'jumlah_item_trans' => 'required',
               'discount',
               'tgl_trans'
           ]);

       //Ngecek Jika jumlah persediaan lebih kecil dari item dijual
       if ($request->input('jumlah_item_trans')>$jumlahbrg) 
       {
        session()->flash('message', 'Jumlah Item yg dijual lebih besar dari persedian');
        session()->flash('type', 'error');
        return redirect()->route('inputransaksi');
        }
        else
        {
            /*Proses update  barang setelah transaksi ulang*/
            $total=$jumlahbrg-$request->input('jumlah_item_trans');
            Barang::where('barang_id',$request->barang_id)
                    ->update(['jumlah_brg'=>$total]);

        /*Proses Update Transaksi*/
        if (!empty($id)){
            $data = $request->only('barang_id', 'nama_brg','jumlah_transaksi','jumlah_item_trans','tgl_trans','discount');
        }   
            $totaltrans=($request->input('harga_jual')-($request->input('harga_jual')*$request->input('discount')/100))*$request->input('jumlah_item_trans');
            $tgl_trans=date('Y-m-d',strtotime($request->input('tgl_trans')));

            $barang2 = Transaksi::where('id',$id)
                       ->update(['jumlah_transaksi'=>$totaltrans,'jumlah_item_trans'=>$request->jumlah_item_trans,'discount'=>$request->discount,'tgl_trans'=>$tgl_trans]) ;
        /******************************************/
            session()->flash('message', 'Data Transaksi' . $barang['nama_brg'] .' Updated');
            session()->flash('type', 'success');
            return redirect()->route('inputransaksi');
        }

    }
    public function inputdatareseller()
    {
        return view('forminputreseller');
    }

    public function simpaninputreseller(Request $request)
    {
        $ktp = Reseller::find($request->input('no_ktp'));

        if(empty($ktp)){
            $this->validate($request,
            [   
                'no_ktp' => 'required',
                'nama_reseller' => 'required',
                'alamat'=>'required',
                'email'
            ]);
 
             $data = $request->only('no_ktp', 'nama_reseller','alamat','email'); 
             $reseller = Reseller::create($data);
         /******************************************/
             session()->flash('message', 'Data ' . $reseller->nama_reseller .' Saved');
             session()->flash('type', 'success');
             return redirect()->route('inputdatareseller');
 
        }else{
            session()->flash('message', 'Data ' . $ktp->nama_reseller .' Sudah Ada');
            session()->flash('type', 'success');
            return redirect()->route('inputdatareseller');
        }
    }

    public function listreseller()
    {
        $reseller = Reseller::latest()->get();
        return view('listreseller', compact('reseller'));
    }

    public function hapusreseller($id)
    {
        $cari = Reseller::find($id);
        $hapus=Reseller::where('no_ktp','=',$id)->delete();
        session()->flash('message', 'Data ' . $cari->nama_reseller .' Sudah dihapus');
        session()->flash('type', 'success');
        return redirect()->route('listreseller');
    }

    public function editreseller($id)
    {
        $hasil=Reseller::find($id);
        return view('formeditreseller',compact('hasil'));
    }
    
    public function inputransaksireseller()
    {
        $barang = Barang::latest()->get();
        return view('formtransaksireseller', compact('barang'));
    }

    /* Minta detail produk dalam bentuk halaman web */
    public function detailproduk($id)
    {
        // return $id;
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
        $produk=Barang::findOrFail($id);
        return view('produkdetail',['produk'=>$produk,'transharian'=>$transharian,'transbulanini'=>$transbulanini,'transbulanlalu'=>$transbulanlalu,'transsatutahun'=>$transsatutahun]);
    }
    public function keranjangindex()
    {
        /*********/
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

        $keranjangs = DB::table('keranjangs')
        ->join('barang','keranjangs.barang_id','=','barang.barang_id')
        ->select('keranjangs.id','keranjangs.barang_id','barang.nama_brg as nama_brg','barang.photo','keranjangs.qty','barang.harga_jual')
        ->get();
        
        return view('keranjang',['keranjangs'=>$keranjangs,'transharian'=>$transharian,'transbulanini'=>$transbulanini,'transbulanlalu'=>$transbulanlalu,'transsatutahun'=>$transsatutahun]);


    }
    public function keranjangsimpan(Request $request)
    {
        // dd($request);
        //Ngecek Jika jumlah persediaan lebih kecil dari item dijual
       if ($request->input('qty')>$request->input('jumlah_brg')) 
       {
        session()->flash('message', 'Jumlah Item yg dijual lebih besar dari persedian');
        session()->flash('type', 'error');
        return redirect()->route('index');
        }
        else
        {
            $data = $request->only('barang_id','qty');

            $cari=Keranjang::where('barang_id','=',trim($request->barang_id))->get();
            $test=0;
            foreach($cari as $value)
            {
                $test=$value->qty;
            }
            if($test>0)
            {
                $total=$test + $request->input('qty');
                /* Udapte Kernjang */
                $barang2 = Keranjang::where('barang_id',$request->barang_id)
                ->update(['qty'=>$total]) ;
            }else{
                Keranjang::create($data);
            }
            return redirect()->route('keranjang');
        }
    }

    public function keranjangupdate(Request $request)
    {
        $index = 0;
        foreach($request->id as $id){
            /* FUNGSI findOrFail adalah mendapatkan nilai dari tabel berdasaarkan ID table */
            $keranjang = Keranjang::findOrFail($id);
            $keranjang->qty = $request->qty[$index];
            $keranjang->save();
            $index++;
        }
        return redirect()->route('keranjang');
    }

    public function keranjangdelete($id)
    {
        $hapus=Keranjang::where('id','=',$id)->delete();
        return redirect()->route('keranjang');
    }

    public function keranjangcheckout()
    {
        // dd($request);
        $keranjang = DB::table('keranjangs')
        ->join('barang','keranjangs.barang_id','=','barang.barang_id')
        ->select('keranjangs.id','keranjangs.barang_id','barang.nama_brg as nama_brg','barang.photo','keranjangs.qty','barang.harga_jual')
        ->paginate();
        $simpandata = DB::table('keranjangs')
        ->join('barang','keranjangs.barang_id','=','barang.barang_id')
        ->select('keranjangs.id','keranjangs.barang_id','barang.nama_brg as nama_brg','barang.photo','keranjangs.qty','barang.harga_jual')
        ->get();

        /*****Cara Converting String to number***/
        // <?php
        //     $variable=999;
        //     echo sprintf("%'04d", $variable);
        //     Hasil : '0999'
        //     echo("<br>");
        //     $str = "0901";
        //     $anInt = intval($str);
        //     echo $anInt;
        //     Hasil : 901
        $carinota=Pembeli::orderBy('nota','desc')->first();
        if(!empty($carinota))
        {
            $nota1=intval(substr($carinota->nota,5,4))+1;
            $carinota['nota']="MJFF/".sprintf("%'04d",$nota1)."-".date('dmy');
        }else{
            $carinota['nota']="MJFF/0001"."-".date('dmy');
        }
        $data = [
            'keranjang' => $keranjang,
            'carinota'  => $carinota,
            'simpandata'  => $simpandata,

        ];
        return view('formcheckout', $data);
        // return view('formcheckout', compact('keranjang'));
    }

    public function simpancheckout(Request $request)
    {
        $carinota=Pembeli::where('nota',$request->nota)->count();
        if($carinota>0)
        {
            session()->flash('message', 'Nota' . $request->input('nota') .' Sudah Ada');
            session()->flash('type', 'success');
            return redirect()->route('keranjang.checkout');
        } else
        {
            // dd($request);
            $this->validate($request,
            [   
                'nota' => 'required',
                'nama' => 'required',
                'alamat'=>'required',
                'tgl_trans',
                'discount',
                'jangkawaktu'
            ]);
            $data=$request->only('nota','nama','alamat','tgl_trans');
            $index = 0;
            foreach($request->id as $id){
                /* FUNGSI findOrFail adalah mendapatkan nilai dari tabel berdasaarkan ID table */
                $keranjang = Keranjang::findOrFail($id);
                $keranjang->qty = $request->qty[$index];
                $keranjang->barang_id = $request->barang_id[$index];
                // $keranjang->harga_jual = $request->harga_jual[$index];

                /***PROSES CARI BARANG UNTUK PROSES UPDATE DATA BARANG DAN INSERT TABEL TRANSAKSI***/
                $jmlbrg=Barang::find($request->barang_id[$index]);
                $jumlah_brg=0;$nama_brg="";$harga_jual=0;
                    $jumlah_brg=$jmlbrg->jumlah_brg;
                    $nama_brg=$jmlbrg->nama_brg;
                    $harga_jual=$jmlbrg->harga_jual;
                $totaljmlhbrg=$jumlah_brg-$request->qty[$index];
                /*Hitung transa*/
                $totaltransaksi = $request->qty[$index] * ($harga_jual - ($harga_jual * $request->discount/100));
                /**UPDATE JUMLAH BARANG****/
                $barang2 = Barang::where('barang_id',$request->barang_id[$index])
                ->update(['jumlah_brg'=>$totaljmlhbrg]);
                $transaksi=new Transaksi;
                // $trans = $request->only('barang_id', 'nama_brg','jumlah_trans','jumlah_item_trans'); 
                $transaksi->barang_id=$request->barang_id[$index];
                $transaksi->nama_brg=$nama_brg;
                $transaksi->jumlah_transaksi=$totaltransaksi;
                $transaksi->jumlah_item_trans=$request->qty[$index];
                $transaksi->tgl_trans=$request->tgl_trans;
                $transaksi->discount=$request->discount;
                $transaksi->nota=$request->nota;
                $transaksi->save();

                $index++;
            }
            /*Penjumlahan tanggal untuk mendapatkan TG JT setelah di jumlah jangka waktu*/
            $tgltrans=strtotime($request->input('tgl_trans'));
            if(!empty($request->jangkawaktu)){
                $data['tgl_jt_bayar']= date('Y-m-d', strtotime('+'.$request->jangkawaktu.' days', $tgltrans));
            }else{
                $data['tgl_jt_bayar']=null;
            }
            /************************/
            Pembeli::create($data);
            DB::table('keranjangs')->delete();

            /**************Cetak Faktur*****************/

            $faktur = DB::table('pembelis')
            ->join('transaksi','pembelis.nota','=','transaksi.nota')
            ->join('barang','transaksi.barang_id','=','barang.barang_id')
            ->join('satuan','barang.satuan','=','satuan.id')
            ->select('transaksi.barang_id','transaksi.nama_brg','transaksi.jumlah_transaksi','transaksi.jumlah_item_trans','transaksi.tgl_trans','transaksi.discount','pembelis.nota','pembelis.nama','pembelis.alamat','pembelis.tgl_jt_bayar','satuan.nama_satuan','barang.harga_jual','barang.isi_persatuan')
            ->where('pembelis.nota',$request->nota)
            ->get();
            /**********Hapus data Suratjalan */
        DB::table('suratjalans')->delete();
        DB::table('fakturjuals')->delete();

        for($i=0;$i<count($faktur);$i++)
        {
            $suratjln=new Suratjalan;

            $suratjln->barang_id=$faktur[$i]->barang_id;
            $suratjln->nama_brg=$faktur[$i]->nama_brg;
            $suratjln->qty=$faktur[$i]->jumlah_item_trans;
            $suratjln->isi_persatuan=$faktur[$i]->isi_persatuan;
            $suratjln->nota=$faktur[$i]->nota;
            $suratjln->save();
        }
        //Buat Isi data barang yang kosong
        $barangnull=DB::table('barang')
        ->leftjoin('transaksi','barang.barang_id','=','transaksi.barang_id')
        ->select('barang.barang_id', 'barang.nama_brg')
        ->whereNull('transaksi.barang_id')
        ->get();
        for($i=0;$i<count($barangnull);$i++)
        {
            $suratjln=new Suratjalan;
            $suratjln->barang_id=$barangnull[$i]->barang_id;
            $suratjln->nama_brg=$barangnull[$i]->nama_brg;
            $suratjln->save();
        }
        $suratjalan=Suratjalan::all();
        /*******Buat FAKTUR JUAL****/
        for($i=0;$i<count($faktur);$i++)
        {
            $fakturjual=new Fakturjual;
            $fakturjual->barang_id=$faktur[$i]->barang_id;

            $fakturjual->nama_brg=$faktur[$i]->nama_brg;
            $fakturjual->qty=$faktur[$i]->jumlah_item_trans;
            $fakturjual->harga_jual=$faktur[$i]->harga_jual;
            $fakturjual->jumlah_transaksi=$faktur[$i]->jumlah_transaksi;
            $fakturjual->discount=$faktur[$i]->discount;
            $fakturjual->nota=$faktur[$i]->nota;
            $fakturjual->nama=$faktur[$i]->nama;
            $fakturjual->alamat=$faktur[$i]->alamat;
            $fakturjual->tgl_jt_bayar=$faktur[$i]->tgl_jt_bayar;
            $fakturjual->save();
        }
        //Buat Isi data barang yang kosong
        $barangnull=DB::table('barang')
        ->leftjoin('fakturjuals','barang.barang_id','=','fakturjuals.barang_id')
        ->select('barang.barang_id', 'barang.nama_brg')
        ->whereNull('fakturjuals.barang_id')
        ->get();
        for($i=0;$i<count($barangnull);$i++)
        {
            $fakturjual=new Fakturjual;
            $fakturjual->barang_id=$barangnull[$i]->barang_id;
            $fakturjual->nama_brg=$barangnull[$i]->nama_brg;
            $fakturjual->save();
        }
        $faktur=Fakturjual::all();

        /***************************/
        return view('pdf.fakturrpt',['faktur'=>$faktur,'suratjalan'=>$suratjalan]);

            // $pdf = PDF::loadView('pdf.fakturrpt',['faktur'=>$faktur]);
            // return $pdf->stream('fakturrpt.pdf');
            // $pdf = App::make('snappy.pdf.wrapper');
            // $pdf = PDF::loadView('pdf.fakturrpt',['faktur'=>$faktur,'suratjalan'=>$suratjalan]);
            // return $pdf->inline();
    
        }

    }
    public function lihatjatuhtempo()
    {
        /****Buat lihat data JT Byr ******/
        return view('formcarijatuhtempo');
    }

    public function carijatuhtempo(Request $request)
    {
        // dd($request);
        $cari = DB::table('pembelis')
        ->join('transaksi','pembelis.nota','=','transaksi.nota')
        ->select(DB::raw('SUM(transaksi.jumlah_item_trans) as jumlah_item_trans'),DB::raw('SUM(transaksi.jumlah_transaksi) as jumlah_transaksi'),'pembelis.nota','pembelis.nama','pembelis.alamat','pembelis.tgl_jt_bayar')
        ->where('pembelis.tgl_jt_bayar','>=',$request->tgl_trans1)
        ->where('pembelis.tgl_jt_bayar','<=',$request->tgl_trans2)
        ->groupBy('pembelis.nota','pembelis.nama','pembelis.alamat','pembelis.tgl_jt_bayar')
        ->get();
        $lama=$request->only('tgl_trans1','tgl_trans2');
        return view('pdf.jatuhtempobayar',['cari'=>$cari,'lama'=>$lama]);

        // $pdf = App::make('snappy.pdf.wrapper');
        // $pdf = PDF::loadView('pdf.jatuhtempobayar',['cari'=>$cari,'lama'=>$lama]);
        // return $pdf->inline();

        // return view('formcarijatuhtempo',['cari'=>$cari,'lama'=>$lama]);
        // return dd($lama);
    }


    public function formlihatsalesreport()
    {
        $transaksi=DB::table('barang')
        ->join('transaksi','barang.barang_id','=','transaksi.barang_id')
        ->select('transaksi.barang_id','transaksi.nama_brg','transaksi.jumlah_transaksi','transaksi.jumlah_item_trans','transaksi.tgl_trans','transaksi.discount','barang.harga_brg','barang.harga_jual','transaksi.discount')
        ->get();
        return view('formsalesreport',compact('transaksi'));
    }
    public function carisalesreport(Request $request)
    {
        dd($request);
        // $transaksi=Transaksi::all();
        // return view('formsalesreport',compact('transaksi'));
    }
    public function tesreport()
    {
        $faktur = DB::table('pembelis')
        ->join('transaksi','pembelis.nota','=','transaksi.nota')
        ->join('barang','transaksi.barang_id','=','barang.barang_id')
        ->join('satuan','barang.satuan','=','satuan.id')
        ->select('transaksi.barang_id','transaksi.nama_brg','transaksi.jumlah_transaksi','transaksi.jumlah_item_trans','transaksi.tgl_trans','transaksi.discount','pembelis.nota','pembelis.nama','pembelis.alamat','pembelis.tgl_jt_bayar','satuan.nama_satuan','barang.harga_jual','barang.isi_persatuan')
        ->where('pembelis.nota','MJFF/0002-070720')
        ->get();

        DB::table('suratjalans')->delete();
        DB::table('fakturjuals')->delete();

        for($i=0;$i<count($faktur);$i++)
        {
            $suratjln=new Suratjalan;

            $suratjln->barang_id=$faktur[$i]->barang_id;
            $suratjln->nama_brg=$faktur[$i]->nama_brg;
            $suratjln->qty=$faktur[$i]->jumlah_item_trans;
            $suratjln->isi_persatuan=$faktur[$i]->isi_persatuan;
            $suratjln->nota=$faktur[$i]->nota;
            $suratjln->save();
        }
        //Buat Isi data barang yang kosong
        $barangnull=DB::table('barang')
        ->leftjoin('transaksi','barang.barang_id','=','transaksi.barang_id')
        ->select('barang.barang_id', 'barang.nama_brg')
        ->whereNull('transaksi.barang_id')
        ->get();
        for($i=0;$i<count($barangnull);$i++)
        {
            $suratjln=new Suratjalan;
            $suratjln->barang_id=$barangnull[$i]->barang_id;
            $suratjln->nama_brg=$barangnull[$i]->nama_brg;
            $suratjln->save();
        }
        $suratjalan=Suratjalan::all();
        /*******Buat FAKTUR JUAL****/
        for($i=0;$i<count($faktur);$i++)
        {
            $fakturjual=new Fakturjual;
            $fakturjual->barang_id=$faktur[$i]->barang_id;

            $fakturjual->nama_brg=$faktur[$i]->nama_brg;
            $fakturjual->qty=$faktur[$i]->jumlah_item_trans;
            $fakturjual->harga_jual=$faktur[$i]->harga_jual;
            $fakturjual->jumlah_transaksi=$faktur[$i]->jumlah_transaksi;
            $fakturjual->discount=$faktur[$i]->discount;
            $fakturjual->nota=$faktur[$i]->nota;
            $fakturjual->nama=$faktur[$i]->nama;
            $fakturjual->alamat=$faktur[$i]->alamat;
            $fakturjual->tgl_jt_bayar=$faktur[$i]->tgl_jt_bayar;
            $fakturjual->save();
        }
        //Buat Isi data barang yang kosong
        $barangnull=DB::table('barang')
        ->leftjoin('fakturjuals','barang.barang_id','=','fakturjuals.barang_id')
        ->select('barang.barang_id', 'barang.nama_brg')
        ->whereNull('fakturjuals.barang_id')
        ->get();
        for($i=0;$i<count($barangnull);$i++)
        {
            $fakturjual=new Fakturjual;
            $fakturjual->barang_id=$barangnull[$i]->barang_id;
            $fakturjual->nama_brg=$barangnull[$i]->nama_brg;
            $fakturjual->save();
        }
        $faktur=Fakturjual::all();

        /***************************/
        return view('pdf.fakturrpt',['faktur'=>$faktur,'suratjalan'=>$suratjalan]);
        // return $pdf->download('fakturrpt.pdf');

        // return $pdf->inline('fakturrpt.pdf');

    }
}
