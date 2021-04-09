<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        return view("assignments.index");
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

        return redirect("/assignment/{$assignment->id}");
    }


    public function show(Assignment $assignment)
    {
        return view("assignments.show", ["assignment" => $assignment]);
    }

    public function edit(Assignment $assignment)
    {
        return view("assignments.edit", ["assignment" => $assignment]);
    }

    public function update(Assignment $assignment)
    {
        $assignment->update($this->validateAssignment());
        return view("assignments.show", ["assignment" => $assignment]);
    }


    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        if ((int)$assignment->user_id !== Auth::user()->id) {
            return ("Nice try, you can only delete your own Posts");
        };
        $assignment->delete();
        return redirect("/");
    }

    public function validateAssignment()
    {
        return request()->validate([
            "title" => ["required", "min:3"],
            "due_date" => ["required", "date"],
            "description" => ["required", "min:3"],
        ]);
    }
}
