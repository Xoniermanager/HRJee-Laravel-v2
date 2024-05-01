<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use TypeError;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function send_response($message='', $data='') {

        $response =  [
            'status'    => 'success',
            'message'   => $message,
            'data'      => $data
        ];

        return response()->json($response, 200);

    }

    public function send_error($code, $system_error=0, $error='', $error_messages='', $data = null) {

        $returned_error_messages = null;

        try {
            $returned_error_messages = json_decode($error_messages, true);
            if($returned_error_messages === null) $returned_error_messages = $error_messages;

        } catch (Exception $e) {
            $returned_error_messages = $error_messages;
        } catch (TypeError $e){
            $returned_error_messages = $error_messages;
        }

        $response = [
            'status'                => 'failed',
            'error'                 => $error,
            'error_messages'        => $returned_error_messages,
            'system_error'          => $system_error,
            'data'                  => $data,
        ];

        return response()->json($response, $code);

    }
}
