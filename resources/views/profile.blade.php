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

                        @foreach($comments as $comment)
                            <br>
                            {{  $comment->user->name }} ) {{  $comment->text  }}
                            
                            @if($user_id == $profile_id || $user_id == $comment->user->id)
                                <form action="/profile/{{ $profile_id }}/del_comment" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="delComment"
                                            value="{{  $comment['id']  }}">Delete</button>
                                    </div>
                                </form>
                            @endif
                        @endforeach

                        @if($user_id)
                            <form action="/profile/{{ $profile_id }}/add_comment" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" class="form-control" id="input" placeholder="Your comment"
                                        name="commentText" required>
                                    <button type="submit" class="btn btn-primary" name="addComment">Add</button>
                                </div>
                            </form>
                        @endif

                        @if($full_page == NULL)
                            <button class="show_all_comments btn btn-primary">Show all</button>
                            
                            <script>
                                $(document).ready(function() {
                                    $('button.show_all_comments').on('click', function(){
                                        console.log('hello world');

                                        $.ajax({
                                            method: "GET",
                                            url: "/profile/show_full_profile",
                                            data: { button: "1" }
                                        })
                                        
                                        .done(function( msg ) {
                                            document.write(msg);
                                        });
                                    })

                                    
                                });
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
