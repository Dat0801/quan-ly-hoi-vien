<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\TargetCustomerGroupController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\BusinessController;

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

    Route::prefix('category')->group(function () {
        //Industries
        Route::resource('industry', IndustryController::class);

        //Fields
        Route::resource('field', FieldController::class);

        //Markets
        Route::resource('market', MarketController::class);

        //Target Customer Groups
        Route::resource('target_customer_group', TargetCustomerGroupController::class);

        //Certificates
        Route::resource('certificates', CertificateController::class);

        //Organizations
        Route::resource('organizations', OrganizationController::class);

        //Businesses
        Route::resource('business', BusinessController::class);
    });
   
});

require __DIR__.'/auth.php';
