<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function add_comment(Request $request, $profile_id)
    {
        $user_id = Auth::user()->id;  
        $comment = new Comment;
        $comment->wall_owner_id = $profile_id;
        $comment->author_comment_id = $user_id;
        $comment->text = $request->commentText;
        if($comment->text)
        {
            $comment->save();
        }
        
        return redirect('/profile/'.$profile_id);
    }

    public function del_comment(Request $request, $profile_id)
    {
        $comment = Comment::where('author_comment_id', Auth::user()->id)->orWhere('wall_owner_id', Auth::user()->id)
            ->find($request->delComment);
        $comment->delete();

        return redirect('/profile/'.$profile_id);
    }
}
//создать отдельную страницу для отображения всех записей
