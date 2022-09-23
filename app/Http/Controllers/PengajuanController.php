<?php

namespace App\Http\Controllers;

use App\pip;
use Illuminate\Http\Request;
use PDF;
use Auth;

class PengajuanController extends Controller
{
    public function printAllPengajuan()
    {
        $pip = pip::with('get_user')->get();
 
    	$pdf = PDF::loadview('print.allPengajuan',['pip'=>$pip])->setPaper('a4', 'landscape');
    	return $pdf->download('laporan-pengajuan-all.pdf');
    }

    public function printSinglePengajuan($id)
    {
        $pip = pip::where('id', $id)->with('get_user')->first();
        $no = $pip->no_pendaftaran;
        // dd($pip);
 
    	$pdf = PDF::loadview('print.singlepengajuan',['pip'=>$pip])->setPaper('a4', 'landscape');
    	return $pdf->download("laporan-pengajuan-$no.pdf");
    }

    public function printAllSiswaPengajuan()
    {
        $pip = pip::where('id_user', Auth::user()->id)->with('get_user')->get();
        $username = Auth::user()->username;
    	$pdf = PDF::loadview('print.allPengajuanSiswa',['pip'=>$pip, 'username' => $username])->setPaper('a4', 'landscape');
    	return $pdf->download("laporan-pengajuan-$username.pdf");
    }
    
    public function printSingleSiswaPengajuan($id)
    {
        $pip = pip::where('id_user', Auth::user()->id)->where('id', $id)->with('get_user')->first();
        $username = Auth::user()->username;
        $no = $pip->no_pendaftaran;
 
    	$pdf = PDF::loadview('print.singleSiswaPengajuan',['pip'=>$pip, 'username' => $username])->setPaper('a4', 'landscape');
    	return $pdf->download("laporan-pengajuan-$username-$no.pdf");
    }

    public function index()
    {
        $pengajuan = pip::with('get_user')->get();
        return view('admin.pengajuan')->with('pengajuan', $pengajuan);
    }

    public function ubahStatusSukses($id)
    {
        $pip = pip::where('id', $id)->first();
        $pip->update([
            'status' => 'success'
        ]);

        return redirect()->route('admin.pengajuan')->with('success', 'Data Berhasil Diubah');
    }
    public function ubahStatusGagal($id)
    {
        $pip = pip::where('id', $id)->first();
        $pip->update([
            'status' => 'failed'
        ]);

        return redirect()->route('admin.pengajuan')->with('success', 'Data Berhasil Diubah');
    }
    public function ubahStatusPending($id)
    {
        $pip = pip::where('id', $id)->first();
        $pip->update([
            'status' => 'pending'
        ]);

        return redirect()->route('admin.pengajuan')->with('success', 'Data Berhasil Diubah');
    }
}
