<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FieldController;
use Illuminate\Support\Facades\Route;

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
    return view('/auth/login');
});


Route::get('/dashboard', [DocumentController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    //Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Documents
    Route::post('documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::delete('documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    Route::get('documents/download/{id}', [DocumentController::class, 'download'])->name('documents.download');

    //Categories
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/industries', [CategoryController::class, 'loadIndustries'])->name('category.industries');
    Route::get('/category/fields', [CategoryController::class, 'loadFields'])->name('category.fields');

    //Industries
    Route::get('/industry/create', [IndustryController::class, 'create'])->name('industry.create'); 
    Route::post('/industry', [IndustryController::class, 'store'])->name('industry.store');
    Route::get('/industry/{id}', [IndustryController::class, 'show'])->name('industry.show');
    Route::get('/industry/{id}/edit', [IndustryController::class, 'edit'])->name('industry.edit'); 
    Route::put('/industry/{id}', [IndustryController::class, 'update'])->name('industry.update');
    Route::delete('/industry/{industry}', [IndustryController::class, 'destroy'])->name('industry.destroy');

    //Fields
    Route::get('field/create', [FieldController::class, 'create'])->name('field.create');
    Route::post('field', [FieldController::class, 'store'])->name('field.store');
    Route::get('fields', [FieldController::class, 'index'])->name('field.index');
    Route::delete('/fields/{field}', [FieldController::class, 'destroy'])->name('field.destroy');
    Route::delete('field/sub-groups/{id}', [FieldController::class, 'destroySubGroup'])->name('field.destroySubGroup');
    
});

require __DIR__.'/auth.php';
