<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Provinsi;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'kabupaten';
    public $timestamps = false;
    public $fillable = [
        'kode_daerah',
        'nama_daerah',
        'provinsi_id'
    ];
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }
}
