<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Satuan;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Users;

use DB;
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
    public function logout()
    {
            Auth::logout();
            return view('auth.login1');
    }

    public function adminlogin(Request $req)
    {
        if(Auth::attempt(['email'=>$req->input('email'),'password'=>$req->input('password')]))
        {
            return view('getting',array('request'=>$req));
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

    public function inputransaksi(Request $request)
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

    public function simpantransaksi(Request $request,$id)
    {
        // dd($request);
       /* Proses Update Data Barang */
       $barang = Barang::find($id);
       $this->validate($request,
           [   
               'jumlah_brg' => 'required',
               'jumlah_item_trans' => 'required',
               'discount',
               'tgl_trans'
           ]);

       $data = $request->only('jumlah_brg');
       //Ngecek Jika jumlah persediaan lebih kecil dari item dijual
       if ($request->input('jumlah_item_trans')>$request->input('jumlah_brg')) {
        session()->flash('message', 'Jumlah Item yg dijual lebih besar dari persedian');
        session()->flash('type', 'error');
        return redirect()->route('inputransaksi');
        }
        else{
            $data['jumlah_brg']=$request->input('jumlah_brg')-$request->input('jumlah_item_trans');
            $barang->update($data);

        /*Proses Insert Transaksi*/
        if (!empty($id)){
            $data = $request->only('barang_id', 'nama_brg','jumlah_transaksi','jumlah_item_trans','tgl_trans','discount');
        }   
            $data['barang_id']=$id;
            $data['jumlah_transaksi']=($request->input('harga_jual')-($request->input('harga_jual')*$request->input('discount')/100))*$request->input('jumlah_item_trans');
            $data['tgl_trans']=date('Y-m-d',strtotime($request->input('tgl_trans')));

            $barang = Transaksi::create($data);
        /******************************************/
            session()->flash('message', 'Data Transaksi' . $barang->nama_brg .' Saved');
            session()->flash('type', 'success');
            return redirect()->route('inputransaksi');

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
    public function tes()
    {
        return 'testis';
    }

}
