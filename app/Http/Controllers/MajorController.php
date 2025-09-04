<?php

namespace App\Http\Controllers;

use App\Models\college;
use App\Models\lesson;
use App\Models\uni_college;
use App\Models\university;
use App\Models\major;
use App\Models\major_uni_college;
use App\Models\midd_lesson;
use App\Models\midd_teacher;
use Illuminate\Http\Request;
use App\Models\student;
use App\Models\term;
use App\Models\midd_student_ucm;

class MajorController extends Controller
{
    public function create()
    {
        $info = [];
        $unis_colleges = uni_college::all();
        foreach ($unis_colleges as $uni_college) {
            $uni = university::find($uni_college?->uni_id);
            $college = college::find($uni_college?->college_id);
            $info[$uni?->id]['uniData'] = $uni;
            $info[$uni?->id]['colleges'][] = $college;
        }
        return view('major.create', ['info' => $info]);
    }
    public function store(Request $request)
    {
        $majorId = major::insertGetId([
            'name' => $request->name
        ]);
        foreach ($request->uni_ids as $uniId) {
            major_uni_college::create([
                'major_id' => $majorId,
                'uni_id' => $uniId,
                'college_id' => $request[$uniId]
            ]);
        }
        return redirect('/majors/list');
    }
    public function index()
    {
        $majorInfo = [];
        $uni_colleges = uni_college::all();
        foreach ($uni_colleges as $uni_college) {
            $data = [];
            $uni = university::find($uni_college->uni_id);
            $college = college::find($uni_college->college_id);
            $maj_uni_colls = major_uni_college::where('college_id', $college?->id)->where('uni_id', $uni?->id)->get();
            foreach ($maj_uni_colls as $row) {
                $major = major::find($row->major_id);
                $data[] = ['rowId' => $row->id, 'majorId' => $major?->id, 'majorName' => $major?->name,  'college' => $college?->name, 'uni' => $uni?->name . " " . $uni?->city];
            }
            $majorInfo[] = $data;
        }
        return view('major.index', ['majorInfo' => $majorInfo]);
    }
    public function show($id)
    {
        $row = major_uni_college::find($id);
        $uni = university::find($row->uni_id);
        $college = college::find($row->college_id);
        $major = major::find($row->major_id);
        $data[$college?->name] = $uni?->name . " " . $uni?->city;
        return view('major.show', ['major' => $major, 'data' => $data]);
    }
    public function edit($id)
    {
        $data = [];
        $ids = [];
        $row = major_uni_college::find($id);
        $uni = university::find($row->uni_id);
        $college = college::find($row->college_id);
        $major = major::find($row->major_id);
        $ids['collegeId'] = $college?->id;
        $ids['uniId'] = $uni?->id;
        $ids['rowId'] = $row->id;
        $major['ids'] = $ids;
        $unis = university::all();
        foreach ($unis as $uni) {
            $unis_colleges = uni_college::where('uni_id', $uni->id)->get();
            foreach ($unis_colleges as $uni_college) {
                $college = college::find($uni_college->college_id);
                $data[$uni?->id][$college?->id] = $college?->name;
            }
        }
        return view('major.edit', ['major' => $major, 'unis' => $unis, 'data' => $data]);
    }
    public function update(Request $request)
    {
        $muc = major_uni_college::find($request->row_id);
        $muc->delete();
        if ($request->uni_ids) {
            foreach ($request->uni_ids as $uniId) {
                major_uni_college::create([
                    'major_id' => $request->major_id,
                    'uni_id' => $uniId,
                    'college_id' => $request[$uniId]
                ]);
            }
        }
        return redirect('/majors/list');
    }
    public function delete($id)
    {
        $maj_uni_coll = major_uni_college::find($id);
        $midd_student_ucm = midd_student_ucm::where('ucm_id', $maj_uni_coll?->id)->get();
        student::find($midd_student_ucm[0]?->student_id)?->delete();
        term::where('student_id', $midd_student_ucm[0]?->student_id)->delete();
        $midd_student_ucm[0]?->delete();
        $maj_uni_coll?->delete();
        $mucs = major_uni_college::where('major_id', $maj_uni_coll->major_id)->get();
        if (count($mucs) == 0) {
            $major = major::find($maj_uni_coll->major_id);
            $major?->delete();
        }
        $midd_lessons = midd_lesson::where('midd_id', $id)->get();
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
        return redirect('/majors/list');
    }
    public function majorInfo($id)
    {
        $lessons = [];
        $midd_lessons = midd_lesson::where('midd_id', $id)->get();
        foreach ($midd_lessons as $midd_lesson) {
            $lesson = lesson::find($midd_lesson->lesson_id);
            $lessons[] = $lesson->name;
        }
        return view('major.majorInfo', ['lessons' => $lessons]);
    }
}
