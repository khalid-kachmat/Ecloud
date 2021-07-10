<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Doctor extends Model
{
    use HasFactory;

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class);
    }

    public function importDocData(): \Illuminate\Support\Collection
    {
        return DB::table('users')
            ->join('doctors', 'id', '=', 'doc_user_id')
            ->join('services', 'service_id', '=', 'doc_service')
            ->select('name', 'doc_user_id', 'doc_speciality', 'service_name')
            ->get();
    }

    public function getDocNameById($id): \Illuminate\Support\Collection
    {
        return DB::table('users')
            ->select('name')
            ->where('id' , '=' , $id)
            ->get();
    }
}
