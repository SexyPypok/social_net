<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function show_profile($profile_id)
    {
        $user_id;

        if(Auth::user())
        {
            $user_id = Auth::user()->id;  
        }

        $comments = User::find($profile_id)->comments;
        $users = User::all();
        return view('profile', ['comments' => $comments, 'profile_id' => $profile_id, 'user_id' => $user_id,
            'users' => $users]);
    }

    public function add_comment(Request $request, $profile_id)
    {
        $user_id = Auth::user()->id;  
        $comment = new Comments;
        $comment->wall_owner_id = $profile_id;
        $comment->author_comment_id = $user_id;
        $comment->text = $request->commentText;
        if($comment->text)
        {
            $comment->save();
        }
        
        return $this->show_profile($profile_id);
    }

    public function users_list()
    {
        $users = User::all();
        return view('users', ['users' => $users]);
    }

    public function del_comment(Request $request, $profile_id)
    {
        $comment = Comments::where('author_comment_id', Auth::user()->id)->orWhere('wall_owner_id', Auth::user()->id)
            ->find($request->delComment);
        $comment->delete();

        return $this->show_profile($profile_id);
    }

    public function home_page()
    {
        $user_id = Auth::user()->id;  
        return $this->show_profile($user_id);
    }
}
