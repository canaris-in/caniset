<?php

namespace App\Http\Controllers;

use App\Models\ApiData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Jobs\FetchApiData;


class AutoDiscoveryController extends Controller
{
//     public function fetchData()
// {
//     FetchApiData::dispatch();
//     return response()->json(['message' => 'Job dispatched']);
// }
    public function index(){
        // $jsonUrl = 'http://127.0.0.1:8000/discover/';
        // $jsonData = file_get_contents($jsonUrl);
        // $data = json_decode($jsonData, true);
        FetchApiData::dispatch();
        $data = ApiData::all();
        dd($data);
        return view('feature.autodiscovery', ['data' => $data]);
    }
}
