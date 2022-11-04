<?php

use App\Http\Controllers\ModTestExamController;

Route::controller(ModTestExamController::class)->group(function () {

    Route::any('MgtModExamQtns/{id}', 'MgtModExamQtns')->name('MgtModExamQtns');

    Route::any('ModQtnSelectTest/{id}', 'ModQtnSelectTest')->name('ModQtnSelectTest');

    Route::any('GoToManageModQtns', 'GoToManageModQtns')->name('GoToManageModQtns');

    Route::any('ModQtnTemplate/{id}', 'ModQtnTemplate')->name('ModQtnTemplate');

    Route::any('ModQtnTestAdapt', 'ModQtnTestAdapt')->name('ModQtnTestAdapt');

    Route::any('ModQtnTestsMod/{id}', 'ModQtnTestsMod')->name('ModQtnTestsMod');

    Route::any('ModQtnTestCourse', 'ModQtnTestCourse')->name('ModQtnTestCourse');

    Route::any('GoToManageModExams', 'GoToManageModExams')->name('GoToManageModExams');

    Route::any('ModExamselectTest/{id}', 'ModExamselectTest')->name('ModExamselectTest');

    Route::any('CourseModExamselected', 'CourseModExamselected')->name('CourseModExamselected');

    // Route::any('CourseModQtnSelected', 'CourseModQtnSelected')->name('CourseModQtnSelected');

});