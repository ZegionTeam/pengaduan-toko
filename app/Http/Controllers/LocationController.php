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

    }

    // AJAX methods to fetch related data based on selected option
    public function getRegencies($id)
    {
        $regencies = Regency::where('province_id', $id)->get();
        return response()->json($regencies);
    }

    public function getDistricts($id)
    {
        $districts = District::where('regency_id', $id)->get();
        return response()->json($districts);
    }

    public function getVillages($id)
    {
        $villages = Village::where('district_id', $id)->get();
        return response()->json($villages);
    }
}
