<?php

namespace App\Http\Controllers;

use Auth;
use DB;

class ModScoreboard extends Controller
{
    public function ModScoreboard($CID)
    {
        $UserID = Auth::user()->UserID;

        $TotalMod = DB::table('modular_tests AS M')
            ->where('M.CID', $CID)
            ->count();

        /*** Count Attempted */

        $ModAttempted = DB::table('attempt_modular_tests')
            ->where('UserID', $UserID)
            ->where('CID', $CID)
            ->groupBy('TestID')
            ->count();

        /***Score Student */

        $ModTotalScore = $TotalMod * 10;

        $ModPassed = DB::table('attempt_modular_tests')
            ->where('UserID', $UserID)
            ->where('CID', $CID)
            ->where('score', 'pass')
            ->count();

        $data = [
            "score"     => ($ModPassed / $ModTotalScore) * 100,
            "Attempted" => $ModAttempted,
            "Total"     => $TotalMod * 10,
        ];

        return $data;

    }
}