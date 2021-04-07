<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("/register", [RegisterController::class, "index"])->name('register');
Route::get("/signin", [LoginController::class, "index"])->name('login');;
Route::get("/signout", [LogoutController::class, "index"]);


// Index view, shows a list of all assignments in Desc order
Route::get('/', [AssignmentController::class], "index");

// Route for students/Teacher to view a specific assignment
Route::get("/assignment/{id}", [AssignmentController::class, "show"]);

// Routes for teachers to create, update and delete assignments.
Route::post("/assignment/create", [AssignmentController::class], "create");
Route::put("/assignment/{id}", [AssignmentController::class], "edit");
Route::delete("/assignment/{id}", [AssignmentController::class], "delete");
