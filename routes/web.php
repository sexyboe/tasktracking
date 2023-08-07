<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TasksController;

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

Route::get('/', function () {
    return view('welcome');
});




// backend//
// Route::post('/createProject', 'ProjectController@create');



// Show the login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Handle the login form submission
Route::post('/login', [LoginController::class, 'login']);

// Show the registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Handle the registration form submission
Route::post('/register', [RegisterController::class, 'register']);




Route::middleware('custom_auth')->group(function () {
    // Add your protected routes here
    Route::get('/ok', [frontendController::class, 'ok'])->name('ok');
    Route::get('/dashboard', [frontendController::class, 'index'])->name('dashboard');
    Route::get('/projects', [frontendController::class, 'showProject'])->name('projects');
    Route::get('/tasks', [frontendController::class, 'showTask'])->name('tasks');
    Route::get('/profile', [frontendController::class, 'profilepage'])->name('profile');



    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/createProject', [ProjectController::class, 'create'])->name('createProject');
    Route::post('/createTask1', [ProjectController::class, 'createTask1'])->name('createTask1');
    Route::post('/createTask', [ProjectController::class, 'createTask'])->name('createTask');
    Route::get('/vprojects/{project_id}', [ProjectController::class, 'viewProject'])->name('vprojects');
    Route::get('/editprojects/{id}', [ProjectController::class, 'editProject'])->name('editprojects');
    Route::put('/updateProjects/{id}', [ProjectController::class, 'updateProjects'])->name('updateProjects');

    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('deleteprojects');
});


// Add your protected routes here
