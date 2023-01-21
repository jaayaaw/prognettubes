<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        
        return view('register');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
            'pegawai_id' => 'required',
        ],[
            'name.required' => 'Kolom Username Tidak Boleh Kosong!',
            'email.required' => 'Kolom Email Tidak Boleh Kosong!',
            'password.required' => 'Kolom Password Tidak Boleh Kosong!',
            'level.required' => 'Kolom level Tidak Boleh Kosong!',
            'pegawai_id.required' => 'Kolom level Tidak Boleh Kosong!',
        ]);

        $validateData['password'] = bcrypt($validateData['password']); 

        User::create($validateData);
        return redirect('register')->with('massage', 'Berhasil Menambahkan Data Baru');
    }
}
