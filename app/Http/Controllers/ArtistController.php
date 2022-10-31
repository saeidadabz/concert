<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Http\Resources\ArtistResource;
use App\Models\Artist;
use App\Models\User;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data'=> ArtistResource::collection(Artist::all())
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
    public function store(NewArtistRequest $request)
    {
        $artistDirectory=$request->get('full_name').now()->timestamp;

        $avatar=$request->file('avatar')->storePubliclyAs('public/artists/'.$artistDirectory,
            $request->file('avatar')->getClientOriginalName());

         $background=$request->file('background')->storePubliclyAs('public/artists/'.$artistDirectory,
            $request->file('background')->getClientOriginalName());


       $artist= Artist::query()->create([
            'full_name'=> $request->get('full_name'),
            'category_id'=> $request->get('category_id'),
            'avatar'=> $avatar,
            'background'=> $background
        ]);


        return response()->json([
            'data'=> new ArtistResource($artist)

        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Artist $artist)
    {
        return response()->json([
            'data'=>new ArtistResource($artist)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArtistRequest $request, Artist $artist)
    {
        $directory=explode('/',$artist->avatar);
        array_pop($directory);
        $directory=implode('/',$directory);



        $artist->update([
            'full_name'=>$request->get('full_name',$artist->full_name),
            'category_id'=>$request->get('category_id'),
            'avatar'=>$request->get('avatar'),
            'background'=>$request->get('background')
        ]);

        return response($artist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return response([
            'message'=>'user been deleted'
        ]);
    }
}
