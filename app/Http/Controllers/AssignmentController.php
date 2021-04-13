<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Hashids\Hashids;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = DB::table("assignments")->get()->sortBy("due_date");
        return view("assignments.index", ["assignments" => $assignments]);
    }

    // As god intended it to be
    public function create()
    {
        return view("assignments.create");
    }


    public function store()
    {
        $this->validateAssignment();

        // Logik för att skapa en konkret assignment
        $user_id = Auth::user()->id;

        $assignment = Assignment::create([
            "user_id" => $user_id,
            "title" => request("title"),
            "description" => request("description"),
            "due_date" => request("due_date"),
        ]);

        $this->saveFilesToDisk($assignment);

        return redirect("/assignment/{$assignment->id}");
    }


    public function show(Assignment $assignment)
    {
        // Gets the file from storage
        $files = $this->getAssociatedFiles($assignment);

        return view("assignments.show", ["assignment" => $assignment, "files" => $files]);
    }

    public function edit(Assignment $assignment)
    {
        // Gets the file from storage
        $files = $this->getAssociatedFiles($assignment);

        return view("assignments.edit", ["assignment" => $assignment,  "files" => $files]);
    }

    public function update(Assignment $assignment)
    {
        $assignment->update($this->validateAssignment());
        return $this->show($assignment);
    }


    public function addImages(Assignment $assignment)
    {
        // die(var_dump($assignment));
        $this->saveFilesToDisk($assignment);

        return redirect("/assignment/{$assignment->id}");
    }


    public function destroy(Assignment $assignment)
    {
        $assignment->delete();
        Storage::deleteDirectory("/{$assignment->id}");
        return redirect("/");
    }

    public function download(Assignment $assignment, $fileName)
    {
        return Storage::download("/{$assignment->id}/{$fileName}");
    }


    public function validateAssignment()
    {
        return request()->validate([
            "title" => ["required", "min:3"],
            "due_date" => ["required", "date"],
            "description" => ["required", "min:3"],
        ]);
    }

    public function getAssociatedFiles(Assignment $assignment)
    {
        // Gets the file from storage
        $files = Storage::files("/{$assignment->id}");
        return array_map(function ($file) {
            return explode("/", $file)[1];
        }, $files);
    }

    public function saveFilesToDisk(Assignment $assignment)
    {

        Storage::disk("local")->makeDirectory($assignment->id);

        foreach (request()->file("file") as $file) {
            $name = $file->getClientOriginalName();
            $name = preg_replace("(\s|\(|\))", "_", $name);
            $file->storeAs("/{$assignment->id}", $name);
        }
    }
}
