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

    public function updateOrAdd($result, $id)
    {
        DB::table('patients')
            ->updateOrInsert(['patient_cin' => $id], $result);

    }

    public function deletePatient($id)
    {
        DB::table('patients')
            ->where('patient_id', '=', $id)
            ->delete();
    }

    public function patientAppointments(Patient $patient, Appointment $appointment)
    {
        $patient->hasMany($appointment);
    }


}
