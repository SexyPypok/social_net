@extends('layouts.app')

@section('content')
    @foreach($users as $user)
        <a href={{  $user['id']  }}>{{  $user['name']  }}</a>
    @endforeach
@endsection