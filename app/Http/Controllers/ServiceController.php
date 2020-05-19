<?php

namespace App\Http\Controllers;

class ServiceController extends Controller
{
	public function index()
	{
		return view('/services/service');
	}
	
	public function AdmKependudukan()
	{
		return view('/services/Administrasi Kependudukan/admkependudukan');
	}
	
	public function KartuKeluarga()
	{
		return view('/services/Administrasi Kependudukan/Kartu Keluarga/kartukeluarga');
	}
	public function KartuKeluargaBaru()
	{
		return view('/services/Administrasi Kependudukan/Kartu Keluarga/kkbaru');
	}	
	public function KartuKeluargaUbah()
	{
		return view('/services/Administrasi Kependudukan/Kartu Keluarga/kkubah');
	}
	
	public function KTP()
	{
		return view('/services/Administrasi Kependudukan/KTP/ktp');
	}
	public function KTPBaru()
	{
		return view('/services/Administrasi Kependudukan/KTP/ktpbaru');
	}	
	
	public function AktaKelahiran()
	{
		return view('/services/Administrasi Kependudukan/Akta Kelahiran/kelahiran');
	}
	public function AktaKelahiranBayi()
	{
		return view('/services/Administrasi Kependudukan/Akta Kelahiran/aktakelahiranbayi');
	}
	public function AktaKelahiranBaru()
	{
		return view('/services/Administrasi Kependudukan/Akta Kelahiran/aktakelahiranbaru');
	}

	public function AktaKematian()
	{
		return view('/services/Administrasi Kependudukan/Akta Kematian/kematian');
	}
	public function AktaKematianBaru()
	{
		return view('/services/Administrasi Kependudukan/Akta Kematian/aktakematian');
	}
	
	public function PerizinanOnline()
	{
		return view('/services/Perizinan Online/perizinan');
	}
	public function IMB()
	{
		return view('/services/Perizinan Online/IMB/imb');
	}
	
	public function KeteranganNikah()
	{
		return view('/services/nikah');
	}
	public function KeteranganBelumNikah()
	{
		return view('/services/belumnikah');
	}
	public function IzinRameRame()
	{
		return view('/services/izinramerame');
	}
}

?>