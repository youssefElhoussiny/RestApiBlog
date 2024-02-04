<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\User as ResourcesUser;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.basic.once');
    }
    public function login()
    {
        $Accesstoken = Auth::user()->createToken('Access Token')->accessToken;

        return Response(['User' => new ResourcesUser(Auth::user()), 'Access Token' => $Accesstoken]);

    }
}
