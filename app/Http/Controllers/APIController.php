<?php
  
namespace App\Http\Controllers;

use App\User;
use App\Company;
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
        $company = null;
        $company_data = Company::where('id_user', '=', Auth::user()->id)->get();
        if (!$company_data->isEmpty()){
            $company_data = json_decode($company_data,true);
            $company = $company_data[0]['id_company'];
        }
        $data = ['id'=>Auth::user()->id, 'name'=>Auth::user()->name, 'email' => Auth::user()->email,'type'=>  Auth::user()->type,'company'=>$company];
   
        return response()->json($data);
    }
}