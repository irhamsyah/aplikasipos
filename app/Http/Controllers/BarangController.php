<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Satuan;
use App\Models\Barang;
use App\Models\Transaksi;


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
        // $cari = Barang::where('barang_id', '=', $request->barang_id)->firstOrFail();   
        
        // if(!empty($cari)){
        //     return redirect()->route('inputdatabarang')->with('error',$request->barang_id . ' Sudah Ada');
        // } else {
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
        //$product->categories()->sync($request->get('category_lists'));

            session()->flash('message', 'Data' . $barang->nama_brg .' Saved');
            session()->flash('type', 'success');
            return redirect()->route('inputdatabarang');
        
    }

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
        dd($request);
    }
    public function hapusbarang($barang_id)
    {
        // dd($barang_id);
        $databrg = Barang::find($barang_id);
        $hapusbarang = Barang::where('barang_id','=', $barang_id)->delete();
        // $hapusbarang->history()->forceDelete();
        return redirect()->route('editdatabarang')->with('success',$databrg->nama_brg .' Deleted');

    }

}
