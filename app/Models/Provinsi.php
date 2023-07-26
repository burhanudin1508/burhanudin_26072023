<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'provinsi';
    public $timestamps = false;
    public $fillable = [
        'kode_daerah',
        'nama_daerah'
    ];
}
