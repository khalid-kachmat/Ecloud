<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Slots extends Model
{
    use HasFactory;

    public function insertSlot($data)
    {
        DB::table('slots')
            ->insert($data);
    }

    public function getSlotsForAppointment(): Collection
    {
        return Slots::all();
    }

    public function deleteSlot($id)
    {
        DB::table('slots')
            ->where('slot_app_id', '=', $id)
            ->delete();
    }
}
