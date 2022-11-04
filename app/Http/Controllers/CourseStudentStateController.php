<?php

namespace App\Http\Controllers;

use DB;

class CourseStudentStateController extends Controller
{

    public function ManageStudentCourseSate($CourseID, $UserID, $State)
    {
        $counter = DB::table('course_states')
            ->where('CID', $CID)
            ->where('UserID', $UserID)
            ->first();

        if ($counter->count() > 0) {
            DB::table('course_states')
                ->where('CID', $CID)
                ->where('UserID', $UserID)
                ->update([
                    "role" => $State,
                ]);

        } else {
            DB::table('course_states')
                ->insert([
                    "role"   => $State,
                    "UserID" => $UserID,
                    "CID"    => $CID,
                    'uuid'   => md5(uniqid() . \Hash::make(uniqid() . 'AFC' . date('Y-m-d H:I:S'))),
                ]);

        }
    }

}