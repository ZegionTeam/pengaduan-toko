<?php

namespace App\Http\Controllers;

use App\Models\FollowUpLaporan;
use App\Models\JenisAduan;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DataPengaduan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan = Laporan::with('userPelapor.toko', 'userPekerja', 'jenisAduan')
            ->where('laporans.status', '<>', 'completed')
            ->get();
        $jenisAduan = JenisAduan::all();
        return view('pages.pemeliharaan.data-pengaduan', compact('laporan', 'jenisAduan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required',
                'note' => 'nullable'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $laporan = Laporan::findOrFail($id);
            if ($laporan) {

                $history = FollowUpLaporan::create([
                    'laporans_id' => $id,
                    'before' => $laporan->status,
                    'after' => $request->status,
                    'note' => $request->note
                ]);

                $laporan->update([
                    'status' => $request->status,
                    'pekerja' => Auth::user()->id
                ]);

                return redirect('/data-pengaduan')->with(['success' => 'Berhasil update data']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function getJenis($jenis)
    {
        try {
            $laporan = Laporan::with('userPelapor.toko', 'userPekerja', 'jenisAduan')
                ->whereHas('jenisAduan', function ($query) use ($jenis) {
                    $query->where('jenis_aduans.id', $jenis);
                })
                ->get();
            return response()->json($laporan);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function getlapAll()
    {
        $laporan = Laporan::with('userPelapor.toko', 'userPekerja', 'jenisAduan')->get();
        return response()->json($laporan);
    }

    public function show($id)
    {
        $laporan = Laporan::with('userPelapor.toko', 'userPekerja', 'jenisAduan')
            ->where('id', $id)
            ->first();

        return response()->json($laporan);
    }
}
