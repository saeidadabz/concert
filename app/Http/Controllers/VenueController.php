<?php

namespace App\Http\Controllers;

use App\Http\Resources\SingleVenueResource;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index()
    {
       $venues=Venue::all();
       return response()->json([
          'data'=>SingleVenueResource::collection($venues)
       ]);
    }

    public function show(Venue $venue)
    {
        return response()->json([
           'data'=>new SingleVenueResource($venue)
        ]);

    }

    public function store(Request $request)
    {
  $venue=Venue::query()->create([
     'name'=>$request->get('name'),
     'location'=>$request->get('location'),
     'city'=>$request->get('city'),
     'capacity'=>$request->get('capacity'),
  ]);

  return response()->json([
     'data'=>new SingleVenueResource($venue)
  ]);

    }

    public function update(Venue $venue, Request $request)
    {
       $venue= $venue->update([
            'name'=>$request->get('name'),
            'location'=>$request->get('location'),
            'capacity'=>$request->get('capacity'),
            'city'=>$request->get('city')

        ]);

        return response()->json([
           'data'=>new SingleVenueResource($venue)
        ]);
    }


}
