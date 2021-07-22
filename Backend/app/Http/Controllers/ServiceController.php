<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceController extends Controller
{
    public function importServicesData(): Collection|array
    {
        return Service::all();
    }
}
