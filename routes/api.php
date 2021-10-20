<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\EnrolledCampaignController;
use App\Http\Controllers\Api\GiftCampaignController;
use App\Http\Controllers\Api\GiftItemController;
use App\Http\Controllers\Api\CampaignStatusController;
use App\Http\Controllers\Api\SubscriberController;
use App\Http\Controllers\Api\CommentController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('home', [HomeController::class, 'index']);

Route::apiResource('enrolled-campaigns', EnrolledCampaignController::class);
Route::apiResource('comments', CommentController::class);


Route::apiResource('campaigns', GiftCampaignController::class);
Route::apiResource('gift-items', GiftItemController::class);

Route::apiResource('campaign-statuses', CampaignStatusController::class);
Route::apiResource('subscribers', SubscriberController::class);


