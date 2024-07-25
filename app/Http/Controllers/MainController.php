<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Toko;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $status = ['open', 'pending', 'in progress', 'completed'];

        $user = Auth::user();

        $data = Laporan::with('userPelapor.toko')
            ->select('status', DB::raw('count(*) as total'))
            ->whereHas('userPelapor.toko', function ($query) use ($user) {
                $query->where('tokos.id', $user->tokos_id);
            })
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();

        $laporan = [];
        foreach ($status as $item) {
            $laporan[] = [
                'status' => $item,
                'jumlah' => $data[$item] ?? 0
            ];
        }

        $tokos = Toko::all();

        $statusLaporanPerToko = DB::table('tokos')
            ->leftJoin('users', 'tokos.id', '=', 'users.tokos_id')
            ->leftJoin('laporans', 'users.id', '=', 'laporans.pelapor')
            ->select('tokos.nama AS nama_toko')
            ->selectRaw('COUNT(CASE WHEN laporans.status = "open" THEN 1 END) AS open')
            ->selectRaw('COUNT(CASE WHEN laporans.status = "pending" THEN 1 END) AS pending')
            ->selectRaw('COUNT(CASE WHEN laporans.status = "inprogress" THEN 1 END) AS inprogress')
            ->selectRaw('COUNT(CASE WHEN laporans.status = "complete" THEN 1 END) AS complete')
            ->groupBy('tokos.nama')
            ->get();

        $jenisAduans = DB::table('jenis_aduans')->pluck('nama');

        $jenisLaporanPerToko = [];

        foreach ($tokos as $toko) {
            $laporanCounts = DB::table('laporans')
                ->join('jenis_aduans', 'laporans.jenis_aduans_id', '=', 'jenis_aduans.id')
                ->join('users', 'laporans.pelapor', '=', 'users.id')
                ->join('tokos', 'users.tokos_id', '=', 'tokos.id')
                ->select(DB::raw('jenis_aduans.nama, COUNT(laporans.id) as count'))
                ->where('tokos.id', '=', $toko->id)
                ->groupBy('jenis_aduans.nama')
                ->pluck('count', 'nama')
                ->toArray();

            $tokoData = [
                'nama_toko' => $toko->nama,
            ];

            foreach ($jenisAduans as $jenis) {
                $tokoData[$jenis] = $laporanCounts[$jenis] ?? 0;
            }

            $jenisLaporanPerToko[] = $tokoData;
        }



        return view('pages.dashboard', compact('laporan', 'tokos', 'statusLaporanPerToko', 'jenisLaporanPerToko'));
    }
}
