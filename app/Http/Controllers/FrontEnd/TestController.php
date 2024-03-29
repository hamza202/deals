<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Advertiser;
use Illuminate\Http\Request;
use \App\User;

class TestController extends Controller
{
    protected $serverKey;

    public function __construct()
    {
        $this->serverKey = config('app.firebase_server_key');
    }

    public function saveToken (Request $request)
    {
        $user = Advertiser::find($request->user_id);
        $user->fcm_token = $request->fcm_token;
        $user->save();

        if($user)
            return response()->json([
                'message' => 'User token updated'
            ]);

        return response()->json([
            'message' => 'Error!'
        ]);
    }

    public function sendPush (Request $request)
    {
        $user = Advertiser::find($request->id);
        $data = [
            "to" => $user->fcm_token,
            "notification" =>
                [
                    "title" => 'Web Push',
                    "body" => "Sample Notification",
                    "icon" => url('/logo.png')
                ],
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $this->serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        curl_exec($ch);

        return redirect('/home')->with('message', 'Notification sent!');
    }
}
