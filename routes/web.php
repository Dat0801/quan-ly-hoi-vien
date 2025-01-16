<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Club\ClubBusinessCustomerController;
use App\Http\Controllers\Club\ClubBusinessPartnerController;
use App\Http\Controllers\Club\ClubIndividualCustomerController;
use App\Http\Controllers\Club\ClubIndividualPartnerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MembershipFeeController;
use App\Http\Controllers\MembershipTierController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\RoleController;
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

use App\Models\Notification;
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

        Route::prefix('user')->group(function () {
            Route::resource('role', RoleController::class);

            Route::resource('account', AccountController::class);
        });

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

        Route::resource('membership_tier', MembershipTierController::class);

    });

    Route::prefix('customer')->group(function () {
        //Board Customers
        Route::resource('board_customer', BoardCustomerController::class);
        Route::get(
            '/board_customer/{customerId}/sponsorship-history',
            [BoardCustomerController::class, 'sponsorshipHistory']
        )->name('board_customer.sponsorship_history');
        Route::get(
            '/board_customer/{customerId}/membership-fee-history',
            [BoardCustomerController::class, 'membershipFeeHistory']
        )->name('board_customer.membership-fee-history');


        Route::resource('business_customer', BusinessCustomerController::class);
        Route::get(
            '/business_customer/{customerId}/sponsorship-history',
            [BusinessCustomerController::class, 'sponsorshipHistory']
        )->name('business_customer.sponsorship_history');
        Route::get(
            '/business_customer/{customerId}/membership-fee-history',
            [BusinessCustomerController::class, 'membershipFeeHistory']
        )->name('business_customer.membership-fee-history');

        Route::resource('individual_customer', IndividualCustomerController::class);
        Route::get(
            '/individual_customer/{customerId}/sponsorship-history',
            [IndividualCustomerController::class, 'sponsorshipHistory']
        )->name('individual_customer.sponsorship_history');
        Route::get(
            '/individual_customer/{customerId}/membership-fee-history',
            [IndividualCustomerController::class, 'membershipFeeHistory']
        )->name('individual_customer.membership-fee-history');

        Route::resource('business_partner', BusinessPartnerController::class);
        Route::get(
            '/business_partner/{customerId}/sponsorship-history',
            [BusinessPartnerController::class, 'sponsorshipHistory']
        )->name('business_partner.sponsorship_history');
        Route::get(
            '/business_partner/{customerId}/membership-fee-history',
            [BusinessPartnerController::class, 'membershipFeeHistory']
        )->name('business_partner.membership-fee-history');

        Route::resource('individual_partner', IndividualPartnerController::class);
        Route::get(
            '/individual_partner/{customerId}/sponsorship-history',
            [IndividualPartnerController::class, 'sponsorshipHistory']
        )->name('individual_partner.sponsorship_history');
        Route::get(
            '/individual_partner/{customerId}/membership-fee-history',
            [IndividualPartnerController::class, 'membershipFeeHistory']
        )->name('individual_partner.membership-fee-history');

    });

    //Sponsorships
    Route::resource('sponsorship', SponsorshipController::class);

    Route::resource('membership_fee', MembershipFeeController::class);
    Route::get('/api/get-customer-debts/{customerId}', [MembershipFeeController::class, 'getCustomerDebts']);

    //Clubs
    Route::resource('club', ClubController::class);
    Route::post('/clubs/import', [ClubController::class, 'import'])->name('club.import');
    Route::get('/clubs/export', [ClubController::class, 'export'])->name('club.export');
    Route::resource('club.board_customer', ClubBoardCustomerController::class);
    Route::resource('club.business_customer', ClubBusinessCustomerController::class);
    Route::resource('club.individual_customer', ClubIndividualCustomerController::class);
    Route::resource('club.business_partner', ClubBusinessPartnerController::class);
    Route::resource('club.individual_partner', ClubIndividualPartnerController::class);

    //Activities
    Route::resource('activity', controller: ActivityController::class);
    Route::get('/activity/{id}/participants', [ActivityController::class, 'showParticipants'])->name('activity.participants');

    //Meetings
    Route::resource('meeting', controller: MeetingController::class);

    //Notifications
    Route::resource('notification', NotificationController::class);

});

require __DIR__ . '/auth.php';
