<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
}
