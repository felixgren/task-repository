<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function deleteFile(Assignment $assignment, $fileName)
    {
        $deleted = Storage::delete("/{$assignment->id}/{$fileName}");

        return response()->json([
            'deleted' => $deleted,
        ]);
    }


    public function testRoute()
    {
        $users = User::orderBy('id', 'desc')->take(10)->get();

        $usersNameMap = $users->map(function ($user) {
            return $user["username"];
        });

        return $usersNameMap;
    }
}
