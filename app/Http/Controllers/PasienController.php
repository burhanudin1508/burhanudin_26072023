<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pasien;
use App\Models\Desa;
use Redirect, Response;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;


class PasienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = array(
            'title' => 'Pasien',
            'menu' => 'pasien',
            'submenu' => ''
        );
        $data['data'] = Pasien::With(['desa', 'kecamatan', 'kabupaten', 'provinsi'])->orderBy('kecamatan_id', 'ASC')->limit(1000)->get();
        return view('menu.pasien.index', $data);
    }
    public function addPasien()
    {
        $data = array(
            'title' => 'Pasien',
            'menu' => 'pasien',
            'submenu' => ''
        );
        $data['data'] = Pasien::With(['desa', 'kecamatan', 'kabupaten', 'provinsi'])->orderBy('kecamatan_id', 'ASC')->limit(1000)->get();
        return view('menu.pasien.add', $data);
    }
    public function add(Request $request)
    {
        try {
            $pasienID = $request->post_id;
            if ($request->post_id) {
                $pasien   =   Pasien::updateOrCreate(
                    ['id' => $pasienID],
                    [
                        'nama' => $request->nama,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'email' => $request->email,
                        'alamat' => $request->alamat,
                        'no_telpon' => $request->no_telpon,
                        'rt' => $request->rt,
                        'rw' => $request->rw,
                        'desa_id' => $request->desa,
                        'kecamatan_id' => $request->kecamatan,
                        'kabupaten_id' => $request->kabupaten,
                        'provinsi_id' => $request->provinsi,
                        'tempat_lahir' => $request->tempat_lahir,
                        'tanggal_lahir' => $request->tanggal_lahi
                    ],
                );
            } else {
                $pasien   =   Pasien::updateOrCreate(
                    ['id' => $pasienID],
                    [
                        'nama' => $request->nama,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'email' => $request->email,
                        'alamat' => $request->alamat,
                        'no_telpon' => $request->no_telpon,
                        'rt' => $request->rt,
                        'rw' => $request->rw,
                        'desa_id' => $request->desa,
                        'kecamatan_id' => $request->kecamatan,
                        'kabupaten_id' => $request->kabupaten,
                        'provinsi_id' => $request->provinsi,
                        'tempat_lahir' => $request->tempat_lahir,
                        'tanggal_lahir' => $request->tanggal_lahi
                    ],
                );
            }
            $pasien['status_msg'] = true;
            $pasien['message'] = 'Berhasil';

            return Response::json($pasien);
        } catch (Exception $ex) {
            return Response::json(['status_msg' => false, 'message' => 'Pastikan semua form sudah terisi']);
        }
    }
    public function detail($id)
    {
        $id = Crypt::decrypt($id);
        $data = array(
            'title' => 'Pasien',
            'menu' => 'pasien',
            'submenu' => ''
        );
        $data['data'] = Pasien::With(['desa', 'kecamatan', 'kabupaten', 'provinsi'])->orderBy('kecamatan_id', 'ASC')->where('id', $id)->first();
        return view('menu.pasien.detail', $data);
    }
    public function update($id)
    {
        $id = Crypt::decrypt($id);
        $data = array(
            'title' => 'Pasien',
            'menu' => 'pasien',
            'submenu' => ''
        );
        $data['data'] = Pasien::With(['desa', 'kecamatan', 'kabupaten', 'provinsi'])->orderBy('kecamatan_id', 'ASC')->where('id', $id)->first();
        return view('menu.pasien.update', $data);
    }
}
