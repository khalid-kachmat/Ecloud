<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use HasFactory;

    public function insertData($row)
    {
        DB::table('appointments')
            ->insert($row);
        return Appointment::all()->last();
    }

    public function getAllAppointments(): Collection
    {
        return DB::table('appointments')
            ->join('slots', 'slot_app_id', '=', 'app_id')
            ->join('patients', 'patient_id', '=', 'app_patient_id')
            ->select('patient_first_name', 'patient_last_name', 'app_patient_id', 'app_id', 'app_doc_id', 'app_service_id', 'app_assurance_id', 'app_start_date', 'app_start_time', 'app_end_date', 'app_end_time', 'start', 'end')
            ->get();
    }

    public function getPatientId($id)
    {
        return Appointment::all()->where('app_id', '=', $id)->first();
    }
}
