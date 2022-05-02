<?php

namespace App\Http\Controllers;
use App\User;
use App\Client;
use App\Carrier;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Form;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    protected function deleteCliente(Request $id){
        $user = Client::find($id['id']);
        if ($user){
            Storage::disk('public')->delete('clients/activity_memory/'.$user['activity_memory']);
        }
        $deletedClient = Client::where('id', $id['id'])->delete();
    }
    protected function updateCliente(Request $data)
    {

        $client = $data->all();
        $client['data'] = json_decode($client['data'],true);
        $client = Client::updateOrCreate(['id' => $client['data']['info']['id']],$client['data']['info']);
        return $client;
    }

    protected function registrarCliente(Request $data)
    {
        $contact = $data->all();
        $contact['data'] = json_decode($contact['data'],true);
        $contact['data']['info']['id_user'] = Auth::user()->id;
        $contact['data']['info']['company'] = Auth::user()->company;
        
        if ($contact['imagen']['img'] != 'undefined'){
            $file = $contact['imagen']['img'];
            $namefile = time().'-'.$contact['data']['info']['id_user'].'-'.preg_replace("/[^a-z0-9\_\-\.]/i", "", $contact['imagen']['img']->getClientOriginalName());
            $contact['data']['info']['img'] = $namefile;
            Storage::disk('public')->put('clients/img/'.$namefile,\File::get($file));
        }
        
        $client = Client::Create($contact['data']['info']);
        
        return $client;
    }

}
