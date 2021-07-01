@extends('layouts.app')

@section('content')
    

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add book</div>

                    <div class="card-body">
                        <form action="add_book" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control" id="input" placeholder="Name of your book"
                                    name="bookName" required>
                                    <textarea class="form-control" id="input" placeholder="Text of your book"
                                    name="bookText" required></textarea>
                                <button type="submit" class="btn btn-primary" name="addBook">Add</button>
                            </div>
                        </form> 

                        <a href="../" class="btn btn-primary">Exit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection