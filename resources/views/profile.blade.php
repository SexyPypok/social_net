@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{  $profile  }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="comments">
                            @include('comments')
                        </div>
                        <div class="ajax-query-button">
                            <button class="show-all-comments btn btn-primary">Show all</button>
                        </div>
                        
                        <script>
                            $(document).ready(function() {
                                $('button.show-all-comments').on('click', function(){
                                    currentUrl = window.location.href;
                                    splittedUrl = currentUrl.split('/');
                                    profileId = splittedUrl[4];
                                    
                                    if(profileId == undefined)
                                    {
                                        profileUrl = "/show_full_profile";
                                    }
                                    
                                    else
                                    {
                                        profileUrl = "/show_full_profile/"+profileId;

                                    }

                                    $.ajax({
                                        method: "GET",
                                        url: profileUrl,
                                        success: function(data){
                                            button = document.querySelector('div.ajax-query-button');
                                            button.innerHTML = '';
                                            comments = document.querySelector('div.comments');
                                            comments.innerHTML = data;
                                        }
                                    })
                                })
                            });
                        </script>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
