<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Redirect, Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class ProvinsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = array(
            'title' => 'Provinsi',
            'menu' => 'provinsi',
            'submenu' => ''
        );
        $data['data'] = Provinsi::orderBy('id', 'ASC')->get();
        return view('menu.provinsi.index', $data);
    }
    public function provinsiList()
    {
        $data = Provinsi::Where('status',1)->orderBy('id', 'ASC')->get();
        return response()->json($data);
    }
    public function add(Request $request){
        try{
            $provinsiID = $request->post_id;
            if($request->post_id){
                $cekKode  = Provinsi::where('kode_daerah',$request->kode)->first();
                if($cekKode){
                    return Response::json(['status_msg' => false,'message' => 'Kode Daerah Sudah Digunakan']);
                }else{
                    $provinsi   =   Provinsi::updateOrCreate(
                        ['id' => $provinsiID],
                        [
                            'kode_daerah' => $request->kode,
                            'nama_daerah' => $request->nama
                        ],
                    );
                }
            }else{
                $provinsi   =   Provinsi::updateOrCreate(
                    ['id' => $provinsiID],
                    [
                        'kode_daerah' => $request->kode,
                        'nama_daerah' => $request->nama
                    ],
                );
            }
            $provinsi['status_msg'] = true;
            $provinsi['message'] = 'Berhasil';
    
            return Response::json($provinsi);
        }catch(Exception $ex){
            dd($ex);
            return Response::json(['status_msg' => false,'message' => 'Kode Wilayah']);
        }
    }
    public function detail($id){
        $id = Crypt::decrypt($id);
        $provinsi   = Provinsi::where('id',$id)->first();
        return Response::json($provinsi);
    }
    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $provinsi = Provinsi::where('id', $id)->first();
        if($provinsi){
            $provinsi->status = 0;
            $provinsi->save();
        }

        return Response::json($provinsi);
    }
    public function activate($id)
    {
        $id = Crypt::decrypt($id);
        $provinsi = Provinsi::where('id', $id)->first();
        if($provinsi){
            $provinsi->status = 1;
            $provinsi->save();
        }

        return Response::json($provinsi);
    }
    public function detailView($id)
    {
        $id = Crypt::decrypt($id);
        $data = Provinsi::where('id', $id)->first();
        $data['title'] = 'Detail Provinsi';
        $data['menu'] = 'provinsi';
        $data['submenu'] = '';
        if($data){
            $kabupaten = Kabupaten::where('provinsi_id',$data->id)->orderBy('id','ASC')->get();
            $data['status'] = true;
            $data['message'] = 'Data ditemukan';
            $data['kabupaten'] = $kabupaten;
        }else{
            $data['status'] = false;
            $data['message'] = 'Data tidak ditemukan';
        }
        return view('menu.provinsi.detail', $data);
    }
}
