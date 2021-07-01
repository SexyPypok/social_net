@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card-body">
                        <h3>{{  $book->name  }}</h3>
                        {{  $book->description  }}
                    </div>
                    <!-- <form>
                        <input type="text" name="edited_book_text" placeholder="">
                        <textarea></textarea>
                        <button></button>
                    </form> -->
                    @if($book->user->id == $user_id)
                        <a href="../edit/{{  $book->id  }}" class="btn btn-primary">Edit book</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection