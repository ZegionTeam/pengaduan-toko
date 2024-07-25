<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Toko;
use App\Models\Village;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function create()
    {
        // Fetch all provinces
        $provinces = Province::all();
        return view('pages.pemeliharaan.tambah-toko', compact('provinces'));
    }

    // AJAX methods to fetch related data based on selected option
    public function getRegencies(Request $request)
    {
        $regencies = Regency::where('province_id', $request->province_id)->get();
        return response()->json($regencies);
    }

    public function getDistricts(Request $request)
    {
        $districts = District::where('regency_id', $request->regency_id)->get();
        return response()->json($districts);
    }

    public function getVillages(Request $request)
    {
        $villages = Village::where('district_id', $request->district_id)->get();
        return response()->json($villages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'village_id' => 'required|exists:villages,id'
        ]);

        Toko::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'village_id' => $request->village_id
        ]);

        return redirect()->route('stores.index')->with('success', 'Toko created successfully');
    }

    // Edit existing Toko
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'village_id' => 'required|exists:villages,id'
        ]);

        $store = Toko::findOrFail($id);
        $store->update([
            'nama' => $request->name,
            'address' => $request->address,
            'village_id' => $request->village_id
        ]);

        return redirect()->route('stores.index')->with('success', 'Toko updated successfully');
    }

    // Delete Toko
    public function destroy($id)
    {
        $store = Toko::findOrFail($id);
        $store->delete();

        return redirect()->route('stores.index')->with('success', 'Toko deleted successfully');
    }
}

