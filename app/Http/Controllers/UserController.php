<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Models\User;
use Response;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        if ($request->ajax()) {
            $auth = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if (Auth::attempt($auth)) {
                return Response::json(['success' => true, 'url' => route('home')]);
            }

            return Response::json(['success' => false, 'messages' => trans('settings.login_error')]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function register(RegisterRequest $request)
    {
        if ($request->ajax()) {
            $userRegister = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => config('common.user.role.customer'),
                'avatar' => config('common.user.avatar_default'),
            ];

            $authUser = User::create($userRegister);
            Auth::login($authUser);

            return Response::json(['success' => true, 'url' => route('home')]);
        }
    }
}
