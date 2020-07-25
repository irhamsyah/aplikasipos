<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use Hash;

class DaftarController extends Controller
{
    //
    public function TampilkanFormRegistrasi()
    {
        return view('auth.register');
    }

    public function buatuserbaru(Request $request)
    {
        dd($request);
    }
}
