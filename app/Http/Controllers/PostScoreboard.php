<?php

namespace App\Http\Controllers;

use Auth;
use DB;

class PostScoreboard extends Controller
{
    public function PostScoreboard($CID)
    {
        $UserID = Auth::user()->UserID;

        $TotalPost = DB::table('post_tests')
            ->where('CID', $CID)->count();

        $PostAttempted = DB::table('attempt_posts_tests')
            ->where('UserID', $UserID)
            ->where('CID', $CID)
            ->groupBy('TestID')
            ->count();

        /***Score Student */

        $PostTotalScore = $TotalPost * 10;

        $PostPassed = DB::table('attempt_posts_tests')
            ->where('UserID', $UserID)
            ->where('CID', $CID)
            ->where('score', 'pass')
            ->count();

        $data = [
            "score"     => ($PostPassed / $PostTotalScore) * 100,
            "Attempted" => $PostAttempted,
            "Total"     => $TotalPost * 10,
        ];

        return $data;

    }
}