@extends('layouts.app')

@section('content')
    hi, this is assignment index/dashboard. <br>
    @auth
        you are authenticated. <br>
        name {{ auth()->user()->name }} <br>
        username {{ auth()->user()->username }} <br>
    @endauth

    @guest
        you are a guest
    @endguest
@endsection
