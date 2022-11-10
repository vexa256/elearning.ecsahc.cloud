<?php

namespace App\Http\Controllers;

use Auth;
use DB;

class MainController extends Controller
{
    // protected $property;

    public function __construct()
    {

        $UserCounter = DB::table('users')->where('UserID', null)
            ->orWhere('UserID', ' ')
            ->orWhere('UserID', '')
            ->count();

        if ($UserCounter > 0) {

            $Updater = DB::table('users')->where('UserID', null)
                ->orWhere('UserID', ' ')
                ->orWhere('UserID', '')
                ->get();

            foreach ($Updater as $data) {
                DB::table('users')
                    ->where('id', $data->id)
                    ->update([
                        "UserID" => md5(uniqid() . date('Y-m-d H:I:s')),
                    ]);
            }

        }
    }

    public function console()
    {

        return redirect()->route('PreExamCourse');

        // $data = [
        //     'Page'  => 'console.console',
        //     'Title' => 'ECSA-HC Admin E-learning Platform Dashboard',
        //     'Desc'  => 'Administrator Account',
        //     // "rem" => $rem,
        //     // "Form" => $FormEngine->Form('courses'),
        // ];

        // return view('scrn', $data);

    }

    public function CloudConsole()
    {
        $PostTestsAttempted = DB::table('attempt_posts_tests')
            ->where('UserID', Auth::user()->UserID)
        // ->where('CID', $Course->CID)
            ->count(DB::raw('DISTINCT TestID'));

        $ModularTestsAttempted = DB::table('attempt_modular_tests')
            ->where('UserID', Auth::user()->UserID)
        // ->where('CID', $Course->CID)
            ->count(DB::raw('DISTINCT TestID'));

        $PracticalTestsAttempted = DB::table('attempt_practical_tests')
            ->where('UserID', Auth::user()->UserID)
        // ->where('CID', $Course->CID)
            ->count(DB::raw('DISTINCT TestID'));

        $Courses = DB::table('courses')->count();

        $data = [
            'Page'           => 'f-dashboard.dashboard',
            'Title'          => 'ECSA-HC  Digital Academy  Dashboard ',
            'Desc'           => 'Student Account',
            "TotalAttempted" => $PostTestsAttempted + $ModularTestsAttempted + $PracticalTestsAttempted,
            "Courses"        => $Courses,

        ];

        return view('front', $data);

    }

}