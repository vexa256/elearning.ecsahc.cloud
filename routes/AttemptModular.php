<?php

use App\Http\Controllers\AttemptModularExamController;

Route::controller(AttemptModularExamController::class)->group(function () {
    Route::get('GoToModularExams/{id}', 'GoToModularExams')
        ->name('GoToModularExams');

    Route::any('SubmitModularExam', 'SubmitModularExam')
        ->name('SubmitModularExam');

});