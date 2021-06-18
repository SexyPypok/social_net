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
        $comment->reply_comment_id = $request->addComment;
        if($comment->text)
        {
            $comment->save();
        }
    }

    public function del_comment(Request $request, $profile_id)
    {
        $comment = Comment::find($request->delComment);
        if(($comment['author_comment_id'] == Auth::user()->id) || ($comment['wall_owner_id'] == Auth::user()->id))
        {
            $comment->delete();
        }

        return redirect('/profile/'.$profile_id);
    }

    public function answer_comment($profile_id, $comment_id)
    {
        $comment = Comment::find($comment_id);

        return view('answer', ['comment' => $comment, 'profile_id' => $profile_id]);
    }
}
//создать отдельную страницу для отображения всех записей
