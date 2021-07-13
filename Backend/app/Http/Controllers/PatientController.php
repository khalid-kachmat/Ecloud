<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Slots;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function importPatientsData(): array|Collection
    {
        return (new Patient)->getAllPatientData();
    }

    public function patientDataAppNbr(): array
    {
        $patients = Patient::all();
        $data = array();
        foreach ($patients as $row) {
            $appNbr = Appointment::all()->where('app_patient_id', '=', $row['patient_id'])->count();

            $result = array(
                "patientId" => $row['patient_id'],
                "patientFirst" => $row['patient_first_name'],
                "patientLast" => $row['patient_last_name'],
                "patientCin" => $row['patient_cin'],
                "patientBirth" => $row['patient_birth'],
                "patientAge" => $row['patient_age'],
                "patientNote" => $row['patient_note'],
                "patientAssurance" => $row['patient_assurance_id'],
                "patientAssuranceVisibility" => $row['patient_assurance'],
                "appNbr" => $appNbr
            );
            array_push($data, $result);
        }
        json_encode($data);
        return $data;

    }

    public function addNewPatient(Request $request, Patient $patient)
    {
        $data = json_decode($request->getContent(), true);

        $result = array(
            "patient_first_name" => $data['patientFirst'],
            "patient_last_name" => $data['patientLast'],
            "patient_cin" => $data['patientCin'],
            "patient_birth" => $data['patientBirth'],
            "patient_age" => $data['patientAge'],
            "patient_note" => $data['patientNote'],
            "patient_assurance_id" => $data['assuranceId'],
            "patient_assurance" => $data['assuranceVisibility']
        );
        $patient->createNewPatient($result);
    }

    public function getAppointmentDataPerPatient(Request $request, Appointment $appointment, Slots $slots, User $user, Service $service): JsonResponse
    {
        $results = $appointment->all()->where('app_patient_id', '=', $request->getContent());
        $response = array();
        foreach ($results as $result) {
            $slot = $slots->all()->where('slot_app_id', '=', $result->app_id)->first();
            $doc = $user->all()->where('id', '=', $result->app_doc_id)->first();
            $serve = $service->all()->where('service_id','=', $result->app_service_id)->first();
            $data = array(
                'doc' => $doc->name,
                'startDate' => $slot->start,
                'service' => $serve->service_name
            );
            array_push($response,$data);

        }
        return response()->json($response);


    }

}
