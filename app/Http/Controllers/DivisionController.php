<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DivisionController extends Controller
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
        $division = $data->all();
        $division['data'] = json_decode($division['data'],true);
        $division['data']['info']['id_user'] = Auth::user()->id;
        $division['data']['info']['id_company'] = Auth::user()->id_company;
        $division = Division::Create($division['data']['info']);

        return $division;
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
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        $model = Division::find($id);
        return response()->json($model);
    }

    public function list()
    {
        $model = Division::where('id_company', '=', Auth::user()->id_company)->get();
        return response()->json($model);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $division)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data)
    {
        $division = $data->all();
        $division['data'] = json_decode($division['data'],true);
        $division = Division::updateOrCreate(['id_division' => $division['data']['info']['id_division']],$division['data']['info']);
        return $division;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        $deletedDivision = Division::where('id_division', $id['id_division'])->delete();
    }
}
