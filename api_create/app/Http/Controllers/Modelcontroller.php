<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\People;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class Modelcontroller extends Controller
{

    public function get_data($api, $item = null)
    {




        if ($api == 'users') {
            $japi = People::get();
            return response()->json($japi, 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            $japi = People::where('id', $api)->orWhere("name", $api)->orWhere("surname", $api)->orWhere("nickname", $api)->orWhere("password", $api)->orWhere("passwordagain", $api);
    
            if ($item == 'id') {
                $japi = $japi->select('id')->first();
            }
            else if($item == 'name'){
                $japi = $japi->select('name')->first();
            }
            else if($item == 'surname'){
                $japi = $japi->select('surname')->first();
            }
            else if($item == 'nickname'){
                $japi = $japi->select('nickname')->first();
            }
            else if($item == 'password'){
                $japi = $japi->select('password')->first();
            }
            else if($item == 'created_at'){
                $japi = $japi->select('created_at')->first();
            }
            else if($item == 'updated_at'){
                $japi = $japi->select('updated_at')->first();
            }
            else if($item == 'passwordagain'){
                $japi = $japi->select('passwordagain')->first();
            }
            else {
                $japi = $japi->first();
            }
    
            if (!$japi) {
                return response()->json(["error" => 'API not found'], 404);
            }
    
            return response()->json($japi, 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    }
    
    



    public function data_list(){
        return response()->json(People::get() ,200 ,[] , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 
    }
    


    public function create_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:15',
            'surname' => 'required|min:3|max:15',
            'nickname' => 'required|min:3|max:15|unique:people|regex:/^[^\s]+$/',
            'password' => 'required|min:8|max:16',
            'passwordagain' => 'required|min:8|max:16|same:password'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        People::create([
            "name" => $request->name,
            "surname" => $request->surname,
            "nickname" => $request->nickname,
            "password" => md5($request->password),
            "passwordagain" => md5($request->passwordagain),
        ]);

        return response()->json(['message' => 'Başarıyla kullanıcı oluşturuldu'], 200);
    }

    
    public function login(Request $request){
        $validator2 = Validator::make($request->all(), [
            'nickname' => 'required|min:3|max:15|exists:people,nickname|regex:/^[^\s]+$/',
            'password' => 'required|min:8|max:16',
        ]);
    
        if ($validator2->fails()) {
            return response()->json($validator2->errors(), 400);
        }
    }
    
}
