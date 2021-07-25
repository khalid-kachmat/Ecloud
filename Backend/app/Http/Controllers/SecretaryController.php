<?php

namespace App\Http\Controllers;

use App\Models\Secretary;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class SecretaryController extends Controller
{
    public function secretariesInfo(Secretary $secretary): Collection
    {
        return $secretary->secretariesInfo();
    }

    public function updateOrAddSec(Request $request, Secretary $secretary, User $user)
    {
        $data = json_decode($request->getContent(), true);
        if ($data['function'] === 'edit') {

            $usr = array(
                'name' => $data['secFullName'],
                'email' => $data['secEmail'],
                'password' => $data['secPassword'],
                'cin' => $data['secCin'],
                'phone' => $data['secPhone'],
            );
            $user->updateOrAddUser($usr, $data['secUserId']);
        } else {
            $usr = array(
                'name' => $data['secFullName'],
                'email' => $data['secEmail'],
                'password' => $data['secPassword'],
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
        $data = json_decode($request->getContent() , true);
        $user->deleteUser($data['secUserId']);
        $secretary->deleteSecretary($data['secId']);
    }
}
