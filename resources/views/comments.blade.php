@section('comments')
    @foreach($comments as $comment)
        <br>
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
    @endforeach
@show

