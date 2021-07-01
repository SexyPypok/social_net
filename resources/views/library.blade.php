@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{  $profile->name  }}</div>

                    <div class="card-body">
                        @foreach($books as $book)
                            <br>
                            <div class="alert alert-secondary" role="alert">
                                <a href="{{  $book->user->id  }}/read/{{  $book->id  }}">{{  $book->name  }}</a>

                                @if($user_id == $profile->id)
                                    <a href="{{  $book->user->id  }}/delete/{{  $book->id  }}"
                                        class="btn btn-primary">Delete</a>

                                    @if($book->share_status)
                                        <a href="{{  $book->user->id  }}/hide_by_link/{{  $book->id  }}"
                                            class="btn btn-primary">Hide by link</a>
                                    @else
                                        <a href="{{  $book->user->id  }}/share_by_link/{{  $book->id  }}"
                                            class="btn btn-primary">Share by link</a>
                                    @endif
                                @endif
                            </div>
                        @endforeach

                        <br>
                        @if($user_id == $profile->id)
                            <a href="{{  $user_id  }}/add_book_form" class="btn btn-primary">Add book</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection