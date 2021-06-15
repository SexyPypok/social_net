@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($users as $user)
                        @foreach($user['comments'] as $comment)
                            <br>
                            {{ $user['name']}} ) {{  $comment['text'] }}
                            
                            @if($user['id'] == $user_id || $user_id == $profile_id)
                            <form action="/profile/{{ $profile_id }}/del_comment" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="delComment" value="{{  $comment['id']  }}">Delete</button>
                                </div>
                            </form>
                            @endif
                        @endforeach
                    @endforeach

                    @if(Auth::user())
                        <form action="/profile/{{ $profile_id }}/add_comment" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control" id="input" placeholder="Your comment" name="commentText" required>
                                <button type="submit" class="btn btn-primary" name="addComment">Add</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
