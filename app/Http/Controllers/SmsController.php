<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;


class SmsController extends Controller
{
    public function send()
    {
        $twilio = new Client(
            env('TWILIO_SID'),
            env('TWILIO_AUTH_TOKEN')
        );
        try {
            $twilio->messages->create(
                '+917835057399', // recipient number in E.164 format
                [
                    'from' => env('TWILIO_PHONE'),
                    'body' => 'Hello from Laravel using Twilio!'
                ]
            );
            return response()->json(['message' => 'SMS sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
