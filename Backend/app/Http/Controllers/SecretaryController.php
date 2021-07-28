<?php

namespace App\Http\Controllers;

use App\Models\Secretary;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecretaryController extends Controller
{
    public function secretariesInfo(Secretary $secretary, User $user): JsonResponse
    {
        $sec = $secretary->all();
        $result = array();
        foreach ($sec as $row) {
            $eachOne = $user->all()->where('id', '=', $row->user_id)->first();
            $data = array(
                'secr_id' => $row->secr_id,
                'user_id' => $row->user_id,
                'name' => $eachOne->name,
                'email' => $eachOne->email,
                'password' => $eachOne->password,
                'cin' => $eachOne->cin,
                'phone' => $eachOne->phone,
            );

            array_push($result, $data);
        }
        return response()->json($result);

    }

    public function updateOrAddSec(Request $request, Secretary $secretary, User $user)
    {
        $data = json_decode($request->getContent(), true);
        if ($data['function'] === 'edit') {

            $usr = array(
                'name' => $data['secFullName'],
                'email' => $data['secEmail'],
                'password' => Hash::make($data['secPassword']),
                'cin' => $data['secCin'],
                'phone' => $data['secPhone'],
            );
            $user->updateOrAddUser($usr, $data['secUserId']);
        } else {
            $usr = array(
                'name' => $data['secFullName'],
                'email' => $data['secEmail'],
                'password' => Hash::make($data['secPassword']),
                'cin' => $data['secCin'],
                'type' => $data['type'],
                'phone' => $data['secPhone'],

            );
            $user->updateOrAddUser($usr, 0);
            $userId = $user->all()->last();
            $doc = array(
                'user_id' => $userId->id,
            );
            $secretary->updateOrAddSec($doc, 0);
        }
    }

    public function deleteSecretary(Request $request, Secretary $secretary, User $user)
    {
        $data = json_decode($request->getContent(), true);
        $user->deleteUser($data['secUserId']);
        $secretary->deleteSecretary($data['secId']);
    }
}
