<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FormEngine;
use App\Models\AttemptModularTests;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AttemptModularExamController extends Controller
{

    public function SubmitModularExam(Request $request)
    {
        $ModularTestID = $request->ModularTestID;

        $TimeIsValidChecker = Carbon::now()
            ->gt(date('F j, Y, g:i a', strtotime(Cache::get(Auth::user()
                    ->UserID . $ModularTestID))));

            if ($TimeIsValidChecker) {

                return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
                // ->url()
                    ->with('error_a',
                        'The exam submission date for this exam has passed. Please try again after 7 days.');

            }

            $validated = $request->validate([
                '*' => 'required',
            ]);

            $Checker = DB::table('attempt_modular_tests')
                ->where('TestID', '=', $request->TestID)
                ->where('UserID', '=', $request->UserID)
                ->count();

            if ($Checker > 0) {

                return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
                // ->url()
                    ->with('error_a', 'You have already attempted this test. Try another modular test');
            }

            $checker = DB::table('exam_timer_locks')
                ->where('TestID', '=', $ModularTestID)
                ->where('UserID', '=', Auth::user()->UserID)
                ->whereDate('LockedTime', date('Y-m-d'))
                ->count();

            if ($checker > 0) {

                return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
                // ->url()
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
                AttemptModularTests::create([

                    'uuid'                => $request->uuid,
                    'CID'                 => $request->CID[$key],
                    'MID'                 => $request->MID[$key],
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

            return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
                ->with('status', 'The test  was submitted successfully. Your results are posted on the scoreboard');

        }

        public function GoToModularExams(int $id)
    {

            $ModularTests = DB::table('modular_tests')
                ->where('id', $id)
                ->first();

            $Modules = DB::table('modules')
                ->where('MID', '=', $ModularTests->MID)
                ->first();

            $SelectedCourse = DB::table('courses')
                ->where('CID', $Modules->CID)
                ->first();

            $ModExams = DB::table('exam_questions')
                ->where('MID', '=', $Modules->MID)
                ->where('CID', '=', $Modules->CID)
                ->where('TestID', '=', $ModularTests->ModularTestID)
                ->inRandomOrder()
                ->limit(10)
                ->get();

            if ($ModExams->count() < 1) {

                return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
                // ->url()
                    ->with('error_a',
                        'The system administrator is currently formulating test questions for this template. Please try again later.');

            }

            $rem = ['id', 'Modular_tests', 'created_at', 'updated_at', 'ModulePresentation', 'uuid', 'CID', 'QtnID', 'TestID', 'TestType', 'MID', 'enabled', 'status', 'QuestionOptionOne', 'QuestionOptionTwo', 'QuestionOptionThree', 'QuestionOptionFour', 'QuestionOptionFive', 'QuestionOptionThree'];

            $CheckIfExamTimerIsReady = DB::table('exam_durations')
                ->where('TestType', 'Modular Test')
                ->count();

            $ExamTimer = DB::table('exam_durations')
                ->where('TestType', 'Modular Test')
                ->first();

            if ($CheckIfExamTimerIsReady < 1) {
                return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
                // ->url()
                    ->with('error_a', 'The system admin has not yet set the exam timing settings for this test');
            }

            if (!Cache::has(Auth::user()->UserID . $ModularTests->ModularTestID)) {

                Cache::remember(Auth::user()->UserID . $ModularTests->ModularTestID, 604800, function () {

                    $ExamTimer = DB::table('exam_durations')
                        ->where('TestType', 'Modular Test')
                        ->first();

                    return Carbon::now()->addMinutes($ExamTimer->TestDurationInMinutes);

                });

            } else {

                $TimeIsValidChecker = Carbon::now()
                    ->gt(date('F j, Y, g:i a', strtotime(Cache::get(Auth::user()
                        ->UserID . $ModularTests->ModularTestID))));

                if ($TimeIsValidChecker) {

                    return redirect(Cache::get('CoursePage' . Auth::user()->UserID))
                    // ->url()
                        ->with('error_a',
                            'The exam submission date for this exam has passed. Please try again after 7 days.');

                }

            }

            $FormEngine = new FormEngine();

            $data = [
                'Page'       => 'Modular.AttemptModular',
                'Title'      => 'Attempt the selected modular test',
                'Desc'       => $SelectedCourse->Course,
                'CourseName' => $SelectedCourse->Course,
                'CID'        => $SelectedCourse->CID,
                'MID'        => $Modules->MID,
                'Wizard'     => 'true',
                'Editor'     => 'true',
                'ModExams'   => $ModExams,
                "Duration"   => Cache::get(Auth::user()->UserID . $ModularTests->ModularTestID),
                'Title'      => $ModularTests->Title,
                'TestID'     => $ModularTests->ModularTestID,
                "ModuleName" => $Modules->Module,
                'rem'        => $rem,
                'Form'       => $FormEngine->Form('exam_questions'),
            ];

            return view('front', $data);
        }
    }