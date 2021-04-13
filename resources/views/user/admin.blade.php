@extends('layouts.app') {{-- . same as /, just different notation --}}

@section('content')
    <div class="flex justify-center">
        <div
            class="w-full bg-white p-3 sm:p-6 sm:rounded-lg md:max-w-screen-md xl:max-w-screen-lg dark:text-white dark:bg-transparent dark:border-solid border border-white border-opacity-40">
            <h2 class="text-lg text-center font-light"><b>Welcome to the Admin Panel, {{ $adminUser->name }}</b></h2>
            <p class="text-md text-center font-light"><b>here we should be able to view all users, their roles and
                    permissions, anything else?</b></p>

            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

            </form>

            <section class="grid gap-6">
                @foreach ($users as $user)
                    <div class="border-gray-300 border-2 rounded-md p-4 md:px-8 md:pb-6 flex flex-col">
                        <div class="flex justify-between items-center flex-wrap">
                            <p class="text-lg text-blue-900 mb-1">{{ $user->name }}</p>
                        </div>
                        <div style="height: 1px;" class="separator w-full bg-gray-300 rounded-md mb-2"></div>
                        <p class="text-blue-900 mb-1">Account created: {{ $user->created_at }}</p>
                        <p class="text-blue-900 mb-1">Account description:
                            @if ($user->description)
                                {{ mb_strimwidth($user->description, 0, 30, '...') }}
                            @else
                                None
                            @endif
                        </p>
                        <p class="text-blue-900 mb-1">Roles:
                            {{ $roles = $user->roles->map(function ($role) {
                                return $role['role_name'];
                            }) }}
                        </p>
                        <p class="text-blue-900 mb-1">Permissions:
                            {{ $permissions = $user->permissions->map(function ($permission) {
                                return $permission['permission_name'];
                            }) }}
                        </p>
                        <p class="text-blue-900 mb-1">Assignments: {{ $user->assignments->count() }}</p>

                        @foreach ($user->assignments as $assignment)
                            <a href="somelinklol" class="text-blue-900 mb-1 text-sm">
                                {{ $assignment->id }}: {{ mb_strimwidth($assignment->title, 0, 50, '...') }}</a>
                        @endforeach

                        <div class="flex-1 flex justify-end items-end">
                            <button class="w-40 bg-yellow-300 rounded-md px-2 py-1 mt-3 hover:bg-yellow-400">
                                <a href="/users/{{ $user->username }}">Show profile</a>
                            </button>
                        </div>
                    </div>

                @endforeach
            </section>
        </div>
    </div>
@endsection
