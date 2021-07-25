<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Secretary extends Model
{
    use HasFactory;

    public function secretariesInfo(): Collection
    {
        return DB::table('secretaries')
            ->join('users', 'id', '=', 'user_id')
            ->select('name', 'email', 'password', 'cin', 'phone', 'doc_id', 'user_id', 'secr_id')
            ->get();
    }

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
