<?php

namespace App\Http\Controllers;

use App\Models\Secretary;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function importServicesData(): Collection|array
    {
        return Service::all();
    }

    public function updateOrAddServ(Request $request, Service $service)
    {
        $data = json_decode($request->getContent(), true);
        if ($data['serviceId'] === ''){
            $data['serviceId'] = 0;
        }
        $serv = array(
            'service_name' => $data['serviceName'],
            'service_price' => $data['servicePrice'],
            'service_duration' => $data['serviceDuration'],
        );
        $service->updateOrAddserv($serv, $data['serviceId']);

    }

    public function deleteService(Request $request, Service $service)
    {
        $data = json_decode($request->getContent(), true);
        $service->deleteService($data['serviceId']);

    }
}
