<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use Redirect, Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class KecamatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = array(
            'title' => 'Kecamatan',
            'menu' => 'kecamatan',
            'submenu' => ''
        );
        $data['data'] = Kecamatan::With('kabupaten')->orderBy('kabupaten_id', 'ASC')->limit(1000)->get();
        return view('menu.kecamatan.index', $data);
    }
    public function add(Request $request){
        try{
            $kecamatanID = $request->post_id;
            if($request->post_id){
                $cekKode  = Kecamatan::where('kode_daerah',$request->kode)->first();
                if($cekKode){
                    return Response::json(['status_msg' => false,'message' => 'Kode Daerah Sudah Digunakan']);
                }else{
                    $kecamatan   =   Kecamatan::updateOrCreate(
                        ['id' => $kecamatanID],
                        [
                            'kode_daerah' => $request->kode,
                            'provinsi_id' => $request->provinsi,
                            'kabupaten_id' => $request->kabupaten_id,
                            'nama_daerah' => $request->nama
                        ],
                    );
                }
            }else{
                $kecamatan   =   Kecamatan::updateOrCreate(
                    ['id' => $kecamatanID],
                    [
                        'kode_daerah' => $request->kode,
                        'provinsi_id' => $request->provinsi,
                        'kabupaten_id' => $request->kabupaten_id,
                        'nama_daerah' => $request->nama
                    ],
                );
            }
            $kecamatan['status_msg'] = true;
            $kecamatan['message'] = 'Berhasil';
    
            return Response::json($kecamatan);
        }catch(Exception $ex){
            return Response::json(['status_msg' => false,'message' => 'Kode Wilayah Sudah Digunakan']);
        }
    }
    public function detail($id){
        $id = Crypt::decrypt($id);
        $kecamatan   = Kecamatan::with('kabupaten')->where('id',$id)->first();
        return Response::json($kecamatan);
    }
    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $kecamatan = Kecamatan::where('id', $id)->first();
        if($kecamatan){
            $kecamatan->status = 0;
            $kecamatan->save();
        }

        return Response::json($kecamatan);
    }
    public function activate($id)
    {
        $id = Crypt::decrypt($id);
        $kecamatan = Kecamatan::where('id', $id)->first();
        if($kecamatan){
            $kecamatan->status = 1;
            $kecamatan->save();
        }

        return Response::json($kecamatan);
    }
    public function detailView($id)
    {
        $id = Crypt::decrypt($id);
        $data = Kecamatan::where('id', $id)->first();
        $data['title'] = 'Detail Kecamatan';
        $data['menu'] = 'kecamatan';
        $data['submenu'] = '';
        if($data){
            $desa = Desa::where('kecamatan_id',$id)->orderBy('id','ASC')->get();
            $data['status'] = true;
            $data['message'] = 'Data ditemukan';
            $data['desa'] = $desa;
        }else{
            $data['status'] = false;
            $data['message'] = 'Data tidak ditemukan';
        }
        return view('menu.kecamatan.detail', $data);
    }
    public function kecamatanList($id)
    {
        $data = Kecamatan::Where(['kabupaten_id'=>$id, 'status'=>1])->orderBy('id', 'ASC')->get();
        return response()->json($data);
    }
}
