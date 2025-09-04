<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\college;
use App\Models\major;
use App\Models\lesson;
use App\Models\major_uni_college;
use App\Models\midd_lesson;
use App\Models\midd_teacher;
use App\Models\university;
use App\Models\uni_college;
use App\Models\student;
use App\Models\term;
use App\Models\midd_student_ucm;

class CollegeController extends Controller
{
    public function create()
    {
        $unis = university::all();
        return view('college.create', ["unis" => $unis]);
    }
    public function store(Request $request)
    {
        $collegeId = college::insertGetId([
            'name' => $request->name,
        ]);
        uni_college::create([
            'college_id' => $collegeId,
            'uni_id' => $request->uni
        ]);
        return redirect('/colleges/list');
    }
    public function index()
    {
        $uniColleges = uni_college::all();
        $data = [];
        foreach ($uniColleges as $uniCollege) {
            $college = college::find($uniCollege->college_id);
            $uni = university::find($uniCollege->uni_id);
            $data[] = ['ucRowId' => $uniCollege?->id, 'collegeId' => $college?->id, 'collegeName' => $college?->name, 'uni' => $uni?->name . " " . $uni?->city];
        }
        return view('college.index', ['data' => $data]);
    }
    public function show($id)
    {
        $uni_college = uni_college::find($id);
        $college = college::find($uni_college->college_id);
        $uni = university::find($uni_college->uni_id);
        $college['uniName'] = $uni?->name . " " . $uni?->city;
        return view('college.show', ['college' => $college]);
    }
    public function edit($id)
    {
        $uni_college = uni_college::find($id);
        $college = college::find($uni_college->college_id);
        $uni = university::find($uni_college->uni_id);
        $unis = university::all();
        $college["rowId"] = $uni_college?->id;
        $college["uniId"] = $uni?->id;
        return view('college.edit', ['college' => $college, 'unis' => $unis]);
    }
    public function update(Request $request)
    {
        $uni_college = uni_college::find($request->rowId);
        $uni_college->college_id = $request->collegeId;
        $uni_college->uni_id = $request->uni;
        $uni_college->save();
        $college = college::find($request->collegeId);
        $college->name = $request->name;
        $college->save();
        return redirect('/colleges/list');
    }
    public function delete($id)
    {
        $uni_college = uni_college::find($id);
        $college = college::find($uni_college->college_id);
        $mucs = major_uni_college::where('college_id', $college->id)->get();
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
                }
            }
        }
        $college?->delete();
        $uni_college?->delete();
        return redirect('/colleges/list');
    }
    public function collegeInfo($id)
    {
        $info = [];
        $uc = uni_college::find($id);
        $major_uni_college = major_uni_college::where('college_id', $uc->college_id)->where('uni_id', $uc->uni_id)->get();
        foreach ($major_uni_college as $row) {
            $college = college::find($uc->college_id);
            $major = major::find($row->major_id);
            $midd_lessons = midd_lesson::where('midd_id', $row->id)->get();
            foreach ($midd_lessons as $midd_lesson) {
                $lesson = lesson::find($midd_lesson->lesson_id);
                $info[$college?->name][$major?->name][] = $lesson?->name;
            }
        }
        return view('college.collegeInfo', ['info' => $info]);
    }
}
