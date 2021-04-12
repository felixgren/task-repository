<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
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
        // $user = request()->user();
        // if ($user->can('edit assignments')) {

        // }
    }
}
