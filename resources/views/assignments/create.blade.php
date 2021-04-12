@extends('layouts.app')

@section('content')
<main class="main-assignment">
    <form method="POST" action="/assignment/create" enctype="multipart/form-data">
        @csrf

        <div class=" flex pt-2 mb-2">
            <label class="mr-4" for="title">Title</label>
            <input class="w-full" type="text" name="title" id="title">
        </div>
        @error("title")
        <p class="errorMsg">{{$message}}</p>
        @enderror

        <div class="flex mb-2">
            <label class="mr-4 w-28" for="due_date">Due Date</label>
            <input class="w-full" type="date" name="due_date" id="due_date">
        </div>
        @error("due_date")
        <p class="errorMsg">{{$message}}</p>
        @enderror

        <div class="flex flex-col mb-2">
            <label class="mr-2" for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        @error("description")
        <p class="errorMsg">{{$message}}</p>
        @enderror

        <div class="mb-2">
            <input type="file" id="file" name="file[]" multiple="multiple">
            @error("file")
            <p class="errorMsg">{{$message}}</p>
            @enderror
        </div>

        <input class="bg-main hover:bg-blue-400 px-4 py-2" type="submit" value="Create Assignment">
    </form>
</main>
@endsection