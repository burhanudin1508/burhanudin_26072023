<?php

namespace App\Http\Controllers;

use Exception;
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

class DesaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = array(
            'title' => 'Desa',
            'menu' => 'desa',
            'submenu' => ''
        );
        $data['data'] = Desa::With('kecamatan')->orderBy('kecamatan_id', 'ASC')->limit(1000)->get();
        return view('menu.desa.index', $data);
    }
    public function add(Request $request){
        try{
            $desaID = $request->post_id;
            if($request->post_id){
                $cekKode  = Desa::where('kode_daerah',$request->kode)->first();
                if($cekKode){
                    return Response::json(['status_msg' => false,'message' => 'Kode Daerah Sudah Digunakan']);
                }else{
                    $desa   =   Desa::updateOrCreate(
                        ['id' => $desaID],
                        [
                            'kode_daerah' => $request->kode,
                            'kecamatan_id' => $request->kecamatan,
                            'nama_daerah' => $request->nama
                        ],
                    );
                }
            }else{
                $desa   =   Desa::updateOrCreate(
                    ['id' => $desaID],
                    [
                        'kode_daerah' => $request->kode,
                        'kecamatan_id' => $request->kecamatan,
                        'nama_daerah' => $request->nama
                    ],
                );
            }
            $desa['status_msg'] = true;
            $desa['message'] = 'Berhasil';
    
            return Response::json($desa);
        }catch(Exception $ex){
            return Response::json(['status_msg' => false,'message' => 'Kode Wilayah Sudah Digunakan']);
        }
    }
    public function detail($id){
        $id = Crypt::decrypt($id);
        $kecamatan   = Desa::with(['kecamatan','kecamatan.kabupaten','kecamatan.kabupaten.provinsi'])->where('id',$id)->first();
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
        $data['title'] = 'Detail Desa';
        $data['menu'] = 'Desa';
        $data['submenu'] = '';
        if($data){
            $desa = Desa::where('id',$id)->orderBy('id','ASC')->get();
            $data['status'] = true;
            $data['message'] = 'Data ditemukan';
            $data['desa'] = $desa;
        }else{
            $data['status'] = false;
            $data['message'] = 'Data tidak ditemukan';
        }
        return view('menu.desa.detail', $data);
    }
    public function desaList($id)
    {
        $data = Desa::Where(['kecamatan_id'=>$id, 'status'=>1])->orderBy('id', 'ASC')->get();
        return response()->json($data);
    }
}
