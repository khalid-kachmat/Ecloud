<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

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
            array_push($result, $data);
        }

        return response()->json($result);
    }

    public function updateOrAddDoc(Request $request, Doctor $doctor, User $user)
    {
        $data = json_decode($request->getContent(), true);
        if ($data['function'] === 'edit') {
            $doc = array(
                'doc_speciality' => $data['docSpeciality'],
                'doc_service' => $data['serviceId'],
            );
            $usr = array(
                'name' => $data['docFullName'],
                'email' => $data['docEmail'],
                'password' => $data['docPassword'],
                'cin' => $data['docCin'],
                'phone' => $data['docPhone'],
            );
            $doctor->updateOrAddDoc($doc, $data['docId']);
            $user->updateOrAddUser($usr, $data['docUserId']);
        } else {
            $usr = array(
                'name' => $data['docFullName'],
                'email' => $data['docEmail'],
                'password' => $data['docPassword'],
                'cin' => $data['docCin'],
                'type' => $data['type'],
                'phone' => $data['docPhone'],

            );
            $user->updateOrAddUser($usr, 0);
            $userId = $user->all()->last();
            $doc = array(
                'doc_user_id' => $userId->id,
                'doc_speciality' => $data['docSpeciality'],
                'doc_service' => $data['serviceId'],
            );
            $doctor->updateOrAddDoc($doc, 0);
        }

    }

    public function deleteDoctor(Request $request, Doctor $doctor, User $user)
    {
        $data = json_decode($request->getContent() , true);
        $user->deleteUser($data['docUserId']);
        $doctor->deleteDoctor($data['docId']);
    }
}
