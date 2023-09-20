<?php

namespace App\Http\Controllers;

use App\Models\Ip2geo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Ip2geoController extends Controller
{
    public function index() {
        $ip2geos = Ip2geo::all();

        $results = $ip2geos->map(function($ip2geo) {

            $result  = Http::get('http://ip-api.com/json/'.$ip2geo['ip']);

            return $result;

        });

        return view('ip2geo', [
            'ip2geos' => $results
        ]);
    }


}
