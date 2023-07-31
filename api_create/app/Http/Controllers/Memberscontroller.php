<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\DB;

class Memberscontroller extends Controller
{
    public function get_token_api(Request $request)
    {
        $user = People::where('nickname', $request->nickname)->first();
    
        if ($user) {
            $token = $user->createToken('my-app-token')->plainTextToken;
            return $token;
        }
    }    


    public function delete_token(Request $request)
    {
        $token = $request->token;
    
        if ($token) {
            DB::table('personal_access_tokens')->where('id', $token)->delete();
            return "Başarıyla Silindi";
        }
        return "Hata Oluştu";
    }
    
}
