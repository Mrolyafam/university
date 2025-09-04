<?php

namespace App\Http\Controllers;

use App\Models\approveRequest;
use App\Models\college;
use App\Models\lesson;
use App\Models\major;
use App\Models\major_uni_college;
use App\Models\midd_lesson;
use App\Models\midd_student_ucm;
use App\Models\midd_teacher;
use App\Models\uni_college;
use App\Models\university;
use App\Models\teacher;
use App\Models\student;
use App\Models\term;
use App\Models\transferRequest;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function create()
    {
        return view('university.create');
    }
    public function store(Request $request)
    {
        university::create($request->all());
        return redirect('/universities/list');
    }
    public function index()
    {
        $unis = university::all();
        return view('university.index', ['unis' => $unis]);
    }
    public function show($id)
    {
        $uni = university::find($id);
        return view('university.show', ['uni' => $uni]);
    }
    public function edit($id)
    {
        $uni = university::find($id);
        return view('university.edit', ['uni' => $uni]);
    }
    public function update(Request $request)
    {
        $uni = university::find($request->id);
        $uni->name = $request->name;
        $uni->city = $request->city;
        $uni->save();
        return redirect('/universities/list');
    }
    public function delete($id)
    {
        $ucs = uni_college::where("uni_id", $id)->get();
        foreach ($ucs as $uc) {
            $college = college::find($uc->college_id);
            $college?->delete();
            $uc?->delete();
        }
        $mucs = major_uni_college::where('uni_id', $id)->get();
        foreach ($mucs as $muc) {
            $midd_student_ucm = midd_student_ucm::where('ucm_id', $muc?->id)->get();
            student::find($midd_student_ucm[0]?->student_id)?->delete();
            term::where('student_id', $midd_student_ucm[0]?->student_id)->delete();
            $midd_student_ucm[0]?->delete();
            $muc?->delete();
            $triple = major_uni_college::where('major_id', $muc->major_id)->get();
            if (count($triple) == 0) {
                $major = major::find($muc->major_id);
                $major?->delete();
            }
            $midd_lessons = midd_lesson::where('midd_id', $muc->id)->get();
            foreach ($midd_lessons as $midd_lesson) {
                $midd_lesson?->delete();
                $mss = midd_lesson::where('lesson_id', $midd_lesson->lesson_id)->get();
                if (count($mss) == 0) {
                    $lesson = lesson::find($midd_lesson->lesson_id);
                    $lesson?->delete();
                }
                $midd_teachers = midd_teacher::where('midd_lesson_id', $midd_lesson->id)->get();
                foreach ($midd_teachers as $midd_teacher) {
                    $midd_teacher?->delete();
                    $mts = midd_teacher::where('teacher_id', $midd_teacher->teacher_id)->get();
                    if (count($mts) == 0) {
                        $teacher = teacher::find($midd_teacher->teacher_id);
                        $teacher?->delete();
                    }
                }
            }
        }
        $uni = university::find($id);
        $uni?->delete();
        return redirect('/universities/list');
    }
    public function uniInfo($id)
    {
        $uni = university::find($id);
        $uni_colleges = uni_college::where('uni_id', $uni->id)->get();
        $data = [];
        foreach ($uni_colleges as $uni_college) {
            $college = college::find($uni_college->college_id);
            $mucs = major_uni_college::where('uni_id', $uni->id)->where('college_id', $college->id)->get();
            foreach ($mucs as $muc) {
                $major = major::find($muc->major_id);
                $midd_lessons = midd_lesson::where('midd_id', $muc->id)->get();
                foreach ($midd_lessons as $midd_lesson) {
                    $lesson = lesson::find($midd_lesson->lesson_id);
                    $data[$uni?->name . " " . $uni?->city][$college?->name][$major?->name][] = $lesson?->name;
                }
            }
        }
        return view('university.uniInfo', ['data' => $data]);
    }
    public function studentsRequests($id)
    {
        $students = [];
        $uni_colleges = uni_college::where('uni_id', $id)->get();
        foreach ($uni_colleges as $uni_college) {
            $ucms = major_uni_college::where('uni_id', $uni_college->uni_id)->where('college_id', $uni_college->college_id)->get();
            foreach ($ucms as $ucm) {
                $midd_student_ucms = midd_student_ucm::where('ucm_id', $ucm->id)->get();
                foreach ($midd_student_ucms as $midd_student_ucm) {
                    $student = student::find($midd_student_ucm->student_id);
                    $approveReqs = approveRequest::where('stu_id', $student->id)->get();
                    foreach ($approveReqs as $approveReq) {
                        $student['approveReq'] = $approveReq;
                    }
                    $transferReqs = transferRequest::where('stu_id', $student->id)->get();
                    foreach ($transferReqs as $transferReq) {
                        $student['transferReq'] = $transferReq;
                    }
                    $students[] = $student;
                }
            }
        }
        return view('university.requests', ['students' => $students]);
    }
}
