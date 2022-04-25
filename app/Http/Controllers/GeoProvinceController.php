<?php

namespace App\Http\Controllers;

use App\GeoProvince;
use Illuminate\Http\Request;

class GeoProvinceController extends Controller
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
    public function create()
    {
        //
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
     * @param  \App\GeoProvince  $geoProvince
     * @return \Illuminate\Http\Response
     */
    public function show(GeoProvince $geoProvince)
    {
        //
    }

    public function list()
    {
        $model = GeoProvince::all();
        return response()->json($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GeoProvince  $geoProvince
     * @return \Illuminate\Http\Response
     */
    public function edit(GeoProvince $geoProvince)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GeoProvince  $geoProvince
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeoProvince $geoProvince)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GeoProvince  $geoProvince
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeoProvince $geoProvince)
    {
        //
    }
}
