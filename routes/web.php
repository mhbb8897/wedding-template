<?php

use App\Http\Controllers\WeddingInvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/{slug}', [WeddingInvitationController::class, 'show'])
    ->name('wedding.show');
Route::post('/{slug}/wishes', [WeddingInvitationController::class, 'storeWish'])
    ->name('wedding.wishes.store');