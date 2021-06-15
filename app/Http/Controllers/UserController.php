<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function show_profile($profile_id = NULL)
    {
        if($profile_id == NULL && Auth::user())
        {
            $profile_id = Auth::user()->id;
        }

        $user_id;

        if(Auth::user())
        {
            $user_id = Auth::user()->id;  
        }

        $user = User::all();
        $comments = $user->load(['comments' => function($q) use($profile_id) {$q->where('wall_owner_id', $profile_id)->orderBy('created_at', 'desc');}]);
        return view('profile', ['users' => $comments, 'profile_id' => $profile_id]);
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

        return redirect('/profile/'.$profile_id);
    }
}
