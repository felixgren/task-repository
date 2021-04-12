<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

// Register account
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']); // inherits name
});

// Sign in, sign out
Route::get('/signin', [LoginController::class, 'index'])->name('login')->middleware(['guest']);
Route::post('/signin', [LoginController::class, 'store'])->middleware(['guest']);
Route::post('/signout', [LogoutController::class, 'store'])->name('logout')->middleware(['auth']);




Route::middleware(['auth'])->group(function () {
    // Index view, shows a list of all assignments in Desc order
    Route::get('/', [AssignmentController::class, 'index'])->name('dashboard');

    // WIP
    Route::get('/test', function (Request $request) {
        $user = $request->user();
        $user->givePermissionTo('delete assignments', 'edit assignments');
        // $user->removePersmissionTo('edit assignments', 'delete assignments', 'create assignments');

        // $user->givePermissionTo('create assignments', 'edit assignments');

        // dump($user->can('edit assignments'));
        // dump($user->hasRole('admin'));
        // dd($user->hasRole('student'));
    });

    // View account profile
    Route::get('/users/{user:username}', [UserProfileController::class, 'index'])->name('users.profile');

    // View account settings
    Route::get('/settings', [UserSettingController::class, 'index'])->name('settings');
    Route::put('/settings', [UserSettingController::class, 'update']);

    // Route for students/Teacher to view a specific assignment


    Route::get('/assignment/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignment/create', [AssignmentController::class, 'store'])->name('assignments.store');

    Route::get('/assignment/{assignment}', [AssignmentController::class, 'show'])->name('assignments.show');
    Route::put('/assignment/{assignment}', [AssignmentController::class, 'update'])->name("assignments.update");
    Route::delete('/assignment/{assignment}', [AssignmentController::class, 'destroy'])->name("assignments.destroy");

    Route::post('/assignment/{assignment}/add', [AssignmentController::class, 'addImages'])->name('assignments.addImages');
    Route::get('/assignment/{assignment}/edit', [AssignmentController::class, 'edit'])->name("assignments.edit");

    Route::get('/assignment/{assignment}/download/{fileName}', [AssignmentController::class, 'download'])->name("assignments.download");


    // Routes for teachers to create, update and delete assignments.
    //Route::post('/assignment/create', [AssignmentController::class, 'store']);
});
