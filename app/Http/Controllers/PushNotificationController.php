<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Services\SendNotification;

class PushNotificationController extends Controller
{
    public function sendTest()
    {
        $user = User::find(2);

        if (!$user || !$user->fcm_token) {
            return 'No user or missing FCM token for Arjun User.';
        }
        $success = SendNotification::send(
            $user->fcm_token,
            'Hello!',
            'This is a test push from static FcmV1Service!',
            ['foo' => 'bar'],
            $user->id
        );

        return $success ? 'Notification sent!' : 'Notification failed.';
    }
}
