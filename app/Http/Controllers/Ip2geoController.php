<?php

namespace App\Http\Controllers;

use App\Models\Ip2geo;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Ip2geoController extends Controller
{
    public function index()
    {
        try {
            $ip2geos = Ip2geo::all();

            if ($ip2geos->isEmpty()) {
                abort(404);
            }

            $results = $ip2geos->map(function ($ip2geo) {

                $result  = Http::get('http://ip-api.com/json/' . $ip2geo['ip']);

                $data = json_decode($result, true);

                if ($data['status'] == 'fail') {
                    abort(500, $data['message']);
                } else
                    return $result;
            });

            return view('ip2geo', [
                'ip2geos' => $results
            ]);
        } catch (ModelNotFoundException $exception) {
            abort(404, 'Custom 404 error message');
        } catch (RequestException $exception) {
            abort(501, $exception->getMessage());
        }
    }
}
