<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;

class MapController extends Controller
{
    public function index()
    {
        return view('webgis');
    }

    public function data()
    {
        $sekolah = Sekolah::all();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => $sekolah->map(function ($s) {
                return [
                    'type' => 'Feature',
                    'properties' => [
                        'nama' => $s->nama,
                        'jenjang' => $s->jenjang,
                        'akreditasi' => $s->akreditasi,
                        'foto' => asset('images/sekolah/' . $s->foto),
                    ],
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [(float) $s->lng, (float) $s->lat],
                    ],
                ];
            }),
        ];

        return response()->json($geojson);
    }
}
