<?php

namespace App\Http\Controllers;

use App\Models\SendRequestAPI;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'no_wa' => 'required',
            'password' => 'required'
        ]);

        $response = SendRequestAPI::sendPost('auth/login', null, $request);

        if ($response->meta->code == 200) {
            session(['token' => $response->data->token]);
            session(['name' => $response->data->user->name]);
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('error', $response->meta->message);
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
