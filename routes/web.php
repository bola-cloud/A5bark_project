<?php

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
    return view('front.home');
})->name('front_home');
Route::get('/front/event', function () {
    return view('front.event');
})->name('event');
Route::get('/concert', function () {
    return view('front.concert');
})->name('concert');
Route::get('/branch', function () {
    return view('front.branch');
})->name('branch');
Route::get('/adverticement', function () {
    return view('front.adverticement');
})->name('adverticement');
Route::get('/front/news', function () {
    return view('front.news');
})->name('news');
Route::get('/news-details', function () {
    return view('front.news-details');
})->name('news-details');
Route::get('/podcast', function () {
    return view('front.podcast');
})->name('podcast');
Route::get('/episodes', function () {
    return view('front.episodes');
})->name('episodes');




Route::get('/home1', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/tmp', 'admin.temp');

Route::prefix('moyasar')->group(function () {
    Route::get('/',          [App\Http\Controllers\MoyasarController::class, 'index'])->name('moyasar.index');
    Route::get('/approve',   [App\Http\Controllers\MoyasarController::class, 'approve'])->name('moyasar.approve');
    Route::post('/checkout', [App\Http\Controllers\MoyasarController::class, 'checkout'])->middleware(['auth'])->name('moyasar.checkout');
});

Route::group([
    'middleware' => ['auth:web', 'admin.permissions'], 
    'namespace'  => 'App\Http\Controllers\Admin',
    'prefix'     => LaravelLocalization::setLocale() . '/admin'
], function () {

    Route::get('error',     [App\Http\Controllers\Admin\ErrorsController::class, 'has_no_permission'])->name('admin.error.no_permission');
    Route::get('disabled',  [App\Http\Controllers\Admin\ErrorsController::class, 'account_is_disabled'])->name('admin.error.is_disabled');

    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::get('my-profile',  [App\Http\Controllers\Admin\UserController::class, 'myProfile'])->name('admin.profile.index');
    Route::post('my-profile', [App\Http\Controllers\Admin\UserController::class, 'updateProfile'])->name('admin.profile.update');

    Route::resource('users', UserController::class, [
        'names' => [
            'index'     => 'admin.users.index',
            'store'     => 'admin.users.store',
            'show'      => 'admin.users.show',
            'edit'      => 'admin.users.edit',
            'update'    => 'admin.users.update',
            'destroy'   => 'admin.users.destroy'
        ]
    ]);

    Route::resource('news_category', NewsCategoryController::class, [
        'names' => [
            'index'     => 'admin.news_category.index',
            'store'     => 'admin.news_category.store',
            'show'      => 'admin.news_category.show',
            'edit'      => 'admin.news_category.edit',
            'update'    => 'admin.news_category.update',
            'destroy'   => 'admin.news_category.destroy'
        ]
    ]);

    Route::resource('news', NewsController::class, [
        'names' => [
            'index'     => 'admin.news.index',
            'store'     => 'admin.news.store',
            'show'      => 'admin.news.show',
            'edit'      => 'admin.news.edit',
            'update'    => 'admin.news.update',
            'destroy'   => 'admin.news.destroy'
        ]
    ]);

    Route::resource('festival', FestivalController::class, [
        'names' => [
            'index'     => 'admin.festival.index',
            'store'     => 'admin.festival.store',
            'show'      => 'admin.festival.show',
            'edit'      => 'admin.festival.edit',
            'update'    => 'admin.festival.update',
            'destroy'   => 'admin.festival.destroy'
        ]
    ]);

    Route::resource('playlist', PlayListController::class, [
        'names' => [
            'index'     => 'admin.playlist.index',
            'store'     => 'admin.playlist.store',
            'show'      => 'admin.playlist.show',
            'edit'      => 'admin.playlist.edit',
            'update'    => 'admin.playlist.update',
            'destroy'   => 'admin.playlist.destroy'
        ]
    ]);   

    Route::resource('episodes', EpisodesController::class, [
        'names' => [
            'index'     => 'admin.episodes.index',
            'store'     => 'admin.episodes.store',
            'show'      => 'admin.episodes.show',
            'edit'      => 'admin.episodes.edit',
            'update'    => 'admin.episodes.update',
            'destroy'   => 'admin.episodes.destroy'
        ]
    ]);

    Route::resource('event', EventsController::class, [
        'names' => [
            'index'     => 'admin.event.index',
            'store'     => 'admin.event.store',
            'show'      => 'admin.event.show',
            'edit'      => 'admin.event.edit',
            'update'    => 'admin.event.update',
            'destroy'   => 'admin.event.destroy'
        ]
    ]);

    

    Route::resource('settings', SettingController::class, [
        'names' => [
            'index'   => 'admin.settings.index',
            'store'   => 'admin.settings.store'
        ]
    ]);

    // EXCEL EXPORT
    Route::get('promo-export/{id}', [App\Http\Controllers\Admin\PromoFolderController::class, 'export'])->name('admin.export.promos');

    // FAST AJAX SEARCH
    Route::get('/users-search',            [App\Http\Controllers\Admin\UserController::class,           'dataAjax'])->name('admin.search.users');
    Route::get('/students-search',         [App\Http\Controllers\Admin\StudentController::class,        'dataAjax'])->name('admin.search.students');
    Route::get('/parents-search',          [App\Http\Controllers\Admin\StudentParentController::class,  'dataAjax'])->name('admin.search.parents');
    Route::get('/newsCategory-search',     [App\Http\Controllers\Admin\NewsCategoryController::class,   'dataAjax'])->name('admin.search.news_category');
    Route::get('/playlist-search',         [App\Http\Controllers\Admin\PlayListController::class,       'dataAjax'])->name('admin.search.playlist');
    Route::get('/festival-search',         [App\Http\Controllers\Admin\FestivalController::class,       'dataAjax'])->name('admin.search.festival');
    Route::get('/districts-search',        [App\Http\Controllers\Admin\DistrictController::class,       'dataAjax'])->name('admin.search.districts');
    Route::get('/course-search',           [App\Http\Controllers\Admin\CourseController::class,         'dataAjax'])->name('admin.search.courses');
    Route::get('/promo-folders-search',    [App\Http\Controllers\Admin\PromoFolderController::class,    'dataAjax'])->name('admin.search.promoFolders');
    Route::get('/course-categories-search',[App\Http\Controllers\Admin\CourseCategoryController::class, 'dataAjax'])->name('admin.search.courseCategories');
    Route::get('/wallets-users-search',    [App\Http\Controllers\Admin\UserController::class,           'dataWalletUserAjax'])->name('admin.search.users');
    Route::get('/roles-search',            [App\Http\Controllers\Admin\RoleController::class,           'roleAjax'])->name('admin.search.roles');
    Route::get('/permissions-search',      [App\Http\Controllers\Admin\RoleController::class,           'permissionAjax'])->name('admin.search.permissions');
    
});