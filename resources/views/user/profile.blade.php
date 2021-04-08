@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div
            class="w-full text-center bg-white p-3 sm:p-6 sm:rounded-lg md:max-w-screen-md xl:max-w-screen-lg dark:text-white dark:bg-transparent dark:border-solid border border-white border-opacity-40">
            <div>
                <img class="border-2 border-gray-300 rounded-lg w-40 h-40 m-auto my-3 object-cover dark:border-transparent"
                    src="" alt="{{ $user->username }}s profile picture">
            </div>
            <b>Profile Page. Anyone can view. If its your own page a button to goto settings is shown.</b>
            <p>1: {{ $user->name }}<br></p>
            <p>2: {{ $user->username }}<br></p>
            <p>3: {{ $user->email }}<br></p>
            <p>4: {{ $user->description }}<br></p>

            @if (Auth::user()->is($user))
                <form action="/settings/">
                    <div>
                        <button type="submit" value="Go to settings"
                            class="bg-blue-500 text-white py-2 rounded-sm px-4">Change
                            settings</button>
                    </div>
                </form>
            @endif

            @if (session('status'))
                <div class="text-red-500 my text-lg">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
@endsection
