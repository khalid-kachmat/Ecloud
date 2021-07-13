<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Patient extends Model
{
    use HasFactory;

    public function getAllPatientData(): array|Collection
    {
        return Patient::all();
    }

    public function getPatientById($id)
    {

        return Patient::all()->where('patient_id', '=', $id)->first();
    }

    public function createNewPatient($data)
    {
        DB::table('patients')
            ->insert($data);
        return Patient::all()->last();
    }


}
