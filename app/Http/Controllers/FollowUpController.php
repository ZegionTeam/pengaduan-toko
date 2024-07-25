<?php

namespace App\Http\Controllers;

use App\Models\FollowUpLaporan;
use App\Models\Laporan;
use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    public function index($id)
    {
        $history = FollowUpLaporan::where('laporans_id', $id)->get();
        $laporan = Laporan::findOrFail($id);
        return view('pages.karyawan.followupkaryawan', compact('history', 'laporan'));
    }

    public function tutupLaporan($id)
    {
        try {
            $laporan = Laporan::findOrFail($id);
            if ($laporan) {

                $history = FollowUpLaporan::create([
                    'laporans_id' => $id,
                    'before' => $laporan->status,
                    'after' => 'completed'
                ]);

                $laporan->update([
                    'status' => 'completed'
                ]);

                return redirect('/pengaduan')->with(['success' => 'Laporan Berhasil Ditutup']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
}
