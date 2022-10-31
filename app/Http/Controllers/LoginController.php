<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @var User $user
     */
    public function store(LoginRequest $request)
    {
       $user = User::query()->where('email',$request->get('email'))->first();
       $permissions=$user->role->permissions()->pluck('title')->toArray();
       /*var_dump($permissions);*/

        if ( !$user ||  !Hash::check($request->get('password'),$user->password)){
            return response()->json([
                'data'=>[
                    'message'=>'wrong password or email!'
                ]
            ],400);
        }

        $user->tokens()->delete();


        return response()->json([
            'data'=>['token'=>$user ->createToken('access_token',$permissions)->plainTextToken]
        ]);

    }
    public function destroy(Request $request)
    {
        auth()->user()->tokens()->delete();
return response()->json([
   'data'=>[
       'message'=>'you are logged out'
   ]

]);

    }
}
