<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Http\Requests\StoreTokoRequest;
use App\Http\Requests\UpdateTokoRequest;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toko = Toko::with('village.district.regency.province')->get();
        return view('pages.pemeliharaan.data-toko', compact('toko'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::all();
        return view('pages.pemeliharaan.tambah-toko', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'village_id' => 'required|exists:villages,id',
                'alamat' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $toko = Toko::create([
                'nama' => $request->nama,
                'villages_id' => $request->village_id,
                'alamat' => $request->alamat
            ]);

            if ($toko) {
                return redirect('/toko')->with(['success' => 'Berhasil menambahkan toko']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Toko $toko)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Toko $toko)
    {
        $dataToko = Toko::with('village.district.regency.province')->where('id', $toko->id)->first();
        // dd($dataToko);
        $villages = Village::where('district_id', $dataToko->village->district->id)->get();
        $district = District::where('regency_id', $dataToko->village->district->regency->id)->get();
        $regency = Regency::where('province_id', $dataToko->village->district->regency->province_id)->get();
        $province = Province::all();
        return view('pages.pemeliharaan.edit-toko', compact('dataToko', 'villages', 'district', 'regency', 'province'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Toko $toko)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'village_id' => 'required|exists:villages,id',
                'alamat' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $toko->update([
                'nama' => $request->nama,
                'villages_id' => $request->village_id,
                'alamat' => $request->alamat
            ]);

            return redirect('/toko')->with(['success' => 'Berhasil update data']);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Toko $toko)
    {
        $toko->delete();
        return redirect()->back()->with(['success' => 'Berhasil Menghapus Data']);
    }
}
