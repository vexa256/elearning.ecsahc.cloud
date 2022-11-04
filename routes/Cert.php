<?php

use App\Http\Controllers\CertificationController;

Route::controller(CertificationController::class)->group(function () {

    Route::get('GenerateCertificate', 'GenerateCertificate')
        ->name('GenerateCertificate');
});