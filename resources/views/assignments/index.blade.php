@extends('layouts.app')

@section('content')
    <main class="p-4 max-w-7xl mx-auto md:mt-2">
        <h1 class="text-3xl font-bold mb-2 md:mb-4">Assignments</h1>
        @role('admin')
        <h2>Admin</h2>
        @elserole('teacher')
        <h2>teacher</h2>
        @elserole('student')
        <h2>Student</h2>
        <h2>common trash</h2>
        @endrole
        <section class="grid md:grid-cols-2 gap-6">
            @foreach ($assignments as $assignment)
                <div class="border-gray-300 border-2 rounded-md p-4 md:px-8 md:pb-6 flex flex-col">
                    <div class="flex justify-between items-center">
                        <p class="text-lg text-blue-900 mb-1">{{ $assignment->title }}</p>
                        <p class="text-blue-900 mb-1 opacity-40">{{ $assignment->due_date }}</p>
                    </div>
                    <div style="height: 1px;" class="separator w-full bg-gray-300 rounded-md mb-2"></div>
                    <p>{{ mb_strimwidth($assignment->description, 0, 255, '...') }}</p>
                    <div class="flex-1 flex justify-end items-end">
                        <button class="w-40 bg-yellow-300 rounded-md px-2 py-1 mt-3 hover:bg-yellow-400">
                            <a href="/assignment/{{ $assignment->id }}">Show assignment</a>
                        </button>
                    </div>
                </div>

            @endforeach
        </section>

    </main>
@endsection
