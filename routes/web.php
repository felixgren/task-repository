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
Route::post('/register', [RegisterController::class, 'store']);


Route::get("/signin", [LoginController::class, "index"])->name('login');
Route::post('/signin', [LoginController::class, "store"]); // inherits name

Route::post("/signout", [LogoutController::class, "store"])->name('logout');


// Index view, shows a list of all assignments in Desc order
Route::get('/', [AssignmentController::class, "index"])->name('dashboard');

// Route for students/Teacher to view a specific assignment
Route::get("/assignment/create", [AssignmentController::class, "create"])->name("assignments.create");
Route::post("/assignment/create", [AssignmentController::class, "store"])->name("assignments.store");

Route::get("/assignment/{id}", [AssignmentController::class, "show"])->name("assignments.show");

// Routes for teachers to create, update and delete assignments.
//Route::post("/assignment/create", [AssignmentController::class, "store"]);

Route::put("/assignment/{id}", [AssignmentController::class, "edit"]);
Route::delete("/assignment/{id}", [AssignmentController::class, "delete"]);
