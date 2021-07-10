<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Slots extends Model
{
    use HasFactory;

    public function insertSlot($data)
    {
        DB::table('slots')
            ->insert($data);
    }

    public function getSlotsForAppointment(): \Illuminate\Support\Collection
    {
        return Slots::all();
    }
}
