<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GiftCampaignController;
use App\Http\Controllers\GiftItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/enrolled-campaigns', [HomeController::class, 'enrolledCampaigns'])->middleware('auth');

Auth::routes();

Route::get('gift-items', [GiftItemController::class, 'index'])->middleware('can:HR');
Route::get('gift-items/create', [GiftItemController::class, 'create'])->middleware('can:HR');
Route::post('gift-items', [GiftItemController::class, 'store'])->middleware('can:HR');
Route::get('gift-items/{giftItem}/edit', [GiftItemController::class, 'edit'])->middleware('can:HR');
Route::patch('gift-items/{giftItem}', [GiftItemController::class, 'update'])->middleware('can:HR');
Route::delete('gift-items/{giftItem}', [GiftItemController::class, 'destroy'])->middleware('can:HR');

Route::get('campaigns', [GiftCampaignController::class, 'index'])->middleware('can:HR');
Route::get('campaigns/create', [GiftCampaignController::class, 'create'])->middleware('can:HR');
Route::post('campaigns', [GiftCampaignController::class, 'store'])->middleware('can:HR');

Route::get('campaigns/{giftCampaign}', [GiftCampaignController::class, 'show']);
Route::get('campaigns/{giftCampaign}/pdf', [GiftCampaignController::class, 'pdf'])->middleware('can:HR');

Route::get('campaigns/{giftCampaign}/edit', [GiftCampaignController::class, 'edit'])->middleware('can:HR');
Route::patch('campaigns/{giftCampaign}', [GiftCampaignController::class, 'update'])->middleware('can:HR');
Route::delete('campaigns/{giftCampaign}', [GiftCampaignController::class, 'destroy'])->middleware('can:HR');

Route::post('campaigns/subscribe/{giftCampaign}', [GiftCampaignController::class, 'subscribe']);
Route::post('campaigns/unsubscribe/{giftCampaign}', [GiftCampaignController::class, 'unsubscribe']);

Route::post('campaigns/{giftCampaign}/comment', [CommentController::class, 'store']);
