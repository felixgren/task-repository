@extends('layouts.app')

@section('content')
    <p>Hi!! im the view SHOW</p>
    <main>
        <form action="POST" method="post">
            @csrf

            <div><label for="title">Assignment title</label><input type="text" name="title" id="title"></div>
            <div><label for="due_date">Due Date</label><input type="date" name="due_date" id="due_date"></div>
        </form>
    </main>
@endsection
