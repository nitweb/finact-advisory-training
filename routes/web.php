<?php

use App\Http\Controllers\Backend\AboutUsController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Blog\BlogCategoryController;
use App\Http\Controllers\Backend\Blog\BlogController;
use App\Http\Controllers\Backend\CareerController;
use App\Http\Controllers\Backend\CircularController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\EnlistmentController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\JobApplyController;
use App\Http\Controllers\Backend\OurContentsController;
use App\Http\Controllers\Backend\OurTeamController;
use App\Http\Controllers\Backend\PublicationsController;
use App\Http\Controllers\Backend\ServiceCategoryController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\ServiceSubCategoryController;
use App\Http\Controllers\Backend\Settings\SettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SuccessfulPortfoliosController;
use App\Http\Controllers\Backend\WhoWeAreController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ############################## Routes for frontend ##############################
Route::group(
    [
        'middleware' => ['web'],
    ],
    function () {
        // Home Route
        Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
        // Contact Message Store Route
        Route::post('/admin/contact/store', [ContactController::class, 'ContactStore'])->name('admin.contact.store');
        Route::post('/admin/job-application/store', [JobApplyController::class, 'JobApplyStore'])->name('admin.job_apply.store');

        Route::group(
            [
                'prefix' => '',
                'controller' => FrontendController::class,
                'as' => 'frontend.',
            ],
            function () {
                Route::get('/services', 'AllServiceList')->name('all.services.list');
                Route::get('/services/{slug}', 'ServiceDetails')->name('service.details');

                Route::get('/about-us', 'AboutUs')->name('about.us');

                Route::get('/important-enlistment', 'ImportantEnlistment')->name('important.enlistment');

                Route::get('/team', 'TeamList')->name('team.list');
                Route::get('/team/{slug}', 'TeamDetails')->name('team.details');

                Route::get('/client', 'Client')->name('client');

                Route::get('/gallery', 'Gallery')->name('gallery');
                Route::get('/gallery/{id}', 'GalleryDetails')->name('gallery.details');

                Route::get('/career', 'Career')->name('career');
                Route::get('/career-details/{slug}', 'CareerDetails')->name('career.details');
                Route::get('/career-details-apply/{id}', 'CareerDetailsApply')->name('career.details.apply');
                Route::get('/career-apply', 'CareerApply')->name('career.apply');

                Route::get('/publications', 'Publications')->name('publications');
                Route::get('/notice-circular', 'NoticeCircular')->name('notice.circular');

                Route::get('/contact-us', 'ContactUs')->name('contact.us');
                Route::get('/profile', 'showProfile')->name('show.profile');
                Route::get('/terms-conditions', 'TermsConditions')->name('terms.conditions');
                Route::get('/privacy-policy', 'PrivacyPolicy')->name('privacy.policy');
                // Route::get('/blog', 'BlogList')->name('blog.list');
                // Route::get('/blog/{slug}', 'BlogDetails')->name('blog.details');
                // Route::get('/who-we-are', 'WhoWeAre')->name('who.we.are');
            },
        );
    },
);

