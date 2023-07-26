<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Kecamatan;

class Desa extends Model
{
    use HasFactory;
    protected $table = 'desa';
    public $timestamps = false;
    public $fillable = [
        'kode_daerah',
        'nama_daerah',
        'kecamatan_id'
    ];
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id','id');
    }
    public function provinsi()
    {
        return $this->hasMany(Provinsi::class, 'provinsi_id','id');
    }
}