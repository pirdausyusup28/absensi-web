<?php

namespace App\Http\Controllers;
use App\Models\Home;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $data = Home::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])
                ->with('user') 
                ->get();
        return view('home', compact('data'));
    }

    public function kehadiran()
    {
        $data = Home::where('tanggal', date('Y-m-d'))
                    ->where('id_karyawan', '2')
                    ->get();
        return view('kehadiran', compact('data'));
    }

    public function downloadexcel()
    {
        $data = Home::where('tanggal', date('Y-m-d'))
                    ->where('id_karyawan', '2')
                    ->get();
        return view('kehadiran', compact('data'));
    }

    public function checkin(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $checkin = new Home;
        $checkin->id_karyawan = $request->nama;
        $checkin->tanggal = date('Y-m-d');
        $checkin->cekin = date("H:i:s");
        $checkin->cekout = "00:00:00";
        $checkin->latitude = $request->lat;
        $checkin->longitude = $request->long;
        $checkin->latitude_out = '0';
        $checkin->longitude_out = '0';
        $checkin->save();
        return redirect()->route('home');
    }

    public function checkout(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
    
        // Mengambil data yang akan diperbarui berdasarkan ID
        $id = $request->id;
        $checkin = Home::find($id);
    
        if ($checkin) {
            $checkin->cekout =  date("H:i:s");
            $checkin->latitude_out = $request->lat;
            $checkin->longitude_out = $request->long;
            $checkin->save();
        }
    
        return redirect()->route('home');
    }
}
