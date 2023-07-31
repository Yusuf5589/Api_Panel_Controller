<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class Logincontroller extends Controller
{
    
    public function loginview()
    {
        return view('login');
    }

    public function loginpost(Request $request)
    {

        $response = Http::post('http://127.0.0.1:8000/api/login', [
            "nickname" => $request->loginnickname,
            "password" => $request->loginpassword,
        ]);

        $errors = $response->json();

        if(isset($errors['nickname'])){
            $nicknameErrors = [];
            foreach($errors['nickname'] as $error){
                $nicknameErrors[] = htmlspecialchars($error);
            }
            $nicknameErrorsString = implode(', ', $nicknameErrors);
            Session::flash('lnicknameerror', $nicknameErrorsString);
        }

        if(isset($errors['password'])){
            $passwordErrors = [];
            foreach($errors['password'] as $error){
                $passwordErrors[] = htmlspecialchars($error);
            }
            $passwordErrorsString = implode(', ', $passwordErrors);
            Session::flash('lpassworderror', $passwordErrorsString);
        }

        if ($request->input("loginnickname") != "") {
            $loginnickname= $request->input('loginnickname');
            Session::flash('loginnickname', $loginnickname);
        } 
        $token = '97|b9aPwlw2zLEvgByLGsGLlyqd78QC3FLYJNs6uk8l'; 

        $getapi = Http::withToken($token)->get("http://127.0.0.1:8000/api/get-data")->json();



        if ($request->filled("loginnickname")) {
            if (collect($getapi)->where('nickname', $request->loginnickname)->isEmpty()) {
                Session::flash("errornickname2", "There is no such user");
                return redirect()->back();
            }
        }
        

        $user = collect($getapi)->where('nickname', $request->loginnickname)->first();
        if($user){
            if ($user["password"] == md5($request->loginpassword)) {
                $posttoken = Http::post("http://127.0.0.1:8000/api/get_token_api",[
                    "nickname" => $request->loginnickname
                ]);
                // Session::flash("token", $posttoken->body());
                session(['token' => $posttoken->body()]);
                $getapi = Http::withToken($posttoken)->get("http://localhost:8000/api/get-product/all")->json();
                session(['getapiall' => $getapi]);
                Session::flash('loginnickname', "");
                Session::flash('loginsucces', "You have successfully logged in");
                return redirect()->route('home');
            } else {
                Session::flash("errorpassword", "Incorrect password");
            }
        }
       
        return redirect()->route('login');
    }

}
