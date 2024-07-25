<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\JenisAduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $laporan = Laporan::with('userPelapor.toko', 'userPekerja', 'jenisAduan')
            ->whereHas('userPelapor.toko', function ($query) use ($user) {
                $query->where('tokos.id', $user->tokos_id);
            })
            ->get();
        $jenisAduan = JenisAduan::all();
        return view('pages.karyawan.pengaduan', compact('laporan', 'jenisAduan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisAduan = JenisAduan::all();
        return view('pages.karyawan.tambah-pengaduan', compact('jenisAduan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'jenis_aduans_id' => 'required|exists:jenis_aduans,id',
                'laporan' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            // change file name
            $imageName = time() . '.' . $request->foto->extension();

            $laporan = Laporan::create([
                'pelapor' => Auth::user()->id,
                'laporan' => $request->laporan,
                'jenis_aduans_id' => $request->jenis_aduans_id,
                'foto' =>  $imageName
            ]);

            if ($laporan) {
                $request->foto->move(public_path('images/laporan'), $imageName);
                return redirect('/pengaduan')->with(['success' => 'Berhasil Melaporkan']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $laporan = Laporan::with('userPelapor.toko', 'userPekerja', 'jenisAduan')
            ->where('id', $id)
            ->first();

        return response()->json($laporan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('pages.karyawan.rincian-aduan', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'laporan' => 'required',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            $data = $request->all();

            $laporan = Laporan::findOrFail($id);
            if ($laporan) {
                if ($request->has('foto')) {
                    File::delete(public_path('images/laporan/' . $laporan->foto));
                    $imageName = time() . '.' . $request->foto->extension();
                    $request->foto->move(public_path('images/laporan'), $imageName);
                    $data['foto'] = $imageName;
                }
                $laporan->update($data);

                return redirect('/pengaduan')->with(['success' => 'Berhasil update data']);
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
        $laporan = Laporan::findOrFail($id);
        File::delete(public_path('images/laporan/' . $laporan->foto));
        $laporan->delete();

        return redirect('/pengaduan')->with(['success' => 'Berhasil Menghapus Data']);
    }

    public function getByJenis($jenis)
    {
        try {
            $laporan = null;

            $user = Auth::user();

            if ($user->role != 'pemeliharaan') {
                $laporan = Laporan::with('userPelapor.toko', 'userPekerja', 'jenisAduan')
                    ->whereHas('jenisAduan', function ($query) use ($jenis) {
                        $query->where('jenis_aduans.id', $jenis);
                    })
                    ->whereHas('userPelapor.toko', function ($query) use ($user) {
                        $query->where('tokos.id', $user->tokos_id);
                    })
                    ->get();
            } else {
                $laporan = Laporan::with('userPelapor.toko', 'userPekerja', 'jenisAduan')
                    ->where('laporans.status', '<>', 'completed')
                    ->whereHas('jenisAduan', function ($query) use ($jenis) {
                        $query->where('jenis_aduans.id', $jenis);
                    })
                    ->get();
            }


            return response()->json($laporan);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function getall()
    {
        $laporan = null;

        $user = Auth::user();

        if ($user->role != 'pemeliharaan') {
            $laporan = Laporan::with('userPelapor.toko', 'userPekerja', 'jenisAduan')
                ->whereHas('userPelapor.toko', function ($query) use ($user) {
                    $query->where('tokos.id', $user->tokos_id);
                })
                ->get();
        } else {
            $laporan = Laporan::with('userPelapor.toko', 'userPekerja', 'jenisAduan')
                ->where('laporans.status', '<>', 'completed')
                ->get();
        }
        return response()->json($laporan);
    }
}
