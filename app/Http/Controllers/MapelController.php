<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mapel;

class MapelController extends Controller
{
    public function index()
    {
      $dataMapel = Mapel::get();
      return view('page.mataPelajaran',compact('dataMapel'));
    }

    public function tambahMapel(Request $req)
    {
      return redirect()->back()->with(Mapel::insertData(["mapel"=>$req->mapel,"kategori"=>$req->kategori]));
    }

    public function editMapel(Request $req)
    {
      return redirect()->back()->with(Mapel::updateData(["mapel"=>$req->mapel,"kategori"=>$req->kategori],$req->id_mapel));
    }

    public function getDetail(Request $req)
    {
      $dataMapel = Mapel::where('id_mapel',$req->input('id_mapel'))->first();
      return response()->json($dataMapel);
    }
}
