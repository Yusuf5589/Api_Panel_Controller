<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;

class UpdateProduct extends Controller
{
    public function update_product(Request $request){

        $validator = Validator::make($request->all(), [
            "id" => "required|exists:product,id",
            "name" => 'required|min:3|unique:product,name,' . $request->id,
            "description" => 'required|min:3',
            "piece" => 'required|numeric',
            "price" => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $get_product = Products::where('id', $request->id)->update([
            "name" => $request->name,
            "description" => $request->description,
            "piece" => $request->piece,
            "price" => $request->price
        ]);

        return response()->json(['success' => true]);
}
}