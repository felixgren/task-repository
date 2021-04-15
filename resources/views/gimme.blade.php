@extends('layouts.app') {{-- . same as /, just different notation --}}

@section('content')
    <div class="flex justify-center">
        <div
            class="w-full bg-white p-3 sm:p-6 sm:rounded-lg md:max-w-screen-md xl:max-w-screen-lg dark:text-white dark:bg-transparent dark:border-solid border border-white border-opacity-40">
            <h2 class="text-lg text-center font-light"><b>Welcome to the Gimme Panel, {{ $user->name }}</b></h2>
            <p class="text-md text-center font-light"><b>ye ye ye</b></p>

            <div>
                <img class="border-2 border-gray-300 rounded-lg w-full h-90 m-auto my-3 object-cover dark:border-transparent"
                    src="https://media.giphy.com/media/3knKct3fGqxhK/giphy.gif" alt="hackerman">
            </div>


            @if (session()->has('status'))
                <h2 class="text-center font-bold text-green-500">
                    {{ session('status') }}
                </h2>
            @else
                <h2 class="text-center font-bold text-red-500">Waiting on your command...</h2>
            @endif

            <section class="grid gap-6 font-bold">
                <div class="border-gray-300 border-2 rounded-md p-4 md:px-8 md:pb-6 flex flex-col">
                    <div class="flex justify-between items-center flex-wrap">
                        <p class="text-lg text-blue-900 mb-1">{{ $user->name }}</p>
                    </div>
                    <div style="height: 1px;" class="separator w-full bg-gray-300 rounded-md mb-2"></div>
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

            </section>

            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="my-2">
                    <h3 class="font-bold text-blue-500">Give me permission to...</h3>
                    <button type="text" name="give" id="give" value="create assignments"
                        class="bg-blue-500 text-white py-2 rounded-sm w-full">create assignments</button>
                </div>

                <div class="my-2">
                    <button type="text" name="give" id="give" value="edit assignments"
                        class="bg-blue-500 text-white py-2 rounded-sm w-full">edit assignments</button>
                </div>

                <div class="my-2">
                    <button type="text" name="give" id="give" value="delete assignments"
                        class="bg-blue-500 text-white py-2 rounded-sm w-full">delete assignments</button>
                </div>

                <div class="my-2">
                    <h3 class="font-bold text-blue-500">Remove my permission to...</h3>
                    <button type="text" name="remove" id="remove" value="create assignments"
                        class="bg-blue-700 text-white py-2 rounded-sm w-full"> remove create assignments</button>
                </div>
                <div class="my-2">
                    <button type="text" name="remove" id="remove" value="edit assignments"
                        class="bg-blue-700 text-white py-2 rounded-sm w-full"> remove edit assignments</button>
                </div>
                <div class="my-2">
                    <button type="text" name="remove" id="remove" value="delete assignments"
                        class="bg-blue-700 text-white py-2 rounded-sm w-full"> remove delete assignments</button>
                </div>

            </form>

            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="">
                    <label for="role" class="font-bold text-blue-500">Change my role...</label>
                    <input name="role" id="role" placeholder="Add role!"
                        class="bg-gray-300 font-bold font-xl border-solid border border-black border-opacity-40 w-full p-1 rounded-sm">
                    </>
                </div>
                <div class="mb-2">
                    <input name="removeRole" id="removeRole" placeholder="remove role..."
                        class="bg-gray-300 font-bold font-xl border-solid border border-black border-opacity-40 w-full p-1 rounded-sm">
                    </>
                </div>
                <div>
                    <button type="submit" class="bg-yellow-500 text-white py-2 rounded-sm w-full">Update
                        roles</button>
                </div>
            </form>
        </div>
    </div>
@endsection
