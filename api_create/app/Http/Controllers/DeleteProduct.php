<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
Use Illuminate\Support\Facades\Validator;

class DeleteProduct extends Controller
{
    public function delete_product(Request $request){

            $validator = Validator::make($request->all(), [
                "id" => "required|exists:product,id",
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }

            $get_product = Products::where('id', $request->id)->first();
            $get_product->delete();
            return response()->json("Başarıyla Silindi", 200);
    }
    
}