// ############################## Routes for admins ##############################
Route::group(
    [
        'prefix' => 'admin',
        'middleware' => ['auth', RoleMiddleware::class . ':admin'],
        'as' => 'admin.',
    ],
    function () {
        // Admin Dashboard
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'AdminDashboard')->name('dashboard');
            Route::get('/logout', 'AdminLogout')->name('logout');
            Route::get('/profile', 'AdminProfile')->name('profile');
            Route::post('/profile/update', 'AdminProfileUpdate')->name('profile.update');
            Route::post('/password/update', 'AdminPasswordUpdate')->name('password.update');
        });

        // Slider All Routes
        Route::group(
            [
                'prefix' => 'slider',
                'controller' => SliderController::class,
                'as' => 'slider.',
            ],
            function () {
                Route::get('/list', 'SliderList')->name('list');
                Route::get('/add', 'SliderAdd')->name('add');
                Route::post('/store', 'SliderStore')->name('store');
                Route::get('/edit/{id}', 'SliderEdit')->name('edit');
                Route::post('/update', 'SliderUpdate')->name('update');
                Route::get('/delete/{id}', 'SliderDelete')->name('delete');
            },
        );

        // Service Category All Routes
        Route::group(
            [
                'prefix' => 'service-category',
                'controller' => ServiceCategoryController::class,
                'as' => 'service-category.',
            ],
            function () {
                Route::get('/list', 'ServiceCategoryList')->name('list');
                Route::get('/add', 'ServiceCategoryAdd')->name('add');
                Route::post('/store', 'ServiceCategoryStore')->name('store');
                Route::get('/edit/{id}', 'ServiceCategoryEdit')->name('edit');
                Route::post('/update', 'ServiceCategoryUpdate')->name('update');
                Route::get('/delete/{id}', 'ServiceCategoryDelete')->name('delete');
            },
        );

        // Service Sub Category All Routes
        Route::group(
            [
                'prefix' => 'service-sub-category',
                'controller' => ServiceSubCategoryController::class,
                'as' => 'service-sub-category.',
            ],
            function () {
                Route::get('/list', 'ServiceSubCategoryList')->name('list');
                Route::get('/add', 'ServiceSubCategoryAdd')->name('add');
                Route::post('/store', 'ServiceSubCategoryStore')->name('store');
                Route::get('/edit/{id}', 'ServiceSubCategoryEdit')->name('edit');
                Route::post('/update', 'ServiceSubCategoryUpdate')->name('update');
                Route::get('/delete/{id}', 'ServiceSubCategoryDelete')->name('delete');
            },
        );

        // Service All Routes
        Route::group(
            [
                'prefix' => 'service',
                'controller' => ServiceController::class,
                'as' => 'service.',
            ],
            function () {
                Route::get('/list', 'ServiceList')->name('list');
                Route::get('/add', 'ServiceAdd')->name('add');
                Route::post('/store', 'ServiceStore')->name('store');
                Route::get('/edit/{id}', 'ServiceEdit')->name('edit');
                Route::post('/update', 'ServiceUpdate')->name('update');
                Route::get('/delete/{id}', 'ServiceDelete')->name('delete');
            },
        );

        // Setting All Routes
        Route::group(
            [
                'prefix' => 'setting',
                'controller' => SettingController::class,
                'as' => 'setting.',
            ],
            function () {
                Route::get('/font-awesome', 'FontAwesome')->name('font-awesome');
                Route::get('/search-icons', 'searchIcons')->name('search-icons');
                Route::get('/edit/{id}', 'SettingEdit')->name('edit');
                Route::post('/update', 'SettingUpdate')->name('update');
            },
        );

        // Contact Message All Routes
        Route::group(
            [
                'prefix' => 'contact',
                'controller' => ContactController::class,
                'as' => 'contact.',
            ],
            function () {
                Route::get('/list', 'ContactList')->name('list');
                Route::get('/delete/{id}', 'ContactDelete')->name('delete');
                Route::post('/contact/delete-selected', 'deleteSelected')->name('deleteSelected');
            },
        );

        // About Us All Routes
        Route::group(
            [
                'prefix' => 'about-us',
                'controller' => AboutUsController::class,
                'as' => 'about-us.',
            ],
            function () {
                Route::get('/list', 'AboutUsList')->name('list');
                Route::get('/edit/{id}', 'AboutUsEdit')->name('edit');
                Route::post('/update', 'AboutUsUpdate')->name('update');
            },
        );

        // Chairman Message All Routes
        Route::group(
            [
                'prefix' => 'about-message',
                'controller' => AboutUsController::class,
                'as' => 'about-message.',
            ],
            function () {
                Route::get('/list', 'AboutMessageList')->name('list');
                Route::get('/edit/{id}', 'AboutMessageEdit')->name('edit');
                Route::post('/update', 'AboutMessageUpdate')->name('update');
            },
        );

        // Our Team All Routes
        Route::group(
            [
                'prefix' => 'our-team',
                'controller' => OurTeamController::class,
                'as' => 'our-team.',
            ],
            function () {
                Route::get('/list', 'OurTeamList')->name('list');
                Route::get('/add', 'OurTeamAdd')->name('add');
                Route::post('/store', 'OurTeamStore')->name('store');
                Route::get('/edit/{id}', 'OurTeamEdit')->name('edit');
                Route::post('/update', 'OurTeamUpdate')->name('update');
                Route::get('/delete/{id}', 'OurTeamDelete')->name('delete');
            },
        );

        // Blog Category All Routes
        Route::group(
            [
                'prefix' => 'blog-category',
                'controller' => BlogCategoryController::class,
                'as' => 'blog-category.',
            ],
            function () {
                Route::get('/list', 'BlogCategoryList')->name('list');
                Route::get('/add', 'BlogCategoryAdd')->name('add');
                Route::post('/store', 'BlogCategoryStore')->name('store');
                Route::get('/edit/{id}', 'BlogCategoryEdit')->name('edit');
                Route::post('/update', 'BlogCategoryUpdate')->name('update');
                Route::get('/delete/{id}', 'BlogCategoryDelete')->name('delete');
            },
        );

        // Blog All Routes
        Route::group(
            [
                'prefix' => 'blog',
                'controller' => BlogController::class,
                'as' => 'blog.',
            ],
            function () {
                Route::get('/list', 'BlogList')->name('list');
                Route::get('/add', 'BlogAdd')->name('add');
                Route::post('/store', 'BlogStore')->name('store');
                Route::get('/edit/{id}', 'BlogEdit')->name('edit');
                Route::post('/update', 'BlogUpdate')->name('update');
                Route::get('/delete/{id}', 'BlogDelete')->name('delete');
            },
        );

        // Career All Routes
        Route::group(
            [
                'prefix' => 'career',
                'controller' => CareerController::class,
                'as' => 'career.',
            ],
            function () {
                Route::get('/list', 'CareerList')->name('list');
                Route::get('/add', 'CareerAdd')->name('add');
                Route::post('/store', 'CareerStore')->name('store');
                Route::get('/edit/{id}', 'CareerEdit')->name('edit');
                Route::post('/update', 'CareerUpdate')->name('update');
                Route::get('/delete/{id}', 'CareerDelete')->name('delete');
            },
        );

        // Job Apply All Routes
        Route::group(
            [
                'prefix' => 'job-apply',
                'controller' => JobApplyController::class,
                'as' => 'job_apply.',
            ],
            function () {
                Route::get('/list', 'JobApplyList')->name('list');
                Route::get('/delete/{id}', 'JobApplyDelete')->name('delete');
                Route::post('/job-apply/delete-selected', 'deleteSelected')->name('deleteSelected');
            },
        );

        // Who We Are All Routes
        Route::group(
            [
                'prefix' => 'who-we-are',
                'controller' => WhoWeAreController::class,
                'as' => 'who-we-are.',
            ],
            function () {
                Route::get('/list', 'WhoWeAreList')->name('list');
                Route::get('/edit/{id}', 'WhoWeAreEdit')->name('edit');
                Route::post('/update', 'WhoWeAreUpdate')->name('update');
            },
        );

        // Gallery All Routes
        Route::group(
            [
                'prefix' => 'gallery',
                'controller' => GalleryController::class,
                'as' => 'gallery.',
            ],
            function () {
                Route::get('/list', 'GalleryList')->name('list');
                Route::get('/add', 'GalleryAdd')->name('add');
                Route::post('/store', 'GalleryStore')->name('store');
                Route::get('/edit/{id}', 'GalleryEdit')->name('edit');
                Route::post('/update', 'GalleryUpdate')->name('update');
                Route::get('/delete/{id}', 'GalleryDelete')->name('delete');
            },
        );

        // Client All Routes
        Route::group(
            [
                'prefix' => 'client',
                'controller' => ClientController::class,
                'as' => 'client.',
            ],
            function () {
                Route::get('/list', 'ClientList')->name('list');
                Route::get('/add', 'ClientAdd')->name('add');
                Route::post('/store', 'ClientStore')->name('store');
                Route::get('/edit/{id}', 'ClientEdit')->name('edit');
                Route::post('/update', 'ClientUpdate')->name('update');
                Route::get('/delete/{id}', 'ClientDelete')->name('delete');
            },
        );

        // Important Enlistment All Routes
        Route::group(
            [
                'prefix' => 'enlistment',
                'controller' => EnlistmentController::class,
                'as' => 'enlistment.',
            ],
            function () {
                Route::get('/list', 'EnlistmentList')->name('list');
                Route::get('/edit/{id}', 'EnlistmentEdit')->name('edit');
                Route::post('/update', 'EnlistmentUpdate')->name('update');
            },
        );

        // Successful Portfolios All Routes
        Route::group(
            [
                'prefix' => 'successful_portfolios',
                'controller' => SuccessfulPortfoliosController::class,
                'as' => 'successful_portfolios.',
            ],
            function () {
                Route::get('/list', 'SuccessfulPortfoliosList')->name('list');
                Route::get('/edit/{id}', 'SuccessfulPortfoliosEdit')->name('edit');
                Route::post('/update', 'SuccessfulPortfoliosUpdate')->name('update');
            },
        );

        // Publications All Routes
        Route::group(
            [
                'prefix' => 'publications',
                'controller' => PublicationsController::class,
                'as' => 'publications.',
            ],
            function () {
                Route::get('/list', 'PublicationsList')->name('list');
                Route::get('/add', 'PublicationsAdd')->name('add');
                Route::post('/store', 'PublicationsStore')->name('store');
                Route::get('/edit/{id}', 'PublicationsEdit')->name('edit');
                Route::post('/update', 'PublicationsUpdate')->name('update');
                Route::get('/delete/{id}', 'PublicationsDelete')->name('delete');
            },
        );

        // Circular All Routes
        Route::group(
            [
                'prefix' => 'circular',
                'controller' => CircularController::class,
                'as' => 'circular.',
            ],
            function () {
                Route::get('/list', 'CircularList')->name('list');
                Route::get('/add', 'CircularAdd')->name('add');
                Route::post('/store', 'CircularStore')->name('store');
                Route::get('/edit/{id}', 'CircularEdit')->name('edit');
                Route::post('/update', 'CircularUpdate')->name('update');
                Route::get('/delete/{id}', 'CircularDelete')->name('delete');
            },
        );

        // Our Contents All Routes
        Route::group(
            [
                'prefix' => 'our-contents',
                'controller' => OurContentsController::class,
                'as' => 'our-contents.',
            ],
            function () {
                Route::get('/list', 'OurContentList')->name('list');
                Route::get('/edit/{id}', 'OurContentEdit')->name('edit');
                Route::post('/update', 'OurContentUpdate')->name('update');
            },
        );
    },
);

require __DIR__ . '/auth.php';

Route::get('admin/login', function () {
    if (Auth::check()) {
        return redirect('admin/dashboard');
    }
    return view('auth.login'); // Adjust the view name based on your setup
})->name('login');
