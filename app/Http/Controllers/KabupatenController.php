<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Redirect, Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class KabupatenController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = array(
            'title' => 'Kabupaten',
            'menu' => 'kabupaten',
            'submenu' => ''
        );
        $data['data'] = Kabupaten::With('provinsi')->orderBy('id', 'ASC')->get();
        return view('menu.kabupaten.index', $data);
    }
    public function add(Request $request){
        try{
            $kabupatenID = $request->post_id;
            if($request->post_id){
                $cekKode  = Kabupaten::where('kode_daerah',$request->kode)->first();
                if($cekKode){
                    return Response::json(['status_msg' => false,'message' => 'Kode Daerah Sudah Digunakan']);
                }else{
                    $kabupaten   =   Kabupaten::updateOrCreate(
                        ['id' => $kabupatenID],
                        [
                            'kode_daerah' => $request->kode,
                            'provinsi_id' => $request->provinsi,
                            'nama_daerah' => $request->nama
                        ],
                    );
                }
            }else{
                $kabupaten   =   Kabupaten::updateOrCreate(
                    ['id' => $kabupatenID],
                    [
                        'kode_daerah' => $request->kode,
                        'provinsi_id' => $request->provinsi,
                        'nama_daerah' => $request->nama
                    ],
                );
            }
            $kabupaten['status_msg'] = true;
            $kabupaten['message'] = 'Berhasil';
    
            return Response::json($kabupaten);
        }catch(Exception $ex){
            dd($ex);
            return Response::json(['status_msg' => false,'message' => 'Kode Wilayah']);
        }
    }
    public function detail($id){
        $id = Crypt::decrypt($id);
        $kabupaten   = Kabupaten::where('id',$id)->first();
        return Response::json($kabupaten);
    }
    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $kabupaten = Kabupaten::where('id', $id)->first();
        if($kabupaten){
            $kabupaten->status = 0;
            $kabupaten->save();
        }

        return Response::json($kabupaten);
    }
    public function activate($id)
    {
        $id = Crypt::decrypt($id);
        $kabupaten = Kabupaten::where('id', $id)->first();
        if($kabupaten){
            $kabupaten->status = 1;
            $kabupaten->save();
        }

        return Response::json($kabupaten);
    }
    public function detailView($id)
    {
        $id = Crypt::decrypt($id);
        $data = Kabupaten::where('id', $id)->first();
        $data['title'] = 'Detail Kecamatan';
        $data['menu'] = 'kecamatan';
        $data['submenu'] = '';
        if($data){
            $kecamatan = Kecamatan::where('kabupaten_id',$data->id)->orderBy('id','ASC')->get();
            $data['status'] = true;
            $data['message'] = 'Data ditemukan';
            $data['kabupaten'] = $kecamatan;
        }else{
            $data['status'] = false;
            $data['message'] = 'Data tidak ditemukan';
        }
        return view('menu.kabupaten.detail', $data);
    }
    public function kabupatenList($id)
    {
        $data = Kabupaten::With('provinsi')->Where('provinsi_id',$id)->orderBy('id', 'ASC')->get();
        return response()->json($data);
    }
}
