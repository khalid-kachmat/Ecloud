<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Secretary extends Model
{
    use HasFactory;



    public function updateOrAddSec($result, $id)
    {
        DB::table('secretaries')
            ->updateOrInsert(['secr_id' => $id], $result);

    }

    public function deleteSecretary($id)
    {
        DB::table('secretaries')
            ->where('secr_id', '=', $id)
            ->delete();
    }
}
