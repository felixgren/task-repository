@extends('layouts.app')

@section('content')
hi, this is assignment index/dashboard. <br>
@auth
you are authenticated. <br>
<div class="bg-blue-300">
    NAME: {{ auth()->user()->name }} <br>
    USERNAME: {{ auth()->user()->username }} <br>
    EMAIL: {{ auth()->user()->email }} <br>
</div>
@endauth
@endsection