<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AssuranceController extends Controller
{
    public function importAssuranceData(): Collection|array
    {
        return Assurance::all();
    }

    public function updateOrAddAssurance(Request $request, Assurance $assurance)
    {
        $data = json_decode($request->getContent(), true);
        if ($data['assuranceId'] === '') {
            $data['assuranceId'] = 0;
        }
        $serv = array(
            'assurance_name' => $data['assuranceName'],
        );
        $assurance->updateOrAddAssurance($serv, $data['assuranceId']);

    }

    public function deleteAssurance(Request $request, Assurance $assurance)
    {
        $data = json_decode($request->getContent(), true);
        $assurance->deleteAssurance($data['assuranceId']);

    }
}
