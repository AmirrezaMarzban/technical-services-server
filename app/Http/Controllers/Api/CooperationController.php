<?php

namespace App\Http\Controllers\Api;

use App\Models\Cooperation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CooperationController extends Controller
{
    function index() {
        return ['data' => Cooperation::all()];
    }
}
