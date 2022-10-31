<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        return response([
          'data'=>Category::all()
        ]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NewCategoryRequest $request)
    {
       $category= Category::query()->create([
            'title'=>$request->get('title')
        ]);
        return response()->json([
        'data'=>$category
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        return response()->json([
           'data'=>$category->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(NewCategoryRequest $request, Category $category)
    {

        $category->update([
           'title'=>$request->get('title')
        ]);
        return response()->json([
           'data'=>$category
        ]);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message'=>"has been deleted"
        ]);
    }
}
