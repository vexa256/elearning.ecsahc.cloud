<?php

namespace App\Http\Controllers;

use Auth;
use DB;

class PreScoreboard extends Controller
{
    public function PreScoreboard($CID)
    {
        $UserID = Auth::user()->UserID;

        $TotalPreTest = DB::table('pre_tests')
            ->where('CID', $CID)->count();

        /*** Count Attempted */

        $PreAttempted = DB::table('attempt_pre_tests')
            ->where('UserID', $UserID)
            ->where('CID', $CID)
            ->groupBy('TestID')
            ->count();

        /***Score Student */

        $PreTotalScore = $TotalPreTest * 10;

        $PrePassed = DB::table('attempt_pre_tests')
            ->where('UserID', $UserID)
            ->where('CID', $CID)
            ->where('score', 'pass')
            ->count();

        $data = [
            "score"     => ($PrePassed / $PreTotalScore) * 100,
            "Attempted" => $PreAttempted,
            "Total"     => $TotalPreTest * 10,
        ];

        return $data;

    }
}