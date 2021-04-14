@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-full text-center bg-white p-3 sm:p-6 sm:rounded-lg md:max-w-screen-md xl:max-w-screen-lg dark:text-white dark:bg-transparent dark:border-solid border border-white border-opacity-40">
        <div class="flex flex-col relative">
            <img class="border-2 border-gray-300 rounded-lg w-40 h-40 m-auto my-3 object-cover dark:border-transparent self-center" src="{{ asset($user->profile_photo_path) }}" alt="{{ $user->username }}s profile picture">
            <div class="md:absolute md:right-0 md:top-0">
                @if (Auth::user()->is($user))
                <form class="mb-4" action="/settings/">
                    <div>
                        <button type="submit" value="Go to settings" class="bg-blue-500 text-white py-2 rounded-sm px-4">Change
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
        <section class="flex flex-col mb-2">
            <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
            <p class="text-gray-600 opacity-90 text-lg"><?= '@' ?>{{ $user->username }}</p>
            @if('teacher')
            <p class="text-sm text-gray-600 opacity-90 mb-4">{{ $user->email }}</p>
            @endif
        </section>
        <p>{{ $user->description }}</p>

    </div>
</div>
@endsection