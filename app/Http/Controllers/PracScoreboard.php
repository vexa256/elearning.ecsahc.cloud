<?php

namespace App\Http\Controllers;

use Auth;
use DB;

class PracScoreboard extends Controller
{
    public function PracScoreboard($CID)
    {
        $UserID = Auth::user()->UserID;

        $TotalPrac = DB::table('practical_tests')
            ->where('CID', $CID)->count();

        /*** Count Attempted */

        $PracAttempted = DB::table('attempt_practical_tests')
            ->where('UserID', $UserID)
            ->where('CID', $CID)
            ->groupBy('TestID')
            ->count();

        /***Score Student */

        $PracTotalScore = $TotalPrac * 10;

        $PracPassed = DB::table('attempt_modular_tests')
            ->where('UserID', $UserID)
            ->where('CID', $CID)
            ->where('score', 'pass')
            ->count();

        // dd();

        $data = [
            "score"     => ($PracPassed / $PracTotalScore) * 100,
            "Attempted" => $PracAttempted,
            "Total"     => $TotalPrac * 10,
        ];

        return $data;

    }
}