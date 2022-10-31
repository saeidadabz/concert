<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewRoleRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\SingleRoleResource;
use App\Models\Permission;
use App\Models\Role;
use http\Env\Response;
use Illuminate\Http\Request;
use function Spatie\Ignition\ErrorPage\title;

class RoleController extends Controller
{


    public function index()
    {
        $roles=Role::all();
        return response()->json([
           'data'=>RoleResource::collection($roles)
        ]);
    }

    public function show(Role $role)
    {
        return response()->json([
            'data'=>new SingleRoleResource($role)

        ]);
    }

    public function store(NewRoleRequest $request)
    {
        $role=Role::query()->create([
            'title'=>$request->get('title'),
        ]);

        if ($request->filled('permissions'))
        {
            $permissions=Permission::query()->whereIn('title',$request->get('permissions'))->get();
            $role->permissions()->attach($permissions);
        }


        return response()->json([
           'data'=>[
               'role'=>new SingleRoleResource($role)
           ]
        ]);
    }

    public function update (Role $role, Request $request)
    {
        $roleExists=Role::query()->where('title',$request->get('title'))->where('id','!=',$role->id)->exists();
        if($roleExists){
            return response()->json([
                'data'=>['message'=>'title already been taken']
            ])->setStatusCode(400);
        }


        $role->update([
            'title'=>$request->get('title',$role->title)
        ]);

        $permissions=Permission::query()->whereIn('title',$request->get('permissions'))->get();
        $role->permissions()->sync($permissions);

        return response()->json([
           'data'=>[
               'role'=>new SingleRoleResource($role)
           ]
        ]);

    }



    public function destroy(Role $role)
    {
        if($role->exists){
            $roleHasUser= $role->users()->count();
            if ($roleHasUser>0) {
                return response()->json([
                    'data' => [
                        'message' => 'role has many user'
                    ]
                ])->setStatusCode(400);
            }
            $role->permissions()->detach();
            $role->delete();
            return response()->json([
                'data'=>[
                    'message'=>'role successfuly deleted'
                ]
            ])->setStatusCode(200) ;

        }

       }



}
