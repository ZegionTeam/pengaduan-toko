<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|exists:users,nik',
                'password' => 'required'
            ], [
                'nik.exists' => 'NIK Tidak Terdaftar'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if (Auth::attempt(['nik' => $request->nik, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect('/')->with(['success' => 'Berhasil Login']);
            }

            return redirect()->back()->withErrors(['password' => 'Password Salah'])->withInput();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with(['success' => 'Berhasil Logout']);
    }
}
