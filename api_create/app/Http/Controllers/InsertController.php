<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Validator;

class InsertController extends Controller
{
    public function Insert(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => 'required|min:3|unique:product',
            "description" => 'required|min:3',
            "piece" => 'required|numeric',
            "price" => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Products::create([
            "name" => $request->name,
            "description" => $request->description,
            "piece" => $request->piece,
            "price" => $request->price
        ]);
        return response()->json(['success' => true]);
    }
}