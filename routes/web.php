<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MembershipFeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SponsorshipController;
use App\Http\Controllers\Club\ClubController;
use App\Http\Controllers\Club\ClubBoardCustomerController;
use App\Http\Controllers\Customer\BoardCustomerController;
use App\Http\Controllers\Customer\BusinessPartnerController;
use App\Http\Controllers\Customer\BusinessCustomerController;
use App\Http\Controllers\Customer\IndividualCustomerController;
use App\Http\Controllers\Customer\IndividualPartnerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\IndustryController;
use App\Http\Controllers\Category\FieldController;
use App\Http\Controllers\Category\MarketController;
use App\Http\Controllers\Category\TargetCustomerGroupController;
use App\Http\Controllers\Category\CertificateController;
use App\Http\Controllers\Category\OrganizationController;
use App\Http\Controllers\Category\BusinessController;

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

    Route::prefix('settings')->group(function () {

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
            Route::resource('certificate', CertificateController::class);
    
            //Organizations
            Route::resource('organization', OrganizationController::class);
    
            //Businesses
            Route::resource('business', BusinessController::class);
        });

        Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
        Route::get('/contact/edit', [ContactController::class, 'edit'])->name('contact.edit');
        Route::put('/contact/update', [ContactController::class, 'update'])->name('contact.update');

    });



    Route::prefix('customer')->group(function () {
        //Board Customers
        Route::resource('board_customer', BoardCustomerController::class);
        Route::get(
            '/board_customer/{customerId}/sponsorship-history',
            [BoardCustomerController::class, 'sponsorshipHistory']
        )->name('board_customer.sponsorship_history');


        Route::resource('business_customer', BusinessCustomerController::class);
        Route::get(
            '/business_customer/{customerId}/sponsorship-history',
            [BusinessCustomerController::class, 'sponsorshipHistory']
        )->name('business_customer.sponsorship_history');

        Route::resource('individual_customer', IndividualCustomerController::class);
        Route::get(
            '/individual_customer/{customerId}/sponsorship-history',
            [IndividualCustomerController::class, 'sponsorshipHistory']
        )->name('individual_customer.sponsorship_history');

        Route::resource('business_partner', BusinessPartnerController::class);
        Route::get(
            '/business_partner/{customerId}/sponsorship-history',
            [BusinessPartnerController::class, 'sponsorshipHistory']
        )->name('business_partner.sponsorship_history');

        Route::resource('individual_partner', IndividualPartnerController::class);
        Route::get(
            '/individual_partner/{customerId}/sponsorship-history',
            [IndividualPartnerController::class, 'sponsorshipHistory']
        )->name('individual_partner.sponsorship_history');

    });

    //Sponsorships
    Route::resource('sponsorships', SponsorshipController::class);

    Route::resource('membership_fee', MembershipFeeController::class);

    //Clubs
    Route::resource('club', ClubController::class);

    Route::resource('club.board_customer', ClubBoardCustomerController::class);

    Route::resource('activity', controller: ActivityController::class);
    Route::get('/activity/{id}/participants', [ActivityController::class, 'showParticipants'])->name('activity.participants');
    
   
});

require __DIR__ . '/auth.php';
