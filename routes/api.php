<?php

use App\Http\Controllers\Api\Profile\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// API root
Route::get('/', function () {
    return response()->json([
        'ok' => true,
        'service' => 'ViperPro Backend API',
        'status' => 'api running',
    ], 200);
});

// Simple ping
Route::get('/ping', function () {
    return response()->json([
        'ok' => true,
        'message' => 'pong',
    ], 200);
});

// Sanctum test user route
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Auth Routes (JWT)
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    include_once __DIR__ . '/groups/api/auth/auth.php';
});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth.jwt']], function () {
    Route::prefix('profile')->group(function () {
        include_once __DIR__ . '/groups/api/profile/profile.php';
        include_once __DIR__ . '/groups/api/profile/affiliates.php';
        include_once __DIR__ . '/groups/api/profile/wallet.php';
        include_once __DIR__ . '/groups/api/profile/likes.php';
        include_once __DIR__ . '/groups/api/profile/favorites.php';
        include_once __DIR__ . '/groups/api/profile/recents.php';
        include_once __DIR__ . '/groups/api/profile/vip.php';
    });

    Route::prefix('wallet')->group(function () {
        include_once __DIR__ . '/groups/api/wallet/deposit.php';
        include_once __DIR__ . '/groups/api/wallet/withdraw.php';
    });

    include_once __DIR__ . '/groups/api/missions/mission.php';
    include_once __DIR__ . '/groups/api/missions/missionuser.php';
});

/*
|--------------------------------------------------------------------------
| Public Category Routes
|--------------------------------------------------------------------------
*/
Route::prefix('categories')->group(function () {
    include_once __DIR__ . '/groups/api/categories/index.php';
});

/*
|--------------------------------------------------------------------------
| Public Game Routes
|--------------------------------------------------------------------------
*/
include_once __DIR__ . '/groups/api/games/index.php';

/*
|--------------------------------------------------------------------------
| Gateway Routes
|--------------------------------------------------------------------------
*/
include_once __DIR__ . '/groups/api/gateways/suitpay.php';

/*
|--------------------------------------------------------------------------
| Search Routes
|--------------------------------------------------------------------------
*/
Route::prefix('search')->group(function () {
    include_once __DIR__ . '/groups/api/search/search.php';
});

/*
|--------------------------------------------------------------------------
| Public Profile Language Routes
|--------------------------------------------------------------------------
*/
Route::prefix('profile')->group(function () {
    Route::post('/getLanguage', [ProfileController::class, 'getLanguage']);
    Route::put('/updateLanguage', [ProfileController::class, 'updateLanguage']);
});

/*
|--------------------------------------------------------------------------
| Providers Routes
|--------------------------------------------------------------------------
*/
Route::prefix('providers')->group(function () {
    // provider routes can be added here
});

/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
*/
Route::prefix('settings')->group(function () {
    include_once __DIR__ . '/groups/api/settings/settings.php';
    include_once __DIR__ . '/groups/api/settings/banners.php';
    include_once __DIR__ . '/groups/api/settings/currency.php';
    include_once __DIR__ . '/groups/api/settings/bonus.php';
});

/*
|--------------------------------------------------------------------------
| Landing Spin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('spin')
    ->group(function () {
        include_once __DIR__ . '/groups/api/spin/index.php';
    })
    ->name('landing.spin.');