<?php

use App\Http\Controllers\AttemptPreTestController;

Route::controller(AttemptPreTestController::class)->group(function () {
    Route::get('GoToAttemptPreExams/{id}', 'GoToAttemptPreExams')
        ->name('GoToAttemptPreExams');

    Route::any('SubmitPreExam', 'SubmitPreExam')
        ->name('SubmitPreExam');

});