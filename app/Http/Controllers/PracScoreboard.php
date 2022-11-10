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

            if ($PracPassed < 1) {
                $score = 1;
            } else {
    
                $score = ($PracPassed / $PracTotalScore) * 100;
            }
    
            $data = [
                "score"     => $score,
                "Attempted" => $PracAttempted,
                "Total"     => $TotalPrac * 10,
            ];
    
            return $data;

    }
}