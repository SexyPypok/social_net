@section('comments')
    @foreach($comments as $comment)
        <br>
        <div class="alert alert-primary" role="alert">
            @if($comment->reply_comment_id)
                @if($comment->find($comment->reply_comment_id))
                    <div class="alert alert-secondary" role="alert">
                        {{  $comment->find($comment->reply_comment_id)->user->name  }} ) {{  $comment->
                            find($comment->reply_comment_id)->text  }}
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        Comment was deleted
                    </div>
                @endif
            @endif

            {{  $comment->user->name  }} ) {{  $comment->text  }}
            
            @if($user_id == $profile_id || $user_id == $comment->user->id)
                <form action="/profile/{{ $profile_id }}/del_comment" method="POST">
                    {{  csrf_field()  }}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="delComment"
                            value="{{  $comment['id']  }}">Delete</button>
                    </div>
                </form>
            @endif

            @if($user_id)
                <form action="/profile/{{  $profile_id  }}/answer/{{  $comment->id  }}" method="POST">
                    {{  csrf_field()  }}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="delComment"
                            value="{{  $comment['id']  }}">Answer</button>
                    </div>
                </form>
            @endif
        </div>
    @endforeach
@show

