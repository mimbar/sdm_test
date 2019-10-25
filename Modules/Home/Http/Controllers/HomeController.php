<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home::home.dashboard');
    }

    public function acl(){
        echo "Acl Page. <a href='".route('home.index')."'> Kembali</a>";
    }

    public function users(){
        echo "Users Page. <a href='".route('home.index')."'> Kembali</a>";
    }

    public function profile(){
        echo "Profile Page. <a href='".route('home.index')."'> Kembali</a>";
    }


}
