<?php

namespace App\Http\Controllers;

use App\Models\Swipe;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        // すでにswipeしたuserを省いて、swipeしていないuserを1つ取得する

        //すでに取得したuser・idsを取得
        $swipeduserIds =  Swipe::where('from_user_id', \Auth::user()->id)->get()->pluck('to_user_id');

        //swipeしていないuserを1一つ取得
        $user = User::where('id', '<>', \Auth::user()->id)->whereNotIn('id', $swipeduserIds)->first();

        return view('pages.user.index', [
            'user' =>$user,
        ]);
    }
}
