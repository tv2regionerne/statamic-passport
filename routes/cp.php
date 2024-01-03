<?php

use Tv2regionerne\StatamicPassport\Http\Controllers\CP\PassportController;

Route::middleware('statamic.cp.authenticated')->name('passport.')->group(function () {
    Route::get('passport', [PassportController::class, 'index'])->name('index');
});
