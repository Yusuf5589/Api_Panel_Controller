<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Editcontroller extends Controller
{
    public function edit(Request $request){
        // $editpost = Http::post("http://localhost:8000/api/update-product/", [
        //     "id" => $request->id,
        //     "name" => $request->name,
        //     "description" => $request->description,
        //     "piece" => intval($request->piece),
        //     "price" => intval($request->price)
        // ]);
        // $errors = $editpost->json();


        // if (isset($errors['name'])) {
        //     $nameErrors = [];
        //     foreach ($errors['name'] as $error) {
        //         $nameErrors[] = htmlspecialchars($error);
        //     }
        //     $nameErrorsString = implode(", ", $nameErrors);
        //     Session::flash('enameerror', $nameErrorsString);
        // }

        // if (isset($errors['description'])) {
        //     $descriptionErrors = [];
        //     foreach ($errors['description'] as $error) {
        //         $descriptionErrors[] = htmlspecialchars($error);
        //     }
        //     $descriptionErrorsString = implode(", ", $descriptionErrors);
        //     Session::flash('descriptionerror', $descriptionErrorsString);
        // }
        
        // if (isset($errors['piece'])) {
        //     $pieceErrors = [];
        //     foreach ($errors['piece'] as $error) {
        //         $pieceErrors[] = htmlspecialchars($error);
        //     }
        //     $pieceErrorsString = implode(", ", $pieceErrors);
        //     Session::flash('pieceerror', $pieceErrorsString);
        // }

        // if (isset($errors['price'])) {
        //     $priceErrors = [];
        //     foreach ($errors['price'] as $error) {
        //         $priceErrors[] = htmlspecialchars($error);
        //     }
        //     $priceErrorsString = implode(", ", $priceErrors);
        //     Session::flash('priceerror', $priceErrorsString);
        // }

        // if(!isset($errors['name']) && !isset($errors['description']) && !isset($errors['piece']) && !isset($errors['price'])){
        //     Session::flash('updatesucces', "Update Successful");
        // }
        Session::flash('updatesucces', "Update Successful");
        $getapi = Http::withToken(Session::get('token'))->get("http://localhost:8000/api/get-product/all")->json();
        session(['getapiall' => $getapi]);
        return redirect()->route('home');
        Session::flush();
    }
}
