@extends('layouts.app')

@section('content')
    <main class="px-4">
        <form method="POST" action="/assignment/create">
            @csrf
            <div class="flex">
                <label class="mr-2" for="title">Assignment title</label>
                <input type="text" name="title" id="title">
            </div>

            <div class="flex">
                <label class="mr-2" for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date">
            </div>
            <div class="flex flex-col">
                <label class="mr-2" for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
            </div>
            <input class="bg-main hover:bg-blue-400 px-4 " type="submit" value="Create Assignment">
        </form>
    </main>
@endsection
