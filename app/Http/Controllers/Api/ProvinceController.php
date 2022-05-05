<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProvinceController extends Controller
{
    function index()
    {
        return ['data' => Province::all()];
    }

    function single(Province $province) {
        return new \App\Http\Resources\Province($province);
    }
}
