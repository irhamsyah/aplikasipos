<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Satuan;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Reseller;
use App\Models\Keranjang;
use App\Models\Pembeli;

use App\Users;

use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use Hash;
use Image;
use Mail;

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
        //menampilkan data produk yang dijoin dengan table kategori
        //kemudian dikasih paginasi 9 data per halaman nya
        // $kat = DB::table('categories')
        //         ->join('products','products.categories_id','=','categories.id')
        //         ->select(DB::raw('count(products.categories_id) as jumlah, categories.*'))
        //         ->groupBy('categories.id')
        //         ->get();
        // $data = array(
        //     'produks' => Product::paginate(9),
        //     'categories' => $kat
        // );
        // return view('user.produk',$data);
        $produks = Barang::paginate(8);
        return view('getting',compact('produks'));
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
            $produks = Barang::paginate(8);
            return view('getting', compact('produks'));
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
            'harga_jual_reseller'=>'required',
            'satuan',
            'isi_persatuan',
            'jumlah_brg',

            // not using `image` rule, as that will allow 
            'photo' => 'required|max:10240'
        ]);
        
        if (!empty($request->barang_id)){
            $data = $request->only('barang_id', 'nama_brg','harga_brg','harga_jual','harga_jual_reseller','satuan','isi_persatuan','jumlah_brg','photo');
        }
        // else{
        // $data = $request->only('productandalus_id', 'namaproduk','jenispenerbangan','lama','photo','rundown','regidr');
        // }

        // Don't overcomplicate, just upload to public/img folder and log the file name
        // In the future, maybe we would do some processing like resize or crop it.
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $file->move('./img',$file->getClientOriginalName());
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
        $barang = Barang::paginate(10);
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
                'harga_jual_reseller'=>'required',
                'satuan',
                'isi_persatuan',
                'jumlah_brg'
            ]);
        $data = $request->only('barang_id','nama_brg','harga_brg','harga_jual','harga_jual_reseller','satuan','isi_persatuan','jumlah_brg');
        //Ngecek Jika Perubahan Pada File Photo
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $file->move('./img',$file->getClientOriginalName());
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
        $carinota=Pembeli::where('nota',$request->nota);
        if(!empty($carinota))
        {
            session()->flash('message', 'Nota' . $request->nota .' Sudah Ada');
            session()->flash('type', 'success');
            return redirect()->route('simpantransaksi');
        }
        else
        {
            dd($request);
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

        }

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
        $produk=Barang::findOrFail($id);
        return view('produkdetail',compact('produk'));
    }
    public function keranjangindex()
    {
        $keranjangs = DB::table('keranjangs')
        ->join('barang','keranjangs.barang_id','=','barang.barang_id')
        ->select('keranjangs.id','keranjangs.barang_id','barang.nama_brg as nama_brg','barang.photo','keranjangs.qty','barang.harga_jual')
        ->get();
        return view('keranjang',compact('keranjangs'));

    }
    public function keranjang(Request $request){
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
        // $keranjang = Keranjang::paginate(8);
        $keranjang = DB::table('keranjangs')
        ->join('barang','keranjangs.barang_id','=','barang.barang_id')
        ->select('keranjangs.id','keranjangs.barang_id','barang.nama_brg as nama_brg','barang.photo','keranjangs.qty','barang.harga_jual')
        ->paginate();

        return view('formcheckout', compact('keranjang'));
    }

    public function simpancheckout(Request $request)
    {
        $carinota=Pembeli::where('nota',$request->nota)->get();
        $nota="";
        foreach($carinota as $value)
        {
            $nota=$value->nota;
        }
        if(trim($nota)==trim($request->nota))
        {
            session()->flash('message', 'Nota' . $request->nota .' Sudah Ada');
            session()->flash('type', 'success');
            return redirect()->route('simpan.checkout');
        }else
        {
            // dd($request);
            $this->validate($request,
            [   
                'nota' => 'required',
                'nama' => 'required',
                'alamat'=>'required',
                'tgl_trans'
            ]);
            $data=$request->only('nota','nama','alamat','tgl_trans');
            $index = 0;
            foreach($request->id as $id){
                /* FUNGSI findOrFail adalah mendapatkan nilai dari tabel berdasaarkan ID table */
                $keranjang = Keranjang::findOrFail($id);
                $keranjang->qty = $request->qty[$index];
                $keranjang->barang_id = $request->barang_id[$index];
                /***PROSES CARI BARANG UNTUK PROSES UPDATE DATA BARANG DAN INSERT TABEL TRANSAKSI***/
                $jmlbrg=Barang::where('barang_id',$request->barang_id[$index])->get();
                $jumlah_brg=0;$nama_brg="";$harga_jual=0;
                foreach($jmlbrg as $value)
                {
                    $jumlah_brg=$value->jumlah_brg;
                    $nama_brg=$value->nama_brg;
                    $harga_jual=$value->harga_jual;
                }
                $totaljmlhbrg=$jumlah_brg-$request->qty[$index];
                $totaltransaksi=$request->qty[$index]*$harga_jual;
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
                $transaksi->nota=$request->nota;
                $transaksi->save();

                $index++;
            }

            Pembeli::create($data);
            DB::table('keranjangs')->delete();
            return redirect()->route('keranjang');
        }

    }
}
