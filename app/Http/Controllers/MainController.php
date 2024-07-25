<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $status = ['open', 'pending', 'in progress', 'completed'];

        $data = DB::table('laporans')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();

        $laporan = [];
        foreach ($status as $item) {
            $laporan[] = [
                'status' => $item,
                'jumlah' => $data[$item] ?? 0
            ];
        }

        $toko = Toko::all();

        // $laporan_toko = Laporan::with('userPelapor.toko', 'jenisAduan')
        //     ->select('jenis_aduans_id', DB::raw('count(*) as total'))
        //     ->groupBy('jenis_aduans_id')
        //     ->get();
        // dd($laporan_toko);

        return view('pages.dashboard', compact('laporan', 'toko'));
    }
}
