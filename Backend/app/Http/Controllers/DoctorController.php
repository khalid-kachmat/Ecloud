<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class DoctorController extends Controller
{
    public function importDoctorsData(): Collection
    {
        return (new Doctor)->importDocData();
    }

    public function doctorInfo(Doctor $doctor, User $user, Service $service): JsonResponse
    {
        $docs = $doctor->all();
        $result = array();
        foreach ($docs as $doc) {
            $info = $user->all()->where('id', '=', $doc->doc_user_id)->first();
            $serve = $service->all()->where('service_id', '=', $doc->doc_service)->first();
            $data = array(
                'docId' => $doc->doc_id,
                'docFullName' => $info['name'],
                'docEmail' => $info['email'],
                'docPassword' => $info['password'],
                'docSpeciality' => $doc['doc_speciality'],
                'docService' => $serve['service_name'],
                'docUserId' => $info['id'],
                'docCin' => $info['cin'],
                'docPhone' => $info['phone'],
            );
            array_push($result,$data);
        }

        return response()->json($result);
    }
}
