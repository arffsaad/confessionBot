<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class ConfiguratorController extends Controller
{
    public function index() {
        $bot_id = Redis::get('bot_id');
        if ($bot_id === null) {
            $user = User::find(1)->get();
            return view('configurator')->with('apitoken', $user[0]->api_token);
        }
        else {
            return view('welcome');
        }
    }
    public function test() {
        $user = User::find(1)->get();
        return view('configurator')->with('apitoken', $user[0]->api_token);
    }

    public function setBot(Request $request) {
        Redis::set('bot_id', request('finalToken'));
        Redis::set('chat_id', request('finalChannel'));
        return redirect('/');
    }
}