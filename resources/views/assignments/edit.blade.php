@extends('layouts.app')
@section('content')
<main class="main-assignment">
    <form method="POST" action="/assignment/{{$assignment->id}}">
        @csrf
        @method("PUT")

        <div class="flex pt-2 mb-2">
            <label class="mr-4 font-bold" for="title">Title</label>
            <input class="w-full" type="text" name="title" id="title" value="{{$assignment->title}}">
        </div>
        @error("title")
        <p class="errorMsg">{{$message}}</p>
        @enderror


        <div class="flex mb-2">
            <label class="mr-4 w-28 font-bold" for="due_date">Due Date</label>
            <input class="w-full" type="date" name="due_date" id="due_date" value="{{$assignment->due_date}}">
        </div>
        @error("due_date")
        <p class="errorMsg">{{$message}}</p>
        @enderror

        <div class="flex flex-col mb-2">
            <label class="mr-2 font-bold" for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10">{{$assignment->description}}</textarea>
        </div>
        @error("description")
        <p class="errorMsg">{{$message}}</p>
        @enderror

        <input class="bg-main hover:bg-blue-400 px-4 py-2" type="submit" value="Update Assignment">
    </form>

    <form class="deleteForm" method="POST" action="/assignment/{{$assignment->id}}">
        @csrf
        @method("DELETE")
        <button class="deleteAssignmentBtn bg-red-500 hover:bg-red-600 px-4 py-2" type="submit">Delete Assignment</button>
    </form>


</main>

@endsection