<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');;
Route::resource('tickets', TicketController::class);
Route::resource('comments', CommentController::class);

Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');



// Route::get('/tickets/{ticket}/comments', function () {
//     Log::info('GET request made to comments route');
//     return response()->json(['message' => 'This route is not meant to be accessed directly.']);
// });
