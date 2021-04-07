@extends('layouts.app')

@section('content')
    hej assignment index <br>
    @auth
        you are authenticated
    @endauth

    @guest
        you are a guest
    @endguest
@endsection
