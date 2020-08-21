<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use Auth;

class FriendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $friend = new Friend();
        $default_state = 0;  // pending
        $userId = auth()->check() ? auth()->id() : null;

        $friend->user_id_1 = $userId; // The requester
        $friend->user_id_2 = $request->data_id;
        $friend->state = $default_state;

        $result = $friend->save();

        // return [
        //     'friend_id' => $request->friend_id
        // ];
        return ['status' => $result];
    }


}
