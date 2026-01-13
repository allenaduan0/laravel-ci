<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('profiles.index');
});

Route::get('profiles/trashed', [ProfileController::class, 'trashed'])->name('profiles.trashed');

Route::resource('profiles', ProfileController::class);

Route::patch('profiles/{profile}/restore', [ProfileController::class, 'restore'])->name('profiles.restore');
Route::delete('profiles/{profile}/force-delete', [ProfileController::class, 'forceDelete'])->name('profiles.force-delete');
