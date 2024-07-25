<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('pages.pemeliharaan.data-user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|unique:users,nik',
                'name' => 'required|string',
                'password' => 'required|min:8|confirmed'
            ], [
                'nik.unique' => 'NIK Sudah Terdaftar',
                'password.confirmed' => 'Password Tidak Sama'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::create([
                'nik' => $request->nik,
                'name' => $request->name,
                'password' => Hash::make($request->password)
            ]);

            if ($user) {
                return redirect()->intended('/login')->with(['success' => 'Berhasil Register']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'role' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::findOrFail($id);

            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'role' => $request->role
                ]);

                return redirect()->back()->with(['success' => 'Berhasil update data']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // dd($user);
        $user->delete();
        return redirect()->back()->with(['success' => 'Berhasil Menghapus Data']);
    }
}
