<?php

namespace App\Http\Controllers;

use App\GeoCountry;
use Illuminate\Http\Request;

class GeoCountryController extends Controller
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
     * @param  \App\GeoCountry  $geoCountry
     * @return \Illuminate\Http\Response
     */
    public function show(GeoCountry $geoCountry)
    {
        //
    }

    public function list()
    {
        $model = GeoCountry::all();
        return response()->json($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GeoCountry  $geoCountry
     * @return \Illuminate\Http\Response
     */
    public function edit(GeoCountry $geoCountry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GeoCountry  $geoCountry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeoCountry $geoCountry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GeoCountry  $geoCountry
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeoCountry $geoCountry)
    {
        //
    }
}
