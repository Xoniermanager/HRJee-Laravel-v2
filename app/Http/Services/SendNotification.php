<?php

namespace App\Http\Services;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Http;
use App\Models\PushNotification;

class SendNotification
{
    /**
     * Send FCM notification (static)
     */
    public static function sendNotification($token, $title, $body, array $data = [], $userId = null)
    {
        $serviceAccountPath = base_path('firebase-service-account.json');
        // Load the JSON and get project_id directly
        $serviceAccount = json_decode(file_get_contents($serviceAccountPath), true);
        $projectId = $serviceAccount['project_id'];
        $client = new GoogleClient();
        $client->setAuthConfig($serviceAccountPath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";


        $payload = [
            'message' => [
                'token' => $token, 
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                'data' => $data,
            ]
        ];

        $response = Http::withToken($accessToken)->post($url, $payload);

        $success = $response->successful();

        // Log to DB
        PushNotification::create([
            'user_id' => $userId,
            'title' => $title,
            'body' => $body,
            'data' => $data,
            'token' => $token,
            'success' => $success,
            'response' => $response->body(),
        ]);

        return $success;
    }
}
