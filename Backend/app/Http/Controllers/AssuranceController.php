<?php

namespace App\Http\Controllers;

use App\Models\Assurance;

class AssuranceController extends Controller
{
    public function importAssuranceData(){
        return Assurance::all();
    }
}
