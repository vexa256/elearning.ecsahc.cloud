<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ModTestExamController extends Controller
{
    public function ModQtnTestCourse()
    {

        $Courses = DB::table('courses')->get();

        $data = [
            'Page'    => 'ModExams.SelectCourse',
            'Title'   => 'Select the course whose Modular test questions are to be managed',
            'Desc'    => 'Course Modular-Test Question Banks',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function CourseModExamselected(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('ModQtnTestsMod', $id);

    }

    public function ModQtnTestsMod($id)
    {
        $Courses = DB::table('courses')->where('id', $id)->first();
        $Modules = DB::table('modules')->where('CID', $Courses->CID)->get();

        $data = [
            'Page'    => 'ModExams.SelectModule',
            'Title'   => 'Select Course Module whose test questions are to be managed',
            'Desc'    => 'Modular Test Question Banks',
            'Modules' => $Modules,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function ModQtnTestAdapt(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('ModQtnTemplate', $id);

    }

    public function ModQtnTemplate($id)
    {

        $Modules = DB::table('modules')->where('id', $id)->first();

        $ModularTests = DB::table('modular_tests')
            ->where('MID', $Modules->MID)
            ->get();

        // dd($ModularTests);

        $data = [
            'Page'         => 'ModExams.SelectTest',
            'Title'        => 'Select Modular Test Template To Attach Question Bank To',
            'Desc'         => 'Modular Test Question Banks',
            'ModularTests' => $ModularTests,

        ];

        return view('scrn', $data);

    }

    public function GoToManageModExams(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtModExamQtns', $id);

    }

    public function MgtModExamQtns($id)
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
            ->get();

        $rem = ['id', 'Modular_tests', 'created_at', 'updated_at', 'ModulePresentation', 'uuid', 'CID', 'QtnID', 'TestID', 'TestType', 'MID', 'enabled', 'status', 'QuestionOptionOne', 'QuestionOptionTwo', 'QuestionOptionThree', 'QuestionOptionFour', 'QuestionOptionFive', 'QuestionOptionThree'];

        $FormEngine = new FormEngine();
        $data       = [
            'Page'       => 'ModExams.ModExams',
            'Title'      => 'Manage Modular-Test questions attached to the selected course',
            'Desc'       => $SelectedCourse->Course,
            'CourseName' => $SelectedCourse->Course,
            'CID'        => $SelectedCourse->CID,
            'MID'        => $Modules->MID,
            'ModExams'   => $ModExams,
            'Title'      => $ModularTests->Title,
            'TestID'     => $ModularTests->ModularTestID,
            "ModuleName" => $Modules->Module,
            'rem'        => $rem,
            'Form'       => $FormEngine->Form('exam_questions'),
        ];

        return view('scrn', $data);
    }
}