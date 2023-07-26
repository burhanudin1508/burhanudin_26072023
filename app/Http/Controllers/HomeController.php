<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = array(
            'title' => 'Home Page',
            'menu' => 'home',
            'submenu' => ''
        );
        $data['active'] = Users::where('status', '=', 1)->orderBy('id', 'ASC')->get();
        $data['inactive'] = Users::where('status', '=', 0)->orderBy('id', 'ASC')->get();
        return view('menu.home.home', $data);
    }
}
