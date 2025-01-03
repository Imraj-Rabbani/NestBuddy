<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::controller(UserController::class)->group(function(){
    Route::get('/', 'homepage')->name('homepage');
    Route::get('/list-flat', 'listFlat')->name('listflat');
    Route::post('/save-flat', 'saveFlat')->name('saveFlat');
    Route::get('/listed-room', 'listedRoom')->name('listedroom');
    Route::get('/create-shop', 'createShop')->name('createshop');
    Route::post('/save-shop', 'saveShop')->name('saveshopinfo');
    Route::post('/place-bid/{flat_id}/{room_number}', 'placeBid')->name('placebid');
    Route::get('/shops', 'shops')->name('shops');


});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
