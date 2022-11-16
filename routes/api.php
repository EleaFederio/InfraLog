<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProjectController;
use \App\Http\Controllers\EngineerController;
use \App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BiddingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$apiVersion = 'v1';

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => $apiVersion], function () {
    Route::apiResource('engineer', EngineerController::class);

    Route::apiResource('projects', ProjectController::class);
    Route::post('projects/image/upload', [ProjectController::class, 'infraImageUpload']);
    Route::get('infra/image', [ProjectController::class, 'infraImage']);
    Route::post('infra/image/multi_upload', [ProjectController::class, 'multiImageUpload']);

    Route::apiResource('announcements', AnnouncementController::class);
    Route::apiResource('biddings', BiddingController::class);

    Route::apiResource('activities', ActivityController::class);
    Route::post('activities/image/upload', [ActivityController::class, 'upload']);
    Route::get('activity/galery', [ActivityController::class, 'galery']);
});

// Route::apiResource('/'.$apiVersion.'/projects', ProjectController::class);
// Route::apiResource('/'.$apiVersion.'/engineer', EngineerController::class);
// Route::apiResource('/'.$apiVersion.'/announcements', AnnouncementController::class);
// Route::apiResource('/'.$apiVersion.'/bidding', BiddingController::class);


