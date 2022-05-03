<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
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
        $branch = $data->all();
        $branch['data'] = json_decode($branch['data'],true);
        $branch['data']['info']['id_user'] = Auth::user()->id;
        $branch['data']['info']['id_company'] = Auth::user()->id_company;
        $branch = Branch::Create($branch['data']['info']);

        return $branch;
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
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        $model = Branch::find($id);
        return response()->json($model);
    }

    public function list()
    {
        $model = Branch::where('id_company', '=', Auth::user()->id_company)->get();
        return response()->json($model);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data)
    {
        $branch = $data->all();
        $branch['data'] = json_decode($branch['data'],true);
        $branch = Branch::updateOrCreate(['id' => $branch['data']['info']['id']],$branch['data']['info']);
        return $branch;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        $deletedBranch = Branch::where('id', $id['id'])->delete();
    }
}
