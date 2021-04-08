@extends('layouts.app')

@section('content')
    <main>
        <div class="flex flex-col mb-8">
            <h1 class="text-3xl font-bold">{{ $assignment->title }}</h1>
            <p class="text-gray-600">Due date: {{ $assignment->due_date }}</p>
        </div>

        <div>
            <h2 class="text-xl font-bold">Assignment description</h2>
            <p>{{ $assignment->description }}</p>
        </div>
    </main>
@endsection
