<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function importDoctorsData(Request $request): \Illuminate\Support\Collection
    {

        $result = new Doctor();
        return $result->importDocData();

    }
}
