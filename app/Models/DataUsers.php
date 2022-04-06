<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'email',
        'pejabat',
        'jabatan',
        'unit_kerja',
        'tujuan_penggunaan',
        'watermark',
        'petugas'
    ];

    public function standard_demands()
    {
        return $this->hasMany(StandardDemands::class, 'id_user');
    }
}
