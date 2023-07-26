<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Kecamatan;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    public $timestamps = false;
    public $fillable = [
        'nama',
        'jenis_kelamin',
        'email',
        'alamat',
        'no_telpon',
        'rt',
        'rw',
        'desa_id',
        'kecamatan_id',
        'kabupaten_id',
        'status',
        'provinsi_id',
        'tempat_lahir',
        'tanggal_lahir',
        'kode_daerah',
        'nama_daerah',
        'kecamatan_id',
        'id_pasien'
    ];
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }
}