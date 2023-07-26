<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Redirect, Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'User',
            'menu' => 'User',
            'submenu' => ''
        );
        $data['data'] = Users::get();
        // dd($data);
        return view('menu.user.index', $data);
    }
    public function add(Request $request){
        try{
            $userID = $request->post_id;
            $cekmail   = Users::where('email',$request->email)->first();
            if($cekmail){
                return Response::json(['status_msg' => false,'message' => 'Email sudah terdaftar']);
            }
            if($request->password){
                $user   =   Users::updateOrCreate(
                    ['id' => $userID],
                    [
                        'name' => $request->nama,
                        'email' => $request->email,
                        'gender' => $request->gender,
                        'password' => Hash::make($request->password),
                        'role' => $request->role,
                        'status' => '1',
                    ],
                );
            }else{
                $user   =   Users::updateOrCreate(
                    ['id' => $userID],
                    [
                        'name' => $request->nama,
                        'email' => $request->email,
                        'gender' => $request->gender,
                        'role' => $request->role,
                        'status' => '1',
                    ],
                );
            }
            
            $user['status_msg'] = true;
            $user['message'] = 'Berhasil';
    
            return Response::json($user);
        }catch(Exception $ex){
            return Response::json(['status_msg' => false,'message' => 'Silahkan cek kembali form anda']);
        }
    }
    public function detail($id){
        $id = Crypt::decrypt($id);
        $user   = Users::where('id',$id)->first();
        return Response::json($user);
    }
    public function cekEmail(Request $request)
    {
        $data = Users::where('email', $request->email)->first();
        if(!empty($data)){
            return new JsonResponse(array('error' => true, 'Message' => "Email Sudah Ada !"));
        }else{
            return new JsonResponse(array('error' => false));
        }
    }
    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $user = Users::where('id', $id)->first();
        if($user){
            $user->status = 0;
            $user->save();
        }

        return Response::json($user);
    }
    public function activate($id)
    {
        $id = Crypt::decrypt($id);
        $user = Users::where('id', $id)->first();
        if($user){
            $user->status = 1;
            $user->save();
        }

        return Response::json($user);
    }
}
