<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keluhan;
use Session;

class KeluhanController extends Controller
{
    public function index ()
    {
      $dataKeluhan = Keluhan::where('created_user',SESSION::get('userData')['userData']['user_id'])->get();
      return view('page.keluhan',compact('dataKeluhan'));
    }
    public function addKeluhan(Request $req)
    {
      return redirect()->back()->with(Keluhan::insertData(["keluhan"=>$req->keluhan,"status"=>0]));
    }
}
