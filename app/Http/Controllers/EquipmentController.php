<?php

namespace App\Http\Controllers;

use App\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
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
        $contact['data']['info']['id_user'] = Auth::user()->id;
        $contact['data']['info']['id_company'] = Auth::user()->id_company;
        $client = Equipment::Create($contact['data']['info']);

        return $client;
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
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */

    public function show(Equipment $client)
    {
        $model = Equipment::find($id);
        return response()->json($model);
    }

    public function list(Equipment $client)
    {
        $model = Equipment::where('id_company', '=', Auth::user()->id_company)->get();
        return response()->json($model);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data)
    {
        $equipment = $data->all();
        $equipment['data'] = json_decode($equipment['data'],true);
        $equipment = Equipment::updateOrCreate(['id_equipment' => $equipment['data']['info']['id_equipment']],$equipment['data']['info']);
        return $equipment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        $deletedEquipment = Equipment::where('id_equipment', $id['id_equipment'])->delete();
    }
}
