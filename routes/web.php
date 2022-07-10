<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StackController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Inertia\Inertia;

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

// Auth

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');


// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');

// Quiz

Route::get('quiz', [QuizController::class, 'index'])
    ->name('quiz');

Route::get('subject/{subject}/edit', [SubjectController::class, 'edit'])
    ->name('subject.edit')
    ->middleware('auth');

Route::get('stack/{stack}', [StackController::class, 'show'])
    ->name('stsack.show')
    ->middleware('auth');

Route::get('stack/{stack}/edit', [StackController::class, 'edit'])
    ->name('stack.edit')
    ->middleware('auth');

Route::get('question/{question}/edit', [QuestionController::class, 'edit'])
    ->name('question.edit')
    ->middleware('auth');

Route::post('question/{question}/choice/add', function(App\Models\Question $question){
    $question->choices()->create([
        'choice' => '',
        'correct' => false
    ]);
    
    $question->save();

    return Redirect::back()->with('success', 'Choice was added.');

    // return response()->json($question->load('choices'));
})
    ->name('question.choice.add')
    ->middleware('auth');

Route::put('question/{question}', [QuestionController::class, 'update'])
    ->name('question.update')
    ->middleware('auth');

Route::get('/question/search', function (Request $request) {
        $search = App\Models\Question::search($request->search)->get();
        $search->load('stack');
        return $search;
    });

Route::get('images/', [ImagesController::class, 'index'])
    ->name('images.index')
    ->middleware('auth');