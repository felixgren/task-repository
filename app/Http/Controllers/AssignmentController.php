<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    // Moved over middleware to routes
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        return view("assignments.index");
    }

    // As god intended it to be
    public function create()
    {
        return view("assignments.create");
    }


    public function store(Request $request)
    {
        // Logik för att skapa en konkret assignment
        $user_id = Auth::user()->id;

        $assignment = Assignment::create([
            "user_id" => $user_id,
            "title" => request("title"),
            "description" => request("description"),
            "due_date" => request("due_date"),
        ]);

        return redirect("/assignments/{$assignment->id}");
    }


    public function show(Assignment $assignment)
    {
        return view("assignments.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
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
}
