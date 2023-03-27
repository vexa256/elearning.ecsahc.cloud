<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FormEngine;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\AttemptPreTestController;
use App\Http\Controllers\StudentScoreBoardController;

class StudentController extends Controller
{
    public function StudentCourses()
    {
        $rem = [

            'updated_at',
            'created_at',
            'Email',
            'Name',
            'id',
            'uuid',
            'CID',
            'MID',
            'ReasonsForJoining',
            'SpecialNeed',
            'Gender',
            'CV',
            'StudentID',
            'ApprovalStatus',
            'StartDate',
            'CourseDuration',
            'Comment',
            'nationality',
            'SpecialNeeds',
        ];

        $FormEngine = new FormEngine();

        $Countries = DB::table('countries')->get();

        $Courses = DB::table('courses AS C')
            ->join('institutions AS  I', 'I.IID', 'C.IID')
            ->select('C.*', 'I.Title')
            ->get();

        $CourseState = DB::table('course_states')
            ->where('UserID', Auth::user()->UserID)
            ->count();

        foreach ($Courses as $cos) {

            $count = DB::table('course_states')
                ->where('UserID', Auth::user()->UserID)
                ->where('CID', $cos->CID)
                ->count();

            if ($count < 1) {

                DB::table('course_states')->insert([
                    'uuid'   => md5(uniqid() . \Hash::make(uniqid() . 'AFC' . date('Y-m-d H:I:S'))),
                    'UserID' => Auth::user()->UserID,
                    'role'   => 'Incomplete',
                    'CID'    => $cos->CID,
                ]);
            }

            $ShowUserCourses = DB::table('courses AS C')
                ->join('institutions AS  I', 'I.IID', 'C.IID')
                ->join('course_states AS  S', 'S.CID', 'C.CID')
                ->select('C.*', 'I.Title', 'S.role')
                ->get();

            // dd($ShowUserCourses);

        }

        $data = [
            'Page'        => 'f-courses.ViewCourses',
            'Title'       => 'View all courses',
            'Desc'        => 'Our Course Catalogue',
            'Courses'     => $ShowUserCourses->unique('Course'),
            'Countries'   => $Countries,
            'NewApp'      => 'true',
            'PDF'         => 'true',
            'Editor'      => 'true',
            'rem'         => $rem,
            'CourseState' => $CourseState,
            'Form'        => $FormEngine->Form('students'),
        ];

        return view('front', $data);
    }
    public function NewStudent(Request $request)
    {
        $request->validate([
            '*'         => 'required',
            'TableName' => 'required',
            // 'CV'        => 'required|mimes:pdf|max:30048',
            'Email'     => 'nullable|unique:students',
            // 'StudentID' => 'required|mimes:pdf|max:30048',
        ]);

        // $CV = time() . '.' . $request->CV->extension();
        // $request->CV->move(public_path('assets/data'), $CV);

        // $StudentID = time() . '.' . $request->StudentID->extension();
        // $request->StudentID->move(public_path('assets/data'), $CV);

        $CheckInsert = DB::table($request->TableName)
            ->where('CID', $request->CID)
            ->where('uuid', Auth::user()->UserID)
            ->count();

        if ($CheckInsert > 0) {
            return redirect()
                ->back()
                ->with(
                    'status',
                    'You have already enrolled for this course. Try another course'
                );
        }

        DB::table($request->TableName)->insert(
            $request->except(['_token', 'TableName', 'id', 'files', 'role'])
        );

        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'UserID'            => Auth::user()->UserID,
                'role'              => 'student',
                'phone'             => $request->MobileNumber,
                // 'name'              => $request->Name,
                'ApplicationLetter' => $request->ReasonsForJoining,
                'Institution'       => $request->ParentOrganization,
                'Nationality'       => $request->Nationality,
                'Gender'            => $request->Gender,
            ]);

        DB::table('course_states')
            ->where('UserID', Auth::user()->UserID)
            ->where('CID', $request->CID)
            ->update([
                'role' => 'PreTest',
            ]);

        DB::table($request->TableName)
            ->where('uuid', Auth::user()->UserID)
            ->update([
                "Name"  => Auth::user()->name,
                "Email" => Auth::user()->email,
            ]);

        // DB::table($request->TableName)
        //     ->where('uuid', $request->uuid)
        //     ->update([
        //         'StudentID' => $StudentID,
        //         'CV'        => $CV,
        //     ]);

        return redirect()
            ->back()
            ->with(
                'status',
                'Your course application has been submitted successfully. The information collected will be applied to all your future course enrollments'
            );
    }

    public function Explore($id)
    {

        $Courses = DB::table('courses')->where('id', $id)
            ->first();

        $counter = DB::table('course_start_registers')
            ->where('CID', $Courses->CID)
            ->where('UserID', \Auth::user()->UserID)
            ->count();

        if ($counter < 1) {
            DB::table('course_start_registers')
                ->insert([
                    "CID"             => $Courses->CID,
                    "UserID"          => \Auth::user()->UserID,
                    "CourseStartDate" => date("Y-m-d"),
                    "created_at"      => date("Y-m-d"),
                ]);
        }

        $Docs = DB::table('notes AS N')
            ->join('courses AS C', 'C.CID', 'N.CID')
            ->where('N.CID', $Courses->CID)
            ->where('N.type', 'document')
            ->select('N.*', 'C.Course')
            ->get();

        $Videos = DB::table('notes AS N')
            ->join('courses AS C', 'C.CID', 'N.CID')
            ->where('N.CID', $Courses->CID)
            ->where('N.type', 'video')
            ->select('N.*', 'C.Course')
            ->get();

        $Pres = DB::table('notes AS N')
            ->join('courses AS C', 'C.CID', 'N.CID')
            ->where('N.CID', $Courses->CID)
            ->where('N.type', 'present')
            ->select('N.*', 'C.Course')
            ->get();

        $Modules = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->where('M.CID', $Courses->CID)
            ->select('M.*', 'C.Course', 'C.id AS CourseID')
            ->orderBy('M.Module', 'asc')
            ->get();
        // $Modules = DB::table('modules AS M')
        //     ->join('courses AS C', 'C.CID', 'M.CID')
        //     ->where('M.CID', $Courses->CID)
        //     ->select('M.*', 'C.Course', 'C.id AS CourseID')
        //     ->orderBy('M.id', 'desc')
        //     ->get();

        // $PreTestStatus = Auth::user()->role;

        $ShowUserCourses = DB::table('courses AS C')
            ->join('institutions AS  I', 'I.IID', 'C.IID')
            ->join('course_states AS  S', 'S.CID', 'C.CID')
            ->where('C.CID', $Courses->CID)
            ->where('UserID', Auth::user()->UserID)
            ->select('C.*', 'I.Title', 'S.role')
            ->first();

        $PreTestState = $ShowUserCourses->role;

        $PreTestTable = DB::table('pre_tests')
            ->where('CID', $Courses->CID)
            ->first();

        $Questions = DB::table('exam_questions AS Q')
            ->join('pre_tests AS P', 'P.PreTestID', 'Q.TestID')
            ->join('courses AS  C', 'C.CID', 'Q.CID')
            ->select('Q.*', 'C.Course', 'P.Title', 'P.VeryBriefDescription')
            ->inRandomOrder()
            ->limit(10)
            ->get();

        if ($Questions->count() < 1) {
            return redirect()
                ->back()
                ->with(
                    'error_a',
                    'The administrator is yet to create a pre-test for this course, Please try again later'
                );
        }
        $course_states = DB::table('course_states')
            ->where('CID', $Courses->CID)
            ->where('UserID', Auth::user()->UserID)
            ->first();

        if ($course_states->role == "PreTest") {

            $AttemptPreTestController = new AttemptPreTestController;

            return $AttemptPreTestController->GoToAttemptPreExams(

                $PreTestTable->id
            );

        }

        $data = [
            'Page'          => 'f-courses.Explore',
            'Title'         => 'Explore the course ' . $Courses->Course,
            'Desc'          => 'Course Dashboard',
            "PDF"           => 'true',
            "Docs"          => $Docs,
            "Videos"        => $Videos,
            "Pres"          => $Pres,
            "Modules"       => $Modules,
            "Courses"       => $Courses->Course,
            "PreTestStatus" => $PreTestState,
            "Questions"     => $Questions,
            // 'rem'   => $rem,
            // 'Form'  => $FormEngine->Form('students'),
        ];

        return view('front', $data);

    }

    public function FrontViewNotes($id)
    {
        $StudentScoreBoardController = new StudentScoreBoardController;

        if (Cache::has('CoursePage' . Auth::user()->UserID)) {

            Cache::forget('CoursePage' . Auth::user()->UserID);

            Cache::forever('CoursePage' . Auth::user()->UserID,

                'FrontViewNotes/' . $id

            );

        } else {

            Cache::forever('CoursePage' . Auth::user()->UserID,

                'FrontViewNotes/' . $id

            );

        }

        $Courses = DB::table('courses')
            ->where('id', $id)
            ->first();

        $StudentScoreBoardController
            ->UserScoreboard($Courses->CID);

        $Docs = DB::table('notes AS N')
            ->join('courses AS C', 'C.CID', 'N.CID')
            ->where('N.CID', $Courses->CID)
            ->where('N.type', 'document')
            ->select('N.*', 'C.Course')
            ->get();

        $Videos = DB::table('notes AS N')
            ->join('courses AS C', 'C.CID', 'N.CID')
            ->where('N.CID', $Courses->CID)
            ->where('N.type', 'video')
            ->select('N.*', 'C.Course')
            ->get();

        $Pres = DB::table('notes AS N')
            ->join('courses AS C', 'C.CID', 'N.CID')
            ->where('N.CID', $Courses->CID)
            ->where('N.type', 'present')
            ->select('N.*', 'C.Course')
            ->get();

        $Modules = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->where('M.CID', $Courses->CID)
            ->select('M.*', 'C.Course')
            ->get();

        $ModularExams = DB::table('modular_tests AS T')
            ->join('modules AS M', 'M.MID', 'T.MID')
            ->where('T.CID', $Courses->CID)
            ->select('T.*', 'M.Module')
            ->get();

        $PracticalExams = DB::table('practical_tests AS T')
            ->join('modules AS M', 'M.MID', 'T.MID')
            ->where('T.CID', $Courses->CID)
            ->select('T.*', 'M.Module') //
            ->get();

        // dd($PracticalExams);
        $PostExams = DB::table('post_tests AS T')
            ->where('T.CID', $Courses->CID)
            ->get();

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

        $PracticalTests = DB::table('practical_tests')->where('CID', $Course->CID)
            ->count();

        $ScoreBoards = DB::table('score_boards')
            ->where('UserID', Auth::user()->UserID)
            ->where('CID', $Course->CID)
            ->get();

        $status = DB::table('score_boards')
            ->where('UserID', Auth::user()->UserID)
            ->where('CID', $Course->CID)
            ->first();

        $CertifyStatus = $status->CertificationStatus;

        $Certify = 'false';

        $StudentCertification = null;

        if ($CertifyStatus == "true") {

            $Certify = "true";

            $CodeCheck = DB::table('certificates_tables')
                ->where("CID", $Course->CID)
                ->where("UserID", Auth::user()->UserID)
                ->count();

            if ($CodeCheck < 1) {

                DB::table('certificates_tables')
                    ->where("CID", $Course->CID)
                    ->where("UserID", Auth::user()->UserID)
                    ->insert([
                        "uuid"       => md5(Auth::user()->UserID . Auth::user()->email . date('Y-m-d')),

                        "Course"     => $Course->Course,
                        "created_at" => date('Y-m-d'),
                        "CID"        => $Course->CID,
                        "UserID"     => Auth::user()->UserID,
                        "Name"       => Auth::user()->name,
                        "CertCode"   => sprintf("%02d", mt_rand(1, 99)) . sprintf("%02d", mt_rand(1, 29)) . sprintf("%02d", mt_rand(1, 69)) . "-" . strtoupper(substr(Auth::user()->name, -1)),
                    ]);

                $StudentCertification = DB::table('certificates_tables')
                    ->where("CID", $Course->CID)
                    ->where("UserID", Auth::user()->UserID)->first();

            } else {

                $StudentCertification = DB::table('certificates_tables')
                    ->where("CID", $Course->CID)
                    ->where("UserID", Auth::user()->UserID)->first();
            }
        }

        // dd($ScoreBoards);

        $data = [
            'Page'                    => 'f-courses.ViewNotes',
            'Title'                   => 'Explore the course resources for the course ' . $Courses->Course,
            'Desc'                    => 'Course Dashboard',
            "PDF"                     => 'true',
            "Docs"                    => $Docs,
            "Videos"                  => $Videos,
            "Pres"                    => $Pres,
            "Modules"                 => $Modules,
            "Course"                  => $Courses->Course,
            "ModularExams"            => $ModularExams,
            "PostExams"               => $PostExams,
            "PracticalExams"          => $PracticalExams,
            "CourseProgress"          => '$Progress',
            "PostTestsAttempted"      => $PostTestsAttempted,
            "ModularTestsAttempted"   => $ModularTestsAttempted,
            "PracticalTestsAttempted" => $PracticalTestsAttempted,
            "PostTests"               => $PostTests,
            "ModularTests"            => $ModularTests,
            "PracticalTests"          => $PracticalTests,
            "Scoreboard"              => $ScoreBoards,
            "Analysis"                => 'true',
            "Certify"                 => $Certify,
            "Student"                 => Auth::user()->name,
            "StudentCertification"    => $StudentCertification,

            // 'rem'   => $rem,
            // 'Form'  => $FormEngine->Form('students'),
        ];

        return view('front', $data);

    }
}
