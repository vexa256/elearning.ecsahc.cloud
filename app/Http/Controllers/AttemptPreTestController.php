<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AttemptPreTestController;
use App\Http\Controllers\FormEngine;
use App\Models\AttemptPreTests;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AttemptPreTestController extends Controller
{
    public function SubmitPreExam(Request $request)
    {
        $PreTestID = $request->PreTestID;

        $TimeIsValidChecker = Carbon::now()
            ->gt(date('F j, Y, g:i a', strtotime(Cache::get(Auth::user()
                    ->UserID . $PreTestID))));

            if ($TimeIsValidChecker) {

                return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
                    ->with('error_a',
                        'The exam submission date for this exam has passed. Please try again after 7 days.');

            }

            $validated = $request->validate([
                '*' => 'required',
            ]);

            $Checker = DB::table('attempt_pre_tests')
                ->where('TestID', '=', $request->TestID)
                ->where('UserID', '=', $request->UserID)
                ->count();

            if ($Checker > 0) {

                return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
                // ->url(Cache::get('CoursePage' . Auth::user()->UserID))
                    ->with('error_a', 'You have already attempted this test. Try another Pre test');
            }

            $checker = DB::table('exam_timer_locks')
                ->where('TestID', '=', $PreTestID)
                ->where('UserID', '=', Auth::user()->UserID)
                ->whereDate('LockedTime', date('Y-m-d'))
                ->count();

            if ($checker > 0) {

                return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
                // ->url(Cache::get('CoursePage' . Auth::user()->UserID))
                    ->back()
                    ->with('error_a', 'The system admin has not yet set the exam timing settings for this test');

            }

            // dd($request->uuid);

            $uniqueid = $request->uniqueid;

            foreach ($uniqueid as $key => $value) {

                $score = null;

                if ($request->CorrectAnswerOption[$key] === $request->UserAnswer[$key] || $request->CorrectAnswerOption[$key] == $request->UserAnswer[$key]) {

                    $score = "pass";
                } else {
                    $score = "fail";
                }
                AttemptPreTests::create([

                    'uuid'                => $request->uuid,
                    'CID'                 => $request->CID[$key],
                    // 'MID'                 => $request->MID[$key],
                    'UserID'              => $request->UserID,
                    'TestID'              => $request->TestID,
                    'TestType'            => $request->TestType[$key],
                    'QtnID'               => $request->QtnID[$key],
                    'CorrectAnswerOption' => $request->CorrectAnswerOption[$key],
                    'UserAnswer'          => $request->UserAnswer[$key],
                    'score'               => $score,
                    // 'created_at'          => $request->created_at[$key],

                ]);
            }

            DB::table('course_states')
                ->where('CID', $request->CIID)
                ->where('UserID', Auth::user()->UserID)
                ->update([
                    "role" => 'InProgress',
                ]);

            return redirect()
                ->back()
                ->with('status', 'The test  was submitted successfully. Your results are can be found  on your scoreboard');

        }

        public function GoToAttemptPreExams(int $id)
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

            $rem = ['id', 'pre_tests', 'created_at', 'updated_at', 'ModulePresentation', 'uuid', 'CID', 'QtnID', 'TestID', 'TestType', 'MID', 'enabled', 'status', 'QuestionOptionOne', 'QuestionOptionTwo', 'QuestionOptionThree', 'QuestionOptionFour', 'QuestionOptionFive', 'QuestionOptionThree'];

            $CheckIfExamTimerIsReady = DB::table('exam_durations')
                ->where('TestType', 'Pre Test')
                ->count();

            $ExamTimer = DB::table('exam_durations')
                ->where('TestType', 'Pre Test')
                ->first();

            if ($CheckIfExamTimerIsReady < 1) {
                return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
                    ->back()
                    ->with('error_a', 'The system admin has not yet set the exam timing settings for this test');
            }

            if (!Cache::has(Auth::user()->UserID . $PreTests->PreTestID)) {

                Cache::remember(Auth::user()->UserID . $PreTests->PreTestID, 604800, function () {

                    $ExamTimer = DB::table('exam_durations')
                        ->where('TestType', 'Pre Test')
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
                'Page'       => 'PreTest.AttemptPreTest',
                'Title'      => 'Attempt the selected Course Pre test',
                'Desc'       => $SelectedCourse->Course,
                'CourseName' => $SelectedCourse->Course,
                'CID'        => $SelectedCourse->CID,
                // 'MID'        => $Modules->MID,
                'Wizard'     => 'true',
                'Editor'     => 'true',
                'PreExams'   => $PreExams,
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