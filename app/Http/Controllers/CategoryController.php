<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        $client = Category::Create($contact['data']['info']);

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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $client)
    {
        $model = Category::find($id);
        return response()->json($model);
    }

    public function list()
    {
        $model = Category::where('id_company', '=', Auth::user()->id_company)->get();
        return response()->json($model);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data)
    {
        $category = $data->all();
        $category['data'] = json_decode($category['data'],true);
        $category = Category::updateOrCreate(['id_category' => $category['data']['info']['id_category']],$category['data']['info']);
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        $deletedCategory = Category::where('id_category', $id['id_category'])->delete();
    }
}
