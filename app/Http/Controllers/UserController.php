<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show_profile($profile_id = NULL)
    {  
        $profile_id = $this->get_profile_id($profile_id);
        $user_id = $this->get_user_id();
        $profile = $this->get_profile($profile_id);

        $comments = $profile->load(['comments' => function($q) { $q->take(5)->orderBy('id', 'DESC'); }])->comments;

        
        return view('profile', ['comments' => $comments, 'profile_id' => $profile_id, 'user_id' => $user_id,
            'full_page' => NULL, 'profile' => $profile->name]);
    }

    public function show_full_profile($profile_id = NULL)
    {

        $profile_id = $this->get_profile_id($profile_id);

        $user_id = $this->get_user_id();

        $profile = $this->get_profile($profile_id);

        $comments = $profile->load(['comments' => function($q) { $q->orderBy('id', 'DESC'); }])->comments;
        
        return view('comments', ['comments' => $comments, 'profile_id' => $profile_id, 'user_id' => $user_id,
            'full_page' => '1', 'profile' => $profile->name]);

        //создать view, которая будет отвечать за вывод комментариев
        //при ajax запросе возвращать блок с комментариями
        //найти js метод вставки котнента в блок (inner html)
        //использовать dom selector для поиска блока
        //подготовить блок для вставки комментариев
        //вставлять в него комментарии
    }

    public function users_list()
    {
        $users = User::all();
        return view('users', ['users' => $users]);
    }

    public function get_profile_id($profile_id)
    {
        if($profile_id == NULL && Auth::user())
        {
            $profile_id = Auth::user()->id;
        }

        return $profile_id;
    }

    public function get_user_id()
    {
        $user_id = NULL;

        if(Auth::user())
        {
            $user_id = Auth::user()->id;  
        }

        return $user_id;
    }

    public function get_profile($profile_id)
    {
        $profile = User::find($profile_id);

        return $profile;
    }
}