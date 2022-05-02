<?php

namespace App\Http\Controllers;
use App\User;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        $contact = $data->all();
        $contact['data'] = json_decode($contact['data'],true);
        $user = User::updateOrCreate(['id' => $contact['data']['info']['id']],[
            'name' => $contact['data']['info']['company_name'],
            'email' => $contact['data']['info']['email'],
            'type' => 1,
            'password' => Hash::make($contact['data']['info']['password']),
        ]); 
        event(new Registered($user));
        // auth()->login($user);
        $contact['data']['info']['id_user'] = $user['id'];
        $client = Company::updateOrCreate(['id_user' => $contact['data']['info']['id_user']],$contact['data']['info']);
        $user->id_company = $client->id_company;
        $user->save();
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $model = Company::find($id);
        return response()->json($model);
    }

    public function list(Company $company)
    {
        $model = Company::all();
        return response()->json($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data)
    {

        $contact = $data->all();
        $contact['data'] = json_decode($contact['data'],true);

        $client = Company::updateOrCreate(['id_user' => $contact['data']['info']['id_user']],$contact['data']['info']);
        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id){
        $deletedUser = User::where('id', $id['id_user'])->delete();
        $deletedCompany = Company::where('id_user', $id['id_user'])->delete();
    }
}
