<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminsController extends Controller
{
  public function index()
  {
    return view('admin.home');
  }
  public function pelayanan()
  {
    return view('admin.pelayanan.pelayanan');
  }
  public function ktp()
  {
    return view('admin.pelayanan.ktp.ktp-list');
  }
  public function ktpBaru()
  {
    return view('admin.pelayanan.ktp.ktp-baru');
  }
  public function ktpPesan()
  {
    return view('admin.pelayanan.ktp.ktp-pesan');
  }
  public function ktpLihat()
  {
    return view('admin.pelayanan.ktp.ktp-lihat');
  }
  public function kk()
  {
    return view('admin.pelayanan.kk.kk-list');
  }
  public function kkBaru()
  {
    return view('admin.pelayanan.kk.kk-baru');
  }
  public function kkPesan()
  {
    return view('admin.pelayanan.kk.kk-pesan');
  }
  public function akta()
  {
    return view('admin.pelayanan.aktaKelahiran.akta');
  }
  public function aktaBaru()
  {
    return view('admin.pelayanan.aktaKelahiran.akta-baru');
  }
  public function aktaPesan()
  {
    return view('admin.pelayanan.aktaKelahiran.akta-pesan');
  }
  public function sktm()
  {
    return view('admin.pelayanan.sktm.sktm-list');
  }
  public function sktmBaru()
  {
    return view('admin.pelayanan.sktm.sktm-baru');
  }
  public function sktmPesan()
  {
    return view('admin.pelayanan.sktm.sktm-pesan');
  }
  public function perizinanNikah()
  {
    return view('admin.pelayanan.perizinan-nikah.nikah-list');
  }
  public function nikahBaru()
  {
    return view('admin.pelayanan.perizinan-nikah.nikah-baru');
  }
  public function nikahPesan()
  {
    return view('admin.pelayanan.perizinan-nikah.nikah-pesan');
  }
}
