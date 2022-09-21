<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nisn' => ['required', 'string', 'max:10', 'unique:siswas'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:2000'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        if($validator->fails()){
            return redirect('/register')->withErrors($validator)->withInput();
        }

        $siswa = Siswa::create([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'date' => $request->date,
        ]);


        User::create([
            'username' => explode("@", $request->email)[0],
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_siswa' => $siswa->id
        ]);

        return redirect('/login');
    }
}
