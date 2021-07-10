<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use Illuminate\Http\Request;

class AssuranceController extends Controller
{
    public function importAssuranceData(Request $request){
        return Assurance::all();
    }
}
