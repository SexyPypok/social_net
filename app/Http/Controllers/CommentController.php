<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function add_comment(CommentRequest $request, $profile_id, Comment $comment)
    {
        $comment->wall_owner_id = $profile_id;
        $comment->author_comment_id = $this->get_user_id();
        $comment->text = $request->commentText;
        $comment->reply_comment_id = $request->addComment;

        if($comment->text)
        {
            $comment->save();
        }

        return redirect('/profile/'.$profile_id);
    }

    public function del_comment(Request $request, $profile_id)
    {
        $comment = Comment::where('id', '=', $request->delComment)->where('author_comment_id', '=', $this->get_user_id())
            ->orWhere('wall_owner_id', '=', $this->get_user_id())->where('id', '=', $request->delComment)->first();
        
        if($comment)
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
