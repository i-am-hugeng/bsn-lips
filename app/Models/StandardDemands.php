<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandardDemands extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'nomor_standar',
        'jenis_standar',
        'blokir',
        'format'
    ];

    public function data_users()
    {
        return $this->belongsTo(DataUsers::class, 'id_user');
    }
}
