<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function importPatientsData(Request $request)
    {
        return (new Patient)->getAllPatientData();
    }

}
