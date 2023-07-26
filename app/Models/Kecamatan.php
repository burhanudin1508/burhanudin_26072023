<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kabupaten;
use App\Models\Provinsi;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';
    public $timestamps = false;
    public $fillable = [
        'kode_daerah',
        'nama_daerah',
        'provinsi_id',
        'kabupaten_id'
    ];
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }
    public function provinsi()
    {
        return $this->hasMany(Provinsi::class, 'provinsi_id','id');
    }
}
