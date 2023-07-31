<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DeleteController extends Controller
{
    public function deletepost(Request $request){
        $delete = Http::withToken(Session::get('token'))->post("http://127.0.0.1:8000/api/delete-product/", [
            "id" => $request->id
        ]);
        $getapi = Http::withToken(Session::get('token'))->get("http://localhost:8000/api/get-product/all")->json();
        session(['getapiall' => $getapi]);

        Session::flash("deletesucces", "Successfully Deleted");
        return redirect()->route('home');
        Session::flush();
    }
}
