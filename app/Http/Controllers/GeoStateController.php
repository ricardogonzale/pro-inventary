<?php

namespace App\Http\Controllers;

use App\GeoState;
use Illuminate\Http\Request;

class GeoStateController extends Controller
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
     * @param  \App\GeoState  $geoState
     * @return \Illuminate\Http\Response
     */
    public function show(GeoState $geoState)
    {
        //
    }

    public function list()
    {
        $model = GeoState::all();
        return response()->json($model);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GeoState  $geoState
     * @return \Illuminate\Http\Response
     */
    public function edit(GeoState $geoState)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GeoState  $geoState
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeoState $geoState)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GeoState  $geoState
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeoState $geoState)
    {
        //
    }
}
