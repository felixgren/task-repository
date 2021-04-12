@extends('layouts.app')

@section('content')
<main class="main-assignment flex flex-col">

    <!-- Uppdatera att användas när man sätter privilleges -->
    <button class="w-40 self-end">
        <a href="/assignment/{{$assignment->id}}/edit">Edit Assignment</a>
    </button>

    <div class="flex flex-col mb-8">
        <h1 class="text-3xl font-bold">{{ $assignment->title }}</h1>
        <p class="text-gray-600">Due date: {{ $assignment->due_date }}</p>
    </div>

    <div>
        <h2 class="text-xl font-bold">Assignment description</h2>
        <p>{{ $assignment->description }}</p>
    </div>

    <div>
        <h3>Resources</h3>
        <a href="/assignment/{{$assignment->id}}/download">Download file</a>
    </div>
</main>
@endsection