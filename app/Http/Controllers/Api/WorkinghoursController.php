<?php

namespace App\Http\Controllers\Api;

use App\Models\Cooperation;
use App\Models\Workinghours;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WorkinghoursController extends Controller
{
    function index() {
        return ['data' => Workinghours::all()];
    }
}
