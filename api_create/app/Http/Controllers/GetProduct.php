<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class GetProduct extends Controller
{
    public function get_product($item, $value = null){

        if($item == "all"){
            $get_product = Products::get();
            return response()->json($get_product, 200);
        }else{
            if($item == "id"){
                $get_api = Products::where("id", $value)->first();
                return response()->json($get_api, 200);
            }
            if($item == "name"){
                $get_api = Products::where("name", $value)->first();
                return response()->json($get_api, 200);
            }
            if($item == "description"){
                $get_api = Products::where("description", $value)->first();
                return response()->json($get_api, 200);
            }
            if($item == "piece"){
                $get_api = Products::where("piece", $value)->first();
                return response()->json($get_api, 200);
            }
            if($item == "price"){
                $get_api = Products::where("price", $value)->first();
                return response()->json($get_api, 200);

            }
            return response()->json($get_api, 200);
        }
    
    }
    public function get_product_all(){
        $get_product = Products::get();
        return response()->json($get_product, 200);
    }
}
