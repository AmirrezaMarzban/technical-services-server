<?php

namespace App\Http\Controllers\Api;

use App\Models\Cooperation;
use App\Models\WorkingExperiences;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WorkingExperiencesController extends Controller
{
    function index() {
        return ['data' => WorkingExperiences::all()];
    }
}
