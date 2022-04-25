<?php
  
namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
  
class APIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct() {
        $this->middleware('auth');
    }

    public function getUserinfo()
    {
        $data = ['id'=>Auth::user()->id, 'name'=>Auth::user()->name, 'email' => Auth::user()->email,'type'=>  Auth::user()->type];
   
        return response()->json($data);
    }
}