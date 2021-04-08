@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div
            class="w-full text-center bg-white p-3 sm:p-6 sm:rounded-lg md:max-w-screen-md xl:max-w-screen-lg dark:text-white dark:bg-transparent dark:border-solid border border-white border-opacity-40">
            <div>
                <img class="border-2 border-gray-300 rounded-lg w-40 h-40 m-auto my-3 object-cover dark:border-transparent"
                    src="" alt="{{ $user->username }}s profile picture">
            </div>
            <p>profile details go here, anyone can view, if its your own button to goto settings.blade.php</p>
            <p>1: {{ $user->name }}<br></p>
            <p>2: {{ $user->username }}<br></p>
            <p>3: {{ $user->description }}<br></p>

            <p>test</p>
            @can('update', $user)
                <p> test </p>
            @endcan
        </div>
    </div>
@endsection
