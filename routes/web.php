<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HomeworksController;
use App\Http\Controllers\TalksController;
use App\Http\Controllers\ResourcesController;
//use App\Http\Controllers\ProfileController;
//use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
//use Inertia\Inertia;

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

/* Page d'accueil */
/* ************** */
Route::get('/', [HomeController::class, 'show'])->name('home');

/* Profil */
/* ****** */
/*Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

/* Actualités, devoirs, discussions, ressources */
/* ******************************************** */
Route::get('/actualites', [NewsController::class, 'show_all'])->middleware(['auth', 'verified'])->name('news');
Route::get('/actualites/{post_id}', [NewsController::class, 'show_single'])->where('post_id', '[0-9]+')->middleware(['auth', 'verified']);
Route::get('/actualites/{post_id}/edit', [NewsController::class, 'edit_single'])->where('post_id', '[0-9]+')->middleware(['auth', 'verified']);
Route::post('/actualites/{post_id}/edit', [NewsController::class, 'update_single'])->where('post_id', '[0-9]+')->middleware(['auth', 'verified']);
Route::get('/actualites/create', [NewsController::class, 'create_single'])->middleware(['auth', 'verified']);
Route::post('/actualites/create', [NewsController::class, 'store_new_single'])->middleware(['auth', 'verified']);

Route::get('/devoirs', [HomeworksController::class, 'show_all'])->middleware(['auth', 'verified'])->name('homeworks');
Route::get('/devoirs/{post_id}', [HomeworksController::class, 'show_single'])->where('post_id', '[0-9]+')->middleware(['auth', 'verified']);
Route::get('/devoirs/{post_id}/edit', [HomeworksController::class, 'edit_single'])->where('post_id', '[0-9]+')->middleware(['auth', 'verified']);
Route::post('/devoirs/{post_id}/edit', [HomeworksController::class, 'update_single'])->where('post_id', '[0-9]+')->middleware(['auth', 'verified']);
Route::get('/devoirs/create', [HomeworksController::class, 'create_single'])->middleware(['auth', 'verified']);
Route::post('/devoirs/create', [HomeworksController::class, 'store_new_single'])->middleware(['auth', 'verified']);

Route::get('/discussions', [TalksController::class, 'show'])->middleware(['auth', 'verified'])->name('talks');


Route::get('/ressources', [ResourcesController::class, 'show_all'])->middleware(['auth', 'verified'])->name('resources');
Route::get('/ressources/{post_id}', [ResourcesController::class, 'show_single'])->where('post_id', '[0-9]+')->middleware(['auth', 'verified']);
Route::get('/ressources/{post_id}/edit', [ResourcesController::class, 'edit_single'])->where('post_id', '[0-9]+')->middleware(['auth', 'verified']);
Route::post('/ressources/{post_id}/edit', [ResourcesController::class, 'update_single'])->where('post_id', '[0-9]+')->middleware(['auth', 'verified']);
Route::get('/ressources/create', [ResourcesController::class, 'create_single'])->middleware(['auth', 'verified']);
Route::post('/ressources/create', [ResourcesController::class, 'store_new_single'])->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
