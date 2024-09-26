<?php

use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return redirect('/mahasiswa');
});

Route::resource('mahasiswa', MahasiswaController::class);
