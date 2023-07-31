<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RouteController extends Controller
{
    
    public function loginView()
    {
        return view('login');
    }

    public function recordView()
    {
        return view('record');
    }

    public function homeView()
    {
        $token = Session::get('token');
        if($token){
            return view('home');
        }
        Session::flash("errorhome", "Login first.");
        return redirect()->route('login');
        Session::flush();
    }
    

    public function delete_token()
    {

            $deletetoken = Http::withToken(Session::get('token'))->post("http://127.0.0.1:8000/api/delete_token", [
                "token" => Session::get('token')
            ]);
            Session::flash("token", "");
            Session::flash("logoutsuccess", "You have successfully logged out");
            return redirect()->route('login');
    }


    public function refresh(){
        $getapi = Http::withToken(Session::get('token'))->get("http://localhost:8000/api/get-product/all")->json();
        session(['getapiall' => $getapi]);
        return view('home');
    }

}
