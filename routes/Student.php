<?php

use App\Http\Controllers\StudentController;

Route::controller(StudentController::class)->group(function () {

    Route::get('FrontViewNotes/{id}', 'FrontViewNotes')->name('FrontViewNotes');

    Route::get('Explore/{id}', 'Explore')->name('Explore');

    Route::post('NewStudent', 'NewStudent')->name('NewStudent');

    Route::get('offline', 'StudentCourses')->name('StudentCourses');

    Route::get('StudentCourses', 'StudentCourses')->name('StudentCourses');
});