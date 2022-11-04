<?php

use App\Http\Controllers\AttemptPracticalTestController;

Route::controller(AttemptPracticalTestController::class)->group(function () {
    Route::get('GoToPracticalExams/{id}', 'GoToPracticalExams')
        ->name('GoToPracticalExams');

    Route::any('SubmitPracticalExam', 'SubmitPracticalExam')
        ->name('SubmitPracticalExam');

});