<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function importServicesData(Request $request)
    {
        return Service::all();
    }
}
