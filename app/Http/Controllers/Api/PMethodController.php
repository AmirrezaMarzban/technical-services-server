<?php

namespace App\Http\Controllers\Api;

use App\Models\Pmethods;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PMethodController extends Controller
{
    function index() {
        return ['data' => Pmethods::all()];
    }
}
