<?php

namespace Modules\Master\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class MasterController extends Controller
{
   public function unitkerjaIndex(){
       return view('master::unitkerja');
   }

   public function unitkerjaCreate(){

   }

   public function unitkerjaUpdate(){

   }
}
