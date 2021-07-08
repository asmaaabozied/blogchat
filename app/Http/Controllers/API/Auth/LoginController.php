<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (\Auth::attempt($request->only('email', 'password'))) {
            return [
                'user' => auth()->user(),
                '_token' => auth()->user()->createToken('chat')->accessToken,
            ];
        } else {
            return response('invalid login credentials');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'country_id' => 'required|exists:countries,id',
        ]);
        $request['is_active'] = true;
        $user = User::create($request->all());
        \Auth::login($user);
        return [
            'user' => auth()->user(),
            '_token' => auth()->user()->createToken('chat')->accessToken,
        ];
    }

    public function social(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'name' => 'required'
        ]);

        $user = User::where('email', $request['email'])->first();
        if ($user) {
            \Auth::login($user);
            return [
                'user' => auth()->user(),
                '_token' => auth()->user()->createToken('chat')->accessToken,
            ];
        } else {
            $user = User::create($request->all());
            \Auth::login($user);
            return [
                'user' => auth()->user(),
                '_token' => auth()->user()->createToken('chat')->accessToken,
            ];
        }
    }
}
