<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show_profile($profile_id = NULL)
    {
        if($profile_id == NULL && Auth::user())
        {
            $profile_id = Auth::user()->id;
        }

        $user_id = NULL;

        if(Auth::user())
        {
            $user_id = Auth::user()->id;  
        }

        $users = User::find($profile_id);
        $comments = $users->load(['comments' => function($q) { $q->take(5)->orderBy('id', 'DESC'); }])->comments;
        return view('profile', ['comments' => $comments, 'profile_id' => $profile_id, 'user_id' => $user_id,
            'full_page' => NULL]);
    }

    public function show_full_profile($profile_id = NULL)
    {
        if($profile_id == NULL && Auth::user())
        {
            $profile_id = Auth::user()->id;
        }

        $user_id = NULL;

        if(Auth::user())
        {
            $user_id = Auth::user()->id;  
        }

        $users = User::find($profile_id);
        $comments = $users->load(['comments' => function($q) { $q->orderBy('id', 'DESC'); }])->comments;
        return view('profile', ['comments' => $comments, 'profile_id' => $profile_id, 'user_id' => $user_id,
            'full_page' => '1']);
    }

    public function users_list()
    {
        $users = User::all();
        return view('users', ['users' => $users]);
    }
}