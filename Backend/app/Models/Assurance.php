<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Assurance extends Model
{
    use HasFactory;

    public function getAssuranceNameById($id): Collection
    {
        return DB::table('assurances')
            ->select('assurance_name')
            ->where('assurance_id', '=', $id)
            ->get();
    }

    public function updateOrAddAssurance($result, $id)
    {
        DB::table('assurances')
            ->updateOrInsert(['assurance_id' => $id], $result);

    }

    public function deleteAssurance($id)
    {
        DB::table('assurances')
            ->where('assurance_id', '=', $id)
            ->delete();
    }
}
