<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    use HasFactory;

    public function updateOrAddServ($result, $id)
    {
        DB::table('services')
            ->updateOrInsert(['service_id' => $id], $result);

    }

    public function deleteService($id)
    {
        DB::table('services')
            ->where('service_id', '=', $id)
            ->delete();
    }
}
