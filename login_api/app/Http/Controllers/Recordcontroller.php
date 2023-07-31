<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class Recordcontroller extends Controller
{

    public function recordview()
    {
        return view('record');
    }
    
    public function recordpost(Request $request)
    {

        if ($request->input("name") != "") {
            $namevalue= $request->input('name');
            Session::flash('namevalue', $namevalue);
        }
        if ($request->input("surname") != "") {
            $surnamevalue= $request->input('surname');
            Session::flash('surnamevalue', $namevalue);
        }
        if ($request->input("nickname") != "") {
            $nicknamevalue= $request->input('nickname');
            Session::flash('nicknamevalue', $nicknamevalue);
        } 



        $response = Http::post('http://127.0.0.1:8000/api/create-data', [
            "name" => $request->name,
            "surname" => $request->surname,
            "nickname" => $request->nickname,
            "password" => $request->password,
            "passwordagain" => $request->passwordagain
        ]);

        $errors = $response->json();

        if (isset($errors['name'])) {
            $nameErrors = [];
            foreach ($errors['name'] as $error) {
                $nameErrors[] = htmlspecialchars($error);
            }
            $nameErrorsString = implode(", ", $nameErrors);
            Session::flash('nameerror', $nameErrorsString);
        }

        if(isset($errors['surname'])){
            $surnameErrors = [];
            foreach($errors['surname'] as $error){
                $surnameErrors[] = htmlspecialchars($error);
            }
            $surnameErrorsString = implode(", ", $surnameErrors);
            Session::flash('surnameerror', $surnameErrorsString);
        }

        if(isset($errors['nickname'])){
            $nicknameErrors = [];
            foreach($errors['nickname'] as $error){
                $nicknameErrors[] = htmlspecialchars($error);
            }
            $nicknameErrorsString = implode(', ', $nicknameErrors);
            Session::flash('nicknameerror', $nicknameErrorsString);
        }

        if(isset($errors['password'])){
            $passwordErrors = [];
            foreach($errors['password'] as $error){
                $passwordErrors[] = htmlspecialchars($error);
            }
            $passwordErrorsString = implode(', ', $passwordErrors);
            Session::flash('passworderror', $passwordErrorsString);
        }

        if(isset($errors['passwordagain'])){
            $passwordagainErrors = [];
            foreach($errors['passwordagain'] as $error){
                $passwordagainErrors[] = htmlspecialchars($error);
            }
            $passwordagainErrorsString = implode(', ', $passwordagainErrors);
            Session::flash('passwordagainerror', $passwordagainErrorsString);
        }
        
        if (empty($errors['name']) && empty($errors['surname']) && empty($errors['nickname']) && empty($errors['password']) && empty($errors['passwordagain'])) {
            Session::flash("recordsucces", "You have successfully registered.");
            Session::flash('namevalue', "");
            Session::flash('surnamevalue', "");
            Session::flash('nicknamevalue', "");
            Session::flash('passwordvalue', "");
            return redirect()->route("login");
        }
        

        return redirect()->back();
    }

}
