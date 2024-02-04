<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as ResourcesUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index' , 'show']);
    }
    public function index(Request $request)
    {
        $limit = $request->input('limit') <= 50 ?$request->input('limit'): 15;
        $user = ResourcesUser::collection(User::paginate($limit));
        return $user->response()
        ->setStatusCode(200 , "Users Returned succefully") ;
        // return Response::json(['data'=>$user],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create' , User::class);
        $user = new ResourcesUser(User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]));
        return  $user->response()
        ->setStatusCode(200 , "User Created succefully") ;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user =new ResourcesUser(User::findOrFail($id)) ;
        return $user->response()->setStatusCode(200 , "User Returned succefully")
        ->header('Additional Header' , 'True');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $idUser =  User::findOrFail($id);
        $this->authorize('update' ,  $idUser);
        $user = new ResourcesUser(User::findOrFail($id)) ;
        $user->update($request->all());
         return $user->response()->setStatusCode(204, "User Updated succefully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idUser =  User::findOrFail($id);
        $this->authorize('delete' ,  $idUser);

        $user = User::findOrFail($id);
        $user->delete();
        return 204;
    }
}
