<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
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

        return view('pages.dashboard', compact('laporan'));
    }
}
