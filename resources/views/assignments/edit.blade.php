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

        @if (count($files) >0)
        <div class="my-4">
            <p class="font-bold mb-2">Resources</p>
            <div class="">
                <input type="file" id="file" name="file[]" multiple="multiple">
                @error("file")
                <p class="errorMsg">{{$message}}</p>
                @enderror
            </div>

            @foreach ($files as $file)
            <div class="my-2">
                <p><a class="underline" href="/assignment/{{$assignment->id}}/download/{{$file}}">{{ $file }}</a></p>

                <button data-id={{$file}} class="bg-red-500 h-6 w-6 rounded-full deleteFileBtn">X</button>
            </div>
            @endforeach
        </div>
        @endif

        <input class="bg-main hover:bg-blue-400 px-4 py-2 cursor-pointer" type="submit" value="Update Assignment">
    </form>


    <form class="deleteForm flex w-full mt-2 md:justify-end md:-mt-10" method="POST" action="/assignment/{{$assignment->id}}">
        @csrf
        @method("DELETE")
        <button class="deleteAssignmentBtn bg-red-500 hover:bg-red-600 px-4 py-2" type="submit">Delete Assignment</button>
    </form>


</main>

@endsection