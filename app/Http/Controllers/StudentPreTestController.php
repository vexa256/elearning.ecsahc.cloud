<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FormEngine;
use Auth;
use Carbon\Carbon;
use DB;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StudentPreTestController extends Controller
{
    public function GoToPreExams(int $id)
    {

        $PreTests = DB::table('pre_tests')
            ->where('id', $id)
            ->first();

        // $Modules = DB::table('modules')
        //     ->where('MID', '=', $PreTests->MID)
        //     ->first();

        $SelectedCourse = DB::table('courses')
            ->where('CID', $PreTests->CID)
            ->first();

        $PreExams = DB::table('exam_questions')
        // ->where('MID', '=', $Modules->MID)
            ->where('CID', '=', $PreTests->CID)
            ->where('TestID', '=', $PreTests->PreTestID)
            ->inRandomOrder()
            ->limit(10)
            ->get();

        if ($PreExams->count() < 1) {

            return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
            // ->url(Cache::get('CoursePage' . Auth::user()->UserID))
                ->with('error_a',
                    'The system administrator is currently formulating test questions for this template. Please try again later.');

        }

        $rem = ['id', 'post_tests', 'created_at', 'updated_at', 'ModulePresentation', 'uuid', 'CID', 'QtnID', 'TestID', 'TestType', 'MID', 'enabled', 'status', 'QuestionOptionOne', 'QuestionOptionTwo', 'QuestionOptionThree', 'QuestionOptionFour', 'QuestionOptionFive', 'QuestionOptionThree'];

        $CheckIfExamTimerIsReady = DB::table('exam_durations')
            ->where('TestType', 'Pre Test')
            ->count();

        $ExamTimer = DB::table('exam_durations')
            ->where('TestType', 'Pre Test')
            ->first();

        if ($CheckIfExamTimerIsReady < 1) {
            return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
            // ->url()
                ->with('error_a', 'The system admin has not yet set the exam timing settings for this test');
        }

        if (!Cache::has(Auth::user()->UserID . $PreTests->PreTestID)) {

            Cache::remember(Auth::user()->UserID . $PreTests->PreTestID, 604800, function () {

                $ExamTimer = DB::table('exam_durations')
                    ->where('TestType', 'Post Test')
                    ->first();

                return Carbon::now()->addMinutes($ExamTimer->TestDurationInMinutes);

            });

        } else {

            $TimeIsValidChecker = Carbon::now()
                ->gt(date('F j, Y, g:i a', strtotime(Cache::get(Auth::user()
                        ->UserID . $PreTests->PreTestID))));

                if ($TimeIsValidChecker) {

                    return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
                    // ->url()
                        ->with('error_a',
                            'The exam submission date for this exam has passed. Please try again after 7 days.');

                }

            }

            $FormEngine = new FormEngine();

            $data = [
                'Page'       => 'PreTest.AttemptPost',
                'Title'      => 'Attempt the selected Post test',
                'Desc'       => $SelectedCourse->Course,
                'CourseName' => $SelectedCourse->Course,
                'CID'        => $SelectedCourse->CID,
                // 'MID'        => $Modules->MID,
                'Wizard'     => 'true',
                'Editor'     => 'true',
                'Post_Exams' => $PreExams,
                "Duration"   => Cache::get(Auth::user()->UserID . $PreTests->PreTestID),
                'Title'      => $PreTests->Title,
                'TestID'     => $PreTests->PreTestID,
                // "ModuleName" => $Modules->Module,
                'rem'        => $rem,
                'Form'       => $FormEngine->Form('exam_questions'),
            ];

            return view('front', $data);
        }
    }