<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Artisan;

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

/******************** front routes ******************/

Route::group([
    'prefix'     => LaravelLocalization::setLocale() 
], function () {
Route::get('/front/news', [App\Http\Controllers\Front\NewsController::class, 'index'])->name('news');
Route::get('/front/adverticement', [App\Http\Controllers\Front\HomeController::class, 'advDetails'])->name('adverticement');
Route::get('/front/about', [App\Http\Controllers\Front\HomeController::class, 'about'])->name('about');
Route::get('/front/news/category/{category}', [App\Http\Controllers\Front\NewsController::class , 'filterByCategory'])->name('news.filter');
Route::get('/front/news/details/{id}', [App\Http\Controllers\Front\NewsController::class , 'details'])->name('news_details');
Route::get('/front/playlist/episodes/{id}', [App\Http\Controllers\Front\ProdcastController::class , 'episodes'])->name('episodes');
Route::get('/front/playlist', [App\Http\Controllers\Front\ProdcastController::class , 'index'])->name('podcast');
Route::get('/front/festival', [App\Http\Controllers\Front\FestivalController::class , 'index'])->name('festival');
Route::get('/front/festival/event/{event}', [App\Http\Controllers\Front\FestivalController::class , 'event'])->name('event_details');
Route::get('/', [App\Http\Controllers\Front\HomeController::class , 'index'])->name('front_home');
Route::get('/front/festival/event/branch/{branch}', [App\Http\Controllers\Front\FestivalController::class , 'branch'])->name('branch_details');
Route::get('/search', [App\Http\Controllers\Front\HomeController::class, 'search'])->name('search');

Route::get('/create-media-link', function () {
    try {
        Artisan::call('storage:link');
        return response()->json(['message' => 'The symbolic link has been created successfully.']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to create the symbolic link.', 'error' => $e->getMessage()]);
    }
});
// terms-and-conditions
Route::get('/terms-and-conditions', function () {
    return view('terms-conditions');
})->name('terms-conditions');
// Route::get('/adverticement', function () {
//     return view('front.adverticement');
// })->name('adverticement');
Route::get('/home1', function () {
    return view('welcome');
});

    
});


/******************** End front routes ******************/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/tmp', 'admin.temp');

Route::prefix('moyasar')->group(function () {
    Route::get('/',          [App\Http\Controllers\MoyasarController::class, 'index'])->name('moyasar.index');
    Route::get('/approve',   [App\Http\Controllers\MoyasarController::class, 'approve'])->name('moyasar.approve');
    Route::post('/checkout', [App\Http\Controllers\MoyasarController::class, 'checkout'])->middleware(['auth'])->name('moyasar.checkout');
});


/******************** Admin routes ******************/

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

    Route::resource('adverticement', AdverticementController::class, [
        'names' => [
            'index'     => 'admin.adverticement.index',
            'store'     => 'admin.adverticement.store',
            'show'      => 'admin.adverticement.show',
            'edit'      => 'admin.adverticement.edit',
            'update'    => 'admin.adverticement.update',
            'destroy'   => 'admin.adverticement.destroy'
        ]
    ]);

    Route::resource('podcast', PodcastController::class, [
        'names' => [
            'index'     => 'admin.podcast.index',
            'store'     => 'admin.podcast.store',
            'show'      => 'admin.podcast.show',
            'edit'      => 'admin.podcast.edit',
            'update'    => 'admin.podcast.update',
            'destroy'   => 'admin.podcast.destroy'
        ]
    ]);

    Route::resource('motion', MotionController::class, [
        'names' => [
            'index'     => 'admin.motion.index',
            'store'     => 'admin.motion.store',
            'show'      => 'admin.motion.show',
            'edit'      => 'admin.motion.edit',
            'update'    => 'admin.motion.update',
            'destroy'   => 'admin.motion.destroy'
        ]
    ]);

    Route::resource('branch', BranchController::class, [
        'names' => [
            'index'     => 'admin.branch.index',
            'store'     => 'admin.branch.store',
            'show'      => 'admin.branch.show',
            'edit'      => 'admin.branch.edit',
            'update'    => 'admin.branch.update',
            'destroy'   => 'admin.branch.destroy'
        ]
    ]);

    Route::resource('places', PlacesController::class, [
        'names' => [
            'index'     => 'admin.places.index',
            'store'     => 'admin.places.store',
            'show'      => 'admin.places.show',
            'edit'      => 'admin.places.edit',
            'update'    => 'admin.places.update',
            'destroy'   => 'admin.places.destroy'
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
    Route::get('/branch-search',           [App\Http\Controllers\Admin\BranchController::class,         'dataAjax'])->name('admin.search.branch');
    Route::get('/course-search',           [App\Http\Controllers\Admin\CourseController::class,         'dataAjax'])->name('admin.search.courses');
    Route::get('/events-search',    [App\Http\Controllers\Admin\EventsController::class,    'dataAjax'])->name('admin.search.event');
    Route::get('/course-categories-search',[App\Http\Controllers\Admin\CourseCategoryController::class, 'dataAjax'])->name('admin.search.courseCategories');
    Route::get('/wallets-users-search',    [App\Http\Controllers\Admin\UserController::class,           'dataWalletUserAjax'])->name('admin.search.users');
    Route::get('/roles-search',            [App\Http\Controllers\Admin\RoleController::class,           'roleAjax'])->name('admin.search.roles');
    Route::get('/permissions-search',      [App\Http\Controllers\Admin\RoleController::class,           'permissionAjax'])->name('admin.search.permissions');
    
});

/******************** End Admin routes ******************/
