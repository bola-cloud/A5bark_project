<?php

use App\Enums\TokenAbility;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SharedApi\OptionController;
use App\Http\Controllers\SharedApi\WalletController;
use App\Http\Controllers\SharedApi\NotificationController;

use App\Http\Controllers\StudentApi\AuthController;
use App\Http\Controllers\StudentApi\CourseController;
use App\Http\Controllers\StudentApi\GenericController;

// use App\Http\Controllers\Api\Trucker\TruckerController;
// use App\Http\Controllers\Api\Client\TruckingOrderControler;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*****************  Mobile app  *************************/
// Route::get('/front/news', [App\Http\Controllers\Front\NewsController::class, 'index']);
Route::get('/home', [App\Http\Controllers\Api\HomeController::class , 'index']);
Route::get('/news', [App\Http\Controllers\Api\NewsController::class , 'index']);
Route::get('/target/news/{id}', [App\Http\Controllers\Api\NewsController::class , 'targetNews']);
Route::get('/target/festival', [App\Http\Controllers\Api\FestivalEventsController::class , 'index']);
Route::get('/target/festival/event/{id}', [App\Http\Controllers\Api\FestivalEventsController::class , 'getTargetEvent']);

Route::get('/playlist/{id}/episodes', [App\Http\Controllers\Api\PlaylisEpisodesController::class , 'getEpisodesOfPlaylist']);
Route::get('/playlists-and-episodes', [App\Http\Controllers\Api\PlaylisEpisodesController::class , 'getPlaylistsAndEpisodes']);
Route::get('/episodes/home-show', [App\Http\Controllers\Api\PlaylisEpisodesController::class , 'getHomeShowEpisode']);

Route::post('/register', [App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Api\UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/events/{id}/reserve', [App\Http\Controllers\Api\FestivalEventsController::class , 'reserve']);
    Route::put('/user/update', [App\Http\Controllers\Api\UserController::class, 'update']);
    Route::delete('/user/delete', [App\Http\Controllers\Api\UserController::class, 'destroy']);
});

Route::prefix('v1')->group(function () {
    Route::get('home',          [GenericController::class, 'getHomePage']);
    Route::get('top-students',  [GenericController::class, 'getTopStudents']);

    Route::get('districts',     [GenericController::class, 'getDistricts']);

    Route::get('grades',        [GenericController::class, 'getGrades']);
    Route::get('grades/{id}',   [GenericController::class, 'showGrade']);
    
    Route::get('courses',       [GenericController::class, 'getCourses']);
    Route::get('courses/{id}',  [GenericController::class, 'showCourse']);
    Route::get('categories',    [GenericController::class, 'getCoursesCategories']);    
});


Route::prefix('v1/subscripe')
->middleware(['auth:sanctum', 'tokenAbility:'.TokenAbility::ACCESS_API->value])
->group(function () {

    Route::get('course',    [CourseController::class, 'showCourse']);
    Route::get('lession',   [CourseController::class, 'showLession']);
    
    Route::post('course',   [CourseController::class, 'subscripe']);
});


Route::prefix('v1/course')
->middleware(['auth:sanctum', 'tokenAbility:'.TokenAbility::ACCESS_API->value])
->group(function () {

    Route::get('/{id}',           [CourseController::class, 'showCourse']);
    Route::get('lession/{id}',    [CourseController::class, 'showLession']);
    
    Route::post('subscripe/{id}', [CourseController::class, 'subscripe']);
});


Route::prefix('v1/auth')->group(function () {
    
    Route::post('signup',      [AuthController::class, 'signup']);
    Route::post('signin',      [AuthController::class, 'signin']);

    Route::get('profile',      [AuthController::class, 'getProfile'])->middleware(['auth:sanctum', 'tokenAbility:'.TokenAbility::ACCESS_API->value]);
    Route::put('profile',      [AuthController::class, 'updateProfile'])->middleware(['auth:sanctum', 'tokenAbility:'.TokenAbility::ACCESS_API->value]);

});


Route::prefix('v1')->group(function () {
    Route::prefix('selectors')->group(function () {
        Route::get('goves', [OptionController::class, 'goves']);
        Route::get('car-brands-models', [OptionController::class, 'getCarBrandsModels']);
        Route::get('services', [OptionController::class, 'availableServices']);
    });

    Route::middleware(['auth:sanctum', 'tokenAbility:'.TokenAbility::ACCESS_API->value])->group(function () {
        
        Route::apiResource('notifications', NotificationController::class);
        
        Route::prefix('wallet')->group(function () {
            Route::get('/', [WalletController::class, 'index']);
            Route::get('charges', [WalletController::class, 'charges']);
        });

        Route::get('transactions', [WalletController::class, 'transactions']);
    });
});

Route::post('/moyasar/transaction-status', [App\Http\Controllers\MoyasarController::class, 'transactionWebHock'])->name('moyasar.hock');

