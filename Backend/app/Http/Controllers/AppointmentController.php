<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Slots;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AppointmentController extends Controller
{
    public function getAppointmentData(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $user = (new Patient)->getPatientById($data['patientId']);

        if ($user) {

            $appointment = array(
                "app_patient_id" => $data['patientId'],
                "app_doc_id" => $data['docId'],
                "app_service_id" => $data['serviceId'],
                "app_assurance_id" => $data['assuranceId'],
                "app_start_date" => $data['startDate'],
                "app_start_time" => $data['startTime'],
                "app_end_date" => $data['endDate'],
                "app_end_time" => $data['endTime']
            );

        } else {
            $patient = array(
                "patient_first_name" => $data['firstName'],
                "patient_last_name" => $data['lastName'],
                "patient_cin" => $data['cin'],
                "patient_birth" => $data['birthDate'],
                "patient_age" => $data['age'],
                "patient_note" => $data['note'],
                "patient_assurance_id" => $data['assuranceId']
            );
            $patientId = (new Patient)->createNewPatient($patient);

            $appointment = array(
                "app_patient_id" => $patientId['patient_id'],
                "app_doc_id" => $data['docId'],
                "app_service_id" => $data['serviceId'],
                "app_assurance_id" => $data['assuranceId'],
                "app_start_date" => $data['startDate'],
                "app_start_time" => $data['startTime'],
                "app_end_date" => $data['endDate'],
                "app_end_time" => $data['endTime']
            );
        }
        $insertApp = (new Appointment)->insertData($appointment);
        $slot = array(
            "start" => $data['start'],
            "end" => $data['end'],
            "slot_app_id" => $insertApp['app_id']
        );
        (new Slots)->insertSlot($slot);
    }


    public function sentAppointmentData(Slots $slots, Appointment $appointment, User $user, Patient $patient, Doctor $doctor): JsonResponse
    {
        $test = $slots->getSlotsForAppointment();
        $result = array();
        foreach ($test as $row) {
            $appointments = $appointment->getPatientId($row['slot_app_id']);
            $patients = $patient->getPatientById($appointments['app_patient_id']);
            $doc = $doctor->all()->where('doc_id', '=', $appointments['app_doc_id'])->first();
            $usr = $user->all()->where('id', '=', $doc->doc_user_id)->first();

            $data = array(
                'id' => $row['slot_app_id'],
                'title' => $patients['patient_first_name'] . ' ' . $patients['patient_last_name'] . ' ' . ' __ ' . 'Doctor: ' . $usr->name,
                'start' => $row['start'],
                'end' => $row['end']
            );
            array_push($result, $data);
        }
        return response()->json($result);
    }

    public function deleteAppointment(Request $request, Appointment $appointment, Slots $slots)
    {
        $appointment->deleteAppointment($request->getContent());
        $slots->deleteSlot($request->getContent());
    }

    public function statistics(Request $request, Appointment $appointment, User $user, Patient $patient): JsonResponse
    {
        $app = $appointment->all()->count();
        $usr = $user->all()->where('type', '=', 'Doctor')->count();
        $patients = $patient->all()->count();
        $appToday = $appointment->all()->where('app_start_date', '=', $request->getContent())->count();

        $result = array(
            'appointments' => $app,
            'doctors' => $usr,
            'patients' => $patients,
            'appointmentsToday' => $appToday,
        );
        return response()->json($result);
    }
}
