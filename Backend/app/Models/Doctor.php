<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class Doctor extends Model
{
    use HasFactory;

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function importDocData(): Collection
    {
        return DB::table('users')
            ->join('doctors', 'id', '=', 'doc_user_id')
            ->join('services', 'service_id', '=', 'doc_service')
            ->select('name', 'doc_user_id', 'doc_speciality', 'service_name')
            ->get();
    }

    public function getDocNameById($id): Collection
    {
        return DB::table('users')
            ->select('name')
            ->where('id', '=', $id)
            ->get();
    }

    public function services(): HasOne
    {
        return $this->hasOne(Service::class);
    }

    public function updateOrAddDoc($result, $id)
    {
        DB::table('doctors')
            ->updateOrInsert(['doc_id' => $id], $result);

    }

    public function deleteDoctor($id)
    {
        DB::table('doctors')
            ->where('doc_id', '=', $id)
            ->delete();
    }
}
