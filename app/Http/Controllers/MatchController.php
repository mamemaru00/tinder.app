<?php

namespace App\Http\Controllers;

use App\Models\Swipe;
use Illuminate\Http\Request;
use App\Models\User;

class MatchController extends Controller
{

    public function index()
    {
        // 自分へいいねしてくれたユーザー
        $matchedUserIds = Swipe::where('to_user_id', \Auth::user()->id)
            ->where('is_like', true)
            ->pluck('from_user_id');

        // 自分へいいねしてくれたユーザーから自分がいいねしたユーザー = マッチしたユーザー
        $matchedUsers = Swipe::where('from_user_id', \Auth::user()->id)
            ->whereIn('to_user_id', $matchedUserIds)
            ->where('is_like', true)
            ->with('toUser')
            ->get();

        return view('pages.match.index', [
            'matchedUsers' => $matchedUsers
        ]);
    }
}
