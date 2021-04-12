@extends('layouts.app') {{-- . same as /, just different notation --}}

@section('content')
<div class="flex justify-center">
    <div class="w-full bg-white p-3 sm:p-6 sm:rounded-lg md:max-w-screen-md xl:max-w-screen-lg dark:text-white dark:bg-transparent dark:border-solid border border-white border-opacity-40">
        <h2 class="text-lg text-center font-light"><b>Welcome to your settings {{ $user->name }}</b></h2>

        <div>
            <img class="border-2 border-gray-300 rounded-lg w-40 h-40 m-auto my-3 object-cover dark:border-transparent" src="" alt="Your profile.. sooner or later...">
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="my-4">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') ? old('name') : $user->name }}" class="bg-gray-100 border-solid border border-black border-opacity-40 w-full p-1 rounded-sm dark:bg-transparent dark:border-white @error('name') border-red-500 border-opacity-100  @enderror">

                @error('name')
                <div class="text-red-500 mt-1 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="my-4">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') ? old('username') : $user->username }}" class="bg-gray-100 border-solid border border-black border-opacity-40 w-full p-1 rounded-sm dark:bg-transparent dark:border-white @error('username') border-red-500 border-opacity-100  @enderror">

                @error('username')
                <div class="text-red-500 mt-1 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="my-4">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="{{ old('email') ? old('email') : $user->email }}" class="bg-gray-100 border-solid border border-black border-opacity-40 w-full p-1 rounded-sm dark:bg-transparent dark:border-white @error('email') border-red-500 border-opacity-100  @enderror">

                @error('email')
                <div class="text-red-500 mt-1 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="my-4">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="bg-gray-100 border-solid border border-black border-opacity-40 w-full p-1 rounded-sm dark:bg-transparent dark:border-white @error('description') border-red-500 border-opacity-100  @enderror">{{ old('description') ? old('description') : $user->description }}</textarea>

                @error('description')
                <div class="text-red-500 mt-1 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="my-4">
                <label for="image">Profile picture</label>
                <input type="file" name="image" id="image">
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white py-2 rounded-sm w-full">Update
                    settings</button>
            </div>

        </form>
    </div>
</div>
@endsection