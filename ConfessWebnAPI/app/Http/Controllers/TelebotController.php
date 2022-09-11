<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
use App\Models\User;

class TelebotController extends Controller
{
    public function toBot () {
        $index = Redis::get('index');
        $read = Redis::get('rindex');
        if ($read != $index){
            $message = Redis::hget("confess:{$read}", 'confession');
            $bot_id = Redis::get('bot_id');
            $chat_id = Redis::get('chat_id');
            $client = new Client();
            $response = $client->request('POST', "https://api.telegram.org/bot{$bot_id}/sendMessage", [
                'form_params' => [
                    'chat_id' => "{$chat_id}",
                    'text' => "{$message}"
                ]
            ]);
            Redis::incr('rindex');
            // return 200 success
            return response()->json([
                'message' => 'Success : Message sent to channel'
            ], 200);
        }
        else {
            // return response 200 success
            return response()->json([
                'message' => 'Success : No new messages in queue'
            ], 200);
        }
    }
}
