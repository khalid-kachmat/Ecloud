<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Support\Collection;

class DoctorController extends Controller
{
    public function importDoctorsData(): Collection
    {

        $result = new Doctor();
        return $result->importDocData();

    }
}
