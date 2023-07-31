<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Session;

class TokenRevocationListener
{
    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $token = Session::get('token');

        if ($token) {
            $response = Http::post("http://127.0.0.1:8000/api/delete_token", [
                "token" => $token
            ]);

            if ($response->successful()) {
                $deletetoken = Http::post("http://127.0.0.1:8000/api/delete_token", [
                    "token" => Session::get('token')
                ]);
            return view('login');
            } else {
                
            }
        }

        Session::flush();
    }
}
