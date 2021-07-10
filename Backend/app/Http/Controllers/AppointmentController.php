<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Slots;
use App\Models\User;
use Illuminate\Http\Request;


class AppointmentController extends Controller
{
    public function getAppointmentData(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $user = (new Patient)->getPatientById($data['patientId']);

        if ($user) {

            $appointment = array(
                "app_patient_id"    => $data['patientId'],
                "app_doc_id"        => $data['docId'],
                "app_service_id"    => $data['serviceId'],
                "app_assurance_id"  => $data['assuranceId'],
                "app_start_date"    => $data['startDate'],
                "app_start_time"    => $data['startTime'],
                "app_end_date"      => $data['endDate'],
                "app_end_time"      => $data['endTime']
            );

            $insertApp = (new Appointment)->insertData($appointment);

            $slot = array(
                "start"         => $data['start'],
                "end"           => $data['end'],
                "slot_app_id"   => $insertApp['app_id']
            );
            (new Slots)->insertSlot($slot);
        } else {
            $patient = array(
                "patient_first_name"    => $data['firstName'],
                "patient_last_name"     => $data['lastName'],
                "patient_cin"           => $data['cin'],
                "patient_birth"         => $data['birthDate'],
                "patient_age"           => $data['age'],
                "patient_note"          => $data['note'],
                "patient_assurance_id"  => $data['assuranceId']
            );
            $patientId = (new Patient)->createNewPatient($patient);

            $appointment = array(
                "app_patient_id"        => $patientId['patient_id'],
                "app_doc_id"            => $data['docId'],
                "app_service_id"        => $data['serviceId'],
                "app_assurance_id"      => $data['assuranceId'],
                "app_start_date"        => $data['startDate'],
                "app_start_time"        => $data['startTime'],
                "app_end_date"          => $data['endDate'],
                "app_end_time"          => $data['endTime']
            );
            $insertApp = (new Appointment)->insertData($appointment);
            $slot = array(
                "start"         => $data['start'],
                "end"           => $data['end'],
                "slot_app_id"   => $insertApp['app_id']
            );
            (new Slots)->insertSlot($slot);
        }
    }


    public function sentAppointmentData(): \Illuminate\Http\JsonResponse
    {
        $test = (new Slots)->getSlotsForAppointment();
        $result = array();
        foreach ($test as $row){
            $appointment = (new Appointment)->getPatientId($row['slot_app_id']);
            $patient = (new Patient)->getPatientById($appointment['app_patient_id']);

            $data= array(
                'id'    => $row['slot_app_id'],
                'title' => $patient['patient_first_name'] . ' ' . $patient['patient_last_name'],
                'start' => $row['start'],
                'end'   => $row['end']
            );
            array_push($result,$data);
        }
        return response()->json($result);

    }
}
