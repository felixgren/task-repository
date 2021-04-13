@extends('layouts.app') {{-- . same as /, just different notation --}}

@section('content')
    <div class="flex justify-center">
        <div
            class="w-full bg-white p-3 sm:p-6 sm:rounded-lg md:max-w-screen-md xl:max-w-screen-lg dark:text-white dark:bg-transparent dark:border-solid border border-white border-opacity-40">
            <h2 class="text-lg text-center font-light"><b>Welcome to the Admin Panel, {{ $user->name }}</b></h2>
            <p class="text-md text-center font-light"><b>here we should be able to view all users, their roles and
                    permissions, anything else?</b></p>

            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

            </form>
        </div>
    </div>
@endsection
