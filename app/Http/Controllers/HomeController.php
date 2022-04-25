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
        $deletedUser = User::where('id', $id['id_user'])->delete();
        $user = Client::find($id['id']);
        if ($user){
            Storage::disk('public')->delete('clients/activity_memory/'.$user['activity_memory']);
        }
        $deletedClient = Client::where('id', $id['id'])->delete();
    }
    protected function updateCliente(Request $data)
    {

        $contact = $data->all();
        $contact['data'] = json_decode($contact['data'],true);

        $client = Client::updateOrCreate(['id_user' => $contact['data']['info']['id_user']],$contact['data']['info']);
        return $client;
    }

    protected function registrarCliente(Request $data)
    {
        $contact = $data->all();
        $contact['data'] = json_decode($contact['data'],true);
        $user = User::updateOrCreate(['id' => $contact['data']['info']['id']],[
            'name' => $contact['data']['info']['name'],
            'email' => $contact['data']['info']['email'],
            'type' => 1,
            'password' => Hash::make($contact['data']['info']['password']),
        ]); 
        event(new Registered($user));

        // auth()->login($user);
        $contact['data']['info']['id_user'] = $user['id'];

        if ($contact['activy']['img'] != 'undefined'){
            $file = $contact['activy']['img'];
            $namefile = time().'-'.$contact['data']['info']['id'].'-'.preg_replace("/[^a-z0-9\_\-\.]/i", "", $contact['activy']['img']->getClientOriginalName());
            $contact['data']['info']['activity_memory'] = $namefile;
            Storage::disk('public')->put('clients/activity_memory/'.$namefile,\File::get($file));
        }
        $client = Client::updateOrCreate(['id_user' => $contact['data']['info']['id_user']],$contact['data']['info']);
        return $user;
    }

    protected function deleteCarrier(Request $id){
        $deletedUser = User::where('id', $id['id_user'])->delete();
        $user = Carrier::find($id['id']);
        if ($user){
            Storage::disk('public')->delete('carriers/logo/'.$user['logo']);
            Storage::disk('public')->delete('carriers/documents_support/'.$user['documents_support']);
        }
        $deletedClient = Carrier::where('id', $id['id'])->delete();
    }
    protected function updateCarrier(Request $data)
    {

        $contact = $data->all();
        $contact['data'] = json_decode($contact['data'],true);

        $carrier = Carrier::updateOrCreate(['id_user' => $contact['data']['info']['id_user']],$contact['data']['info']);
        return $carrier;
    }

    protected function dataCarrier()
    {
        $dataUser = Carrier::where('id_user', '=', Auth::user()->id)->get();
        return response()->json($dataUser[0]);
    }

    
    protected function registrarCarrier(Request $data)
    {
        $contact = $data->all();
        $contact['data'] = json_decode($contact['data'],true);
        $user = User::updateOrCreate(['id' => $contact['data']['info']['id']],[
            'name' => $contact['data']['info']['name'],
            'email' => $contact['data']['info']['email'],
            'type' => 2,
            'password' => Hash::make($contact['data']['info']['password']),
        ]); 
        event(new Registered($user));

        // auth()->login($user);
        $contact['data']['info']['id_user'] = $user['id'];

        if ($contact['logo']['img'] != 'undefined'){
            $file = $contact['logo']['img'];
            $namefile = time().'-'.$contact['data']['info']['id'].'-'.preg_replace("/[^a-z0-9\_\-\.]/i", "", $contact['logo']['img']->getClientOriginalName());
            $contact['data']['info']['logo'] = $namefile;
            Storage::disk('public')->put('carriers/logo/'.$namefile,\File::get($file));
        }
        if ($contact['documents_support']['img'] != 'undefined'){
            $file = $contact['documents_support']['img'];
            $namefile = time().'-'.$contact['data']['info']['id'].'-'.preg_replace("/[^a-z0-9\_\-\.]/i", "", $contact['documents_support']['img']->getClientOriginalName());
            $contact['data']['info']['documents_support'] = $namefile;
            Storage::disk('public')->put('carriers/documents_support/'.$namefile,\File::get($file));
        }
        $client = Carrier::updateOrCreate(['id_user' => $contact['data']['info']['id_user']],$contact['data']['info']);
        return $user;
    }
}
