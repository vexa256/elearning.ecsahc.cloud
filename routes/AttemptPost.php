<?php

use App\Http\Controllers\AttemptPostExamController;

Route::controller(AttemptPostExamController::class)->group(function () {
    Route::get('GoToPostExams/{id}', 'GoToPostExams')
        ->name('GoToPostExams');

    Route::any('SubmitPostExam', 'SubmitPostExam')
        ->name('SubmitPostExam');

});