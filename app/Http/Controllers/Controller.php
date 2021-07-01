<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get_comm()
    {
        $model = new User;
        $users = $model->all();
        foreach($users as $user)
        {
            print_r($user['name']);
            $comments = $user->comments()->get();

            foreach($comments as $comment)
            {
                print_r($comment['text']);
            }
        }
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
}
