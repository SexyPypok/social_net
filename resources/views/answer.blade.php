@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card-body">
                        <h3>{{  $comment->user->name  }} ) {{  $comment->text  }}</h3>
                        <form method="POST" action="/profile/{{  $profile_id  }}/add_comment">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control" id="input" placeholder="Your answer"
                                    name="commentText" required>
                                <button type="submit" class="btn btn-primary" name="addComment" value="{{  $comment->id  }}">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection