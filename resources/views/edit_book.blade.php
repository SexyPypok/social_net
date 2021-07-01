@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card-body">
                        <form method="POST" action="../save_book/{{  $book->id  }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control" id="input" placeholder="Name of your book"
                                    name="bookName" value="{{  $book->name  }}" required>
                                <textarea name="bookText" required class="form-control" placeholder="Text of your book">{{  $book->description  }}</textarea>
                                <button type="submit" class="btn btn-primary" name="addComment">Edit</button>
                            </div>
                        </form>
                        <a href="../../{{  $book->user->id  }}/read/{{  $book->id  }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection