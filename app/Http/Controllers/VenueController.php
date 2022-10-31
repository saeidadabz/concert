<?php

namespace App\Http\Controllers;

use App\Http\Resources\SingleVenueResource;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index()
    {

    }

    public function show(Venue $venue)
    {

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
}
