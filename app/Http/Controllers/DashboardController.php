<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Guru;

class DashboardController extends Controller
{
    public function index()
	{
    $queryAbsen = "SELECT SUM(kehadiran) totalHadir, SUM(kehadiran)-kehadiran tidakHadir, kehadiran/SUM(kehadiran)*100 presentase, kehadiran
     FROM (
       SELECT COUNT(*) kehadiran
       FROM tb_absen
       GROUP BY id_guru
    ) b GROUP BY kehadiran";
    $totalGuru = Guru::count();
    $dataAbsen = collect(\DB::select($queryAbsen))->first();
    //return view('page.dashboard',compact('dataAbsen','totalGuru'));
		return view('page.dashboard');
	}
}
