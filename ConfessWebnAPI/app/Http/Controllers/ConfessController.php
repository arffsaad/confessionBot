<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ConfessController extends Controller
{
    public function store (Request $req) {
        // get current index
        $index = Redis::get('index');
        if ($index === null) {
            // set redis index as 0
            Redis::set('index', 0);
            $index = Redis::get('index');
        };
        // store the confession in redis
        Redis::hmset("confess:{$index}", [
            'confession' => $req->input('confession'),
            'date' => date('Y-m-d')
        ]);
        // increase index for next insertion
        Redis::incr('index');
        // redirect to home page
        return redirect('/');
    }

    public function storeAPI (Request $req) {
        // validate if confession is present, if not, return 400 bad request
        if (!$req->has('confession')) {
            return response()->json([
                'message' => 'Bad Request : Confession not found'
            ], 400);
        }
        else {
        // get current index
        $index = Redis::get('index');
        if ($index === null) {
            // set redis index as 0
            Redis::set('index', 0);
            $index = Redis::get('index');
        };
        // store the confession in redis
        Redis::hmset("confess:{$index}", [
            'confession' => $req->input('confession'),
            'date' => date('Y-m-d')
        ]);
        // increase index for next insertion
        Redis::incr('index');
        // return 200 success
        return response()->json([
            'message' => 'Success : Confession stored'
        ], 200);
        }
    }
}
