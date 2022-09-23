<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Siswa;
use App\pip;
use Auth;
use Illuminate\Support\Facades\Validator;
use PDF;

class SiswaController extends Controller
{
    public function printAllSiswa()
    {
        $siswa = User::where('role', 'siswa')->with('get_siswa')->get();
 
    	$pdf = PDF::loadview('print.siswa',['siswa'=>$siswa])->setPaper('a4', 'landscape');
    	return $pdf->download('laporan-pendaftaran-siswa.pdf');
    }

    public function index()
    {
        $siswa = User::with('get_siswa')->where('role', 'siswa')->get();
        return view('admin.siswa')->with([
            'data' => $siswa
        ]); 
    }

    public function myProfile()
    {
        $siswa = User::with('get_siswa')->where('id', Auth::user()->id)->first();
        return view('siswa.profile')->with([
            'profile' => $siswa
        ]);
    }

    public function editMyProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nisn' => "required|string|max:10|unique:siswas,nisn,$id",
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:2000'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'string'],
            'email' => "required|string|max:255|email|unique:users,email,$id,id_siswa"
        ]);
        
        if($validator->fails()){
            return redirect()->route('siswa.profile')->withErrors($validator)->withInput();
        }
            
        $siswa = Siswa::where('id', $id)->first()
            ->update([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'date' => $request->date,
        ]);
        // dd($siswa);    
    
        User::where('id_siswa', $id)->first()->update([
            'username' => explode("@", $request->email)[0],
            'email' => $request->email,
        ]);

        return redirect()->route('siswa.profile');
    }

    public function pengajuanSiswa()
    {
        $pengajuan = pip::where('id_user', Auth::user()->id)->get();
        return view('siswa.pengajuan')->with('pengajuan', $pengajuan);
    }

    public function simpanPengajuanSiswa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto_kip' => 'required|mimes:pdf,jpg,jpeg,png|max:4096',
            'keterangan' => ['required', 'string', 'max:255'],
            'catatan' => ['required', 'string', 'max:255'],
            'tahun_akademik' => ['required', 'min:2']
        ]);
        
        if($validator->fails()){
            return redirect()->route('siswa.pengajuan')->withErrors($validator)->withInput();
        }

        $fileName = time().'.'.$request->foto_kip->extension();  
        $request->foto_kip->move(public_path('uploads'), $fileName);

        $checkpip = pip::where('tahun_akademik', $request->tahun_akademik)->where('id_user', Auth::user()->id)->first();
        if($checkpip){
            return redirect()->route('siswa.pengajuan')->with('errors_custom', 'Anda Sudah Melakukan Pengajuan Pada Tahun Akademik yang sama');
        }

        $pip = pip::create([
            'foto_kip' => $fileName,
            'keterangan' => $request->keterangan,
            'catatan' => $request->catatan,
            'tahun_akademik' => $request->tahun_akademik,
            'id_user' => Auth::user()->id,
            'status' => 'pending'
        ]);

        return back()->with('success' , 'Berhasil Melakukan Pengajuan Silahkan Tunggu Informasi Selanjutnya.');
    }
}
