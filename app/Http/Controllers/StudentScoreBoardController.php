<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ModScoreboard;
use App\Http\Controllers\PostScoreboard;
use App\Http\Controllers\PracScoreboard;
use App\Http\Controllers\PreScoreboard;
use Auth;
use DB;

class StudentScoreBoardController extends Controller
{

    public function UserProgressStats(int $id)
    { //

        $Course = DB::table('courses')->where('id', $id)->first();

        $PostTestsAttempted = DB::table('attempt_posts_tests')
            ->where('UserID', Auth::user()->UserID)
            ->where('CID', $Course->CID)
            ->count(DB::raw('DISTINCT TestID'));

        $ModularTestsAttempted = DB::table('attempt_modular_tests')
            ->where('UserID', Auth::user()->UserID)
            ->where('CID', $Course->CID)
            ->count(DB::raw('DISTINCT TestID'));

        $PracticalTestsAttempted = DB::table('attempt_practical_tests')
            ->where('UserID', Auth::user()->UserID)
            ->where('CID', $Course->CID)
            ->count(DB::raw('DISTINCT TestID'));

        $PostTests = DB::table('post_tests')->where('CID', $Course->CID)
            ->count();

        $ModularTests = DB::table('modular_tests')->where('CID', $Course->CID)
            ->count();

        $PracticalTests = DB::table('practical_tests')
            ->where('CID', $Course->CID)
            ->count();

        $data = [

            "PostTestsAttempted"      => $PostTestsAttempted,
            "ModularTestsAttempted"   => $ModularTestsAttempted,
            "PracticalTestsAttempted" => $PracticalTestsAttempted,
            "PostTests"               => $PostTests,
            "ModularTests"            => $ModularTests,
            "PracticalTests"          => $PracticalTests,

        ];

    }

    public function UserScoreboard($CID)
    {

        $UserID = Auth::user()->UserID;

        $PreScoreboard  = new PreScoreboard;
        $PracScoreboard = new PracScoreboard;
        $PostScoreboard = new PostScoreboard;
        $ModScoreboard  = new ModScoreboard;

        DB::table('score_boards')
            ->where("UserID", $UserID)
            ->delete();

        $Mod  = $ModScoreboard->ModScoreboard($CID);
        $Post = $PostScoreboard->PostScoreboard($CID);
        $Prac = $PracScoreboard->PracScoreboard($CID);
        $Pre  = $PreScoreboard->PreScoreboard($CID);

        $certificationStatus = 'false';

        if ($Mod['score'] > 80 &&
            $Post['score'] > 80 && $Prac['score'] > 80
            && $Pre['score'] > 80) {

            $certificationStatus = "true";

        }

        DB::table('score_boards')->insert([
            "uuid"                => md5(uniqid() . date('Y-m-d H:I:s')),
            "UserID"              => $UserID,
            "CID"                 => $CID,

            "ModularScore"        => $Mod['score'],
            "PostScore"           => $Post['score'],
            "PracScore"           => $Prac['score'],
            "PreScores"           => $Pre['score'],

            "TotalPost"           => $Post['Total'],
            "TotalPrac"           => $Prac['Total'],
            "TotalModular"        => $Mod['Total'],
            "TotalPre"            => $Pre['Total'],

            "PostAttempted"       => $Post['Attempted'],
            "PracAttempted"       => $Prac['Attempted'],
            "ModAttempted"        => $Mod['Attempted'],
            "PreAttempted"        => $Pre['Attempted'],
            "CertificationStatus" => $certificationStatus,
            "created_at"          => date('Y-m-d H:i:s'),
        ]);

    }

    //
}