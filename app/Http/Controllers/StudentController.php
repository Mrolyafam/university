<?php

namespace App\Http\Controllers;

use App\Models\approveRequest;
use App\Models\major_uni_college;
use App\Models\major;
use App\Models\university;
use App\Models\college;
use App\Models\midd_lesson;
use App\Models\midd_student_ucm;
use App\Models\student;
use App\Models\term;
use App\Models\teacher;
use App\Models\lesson;
use App\Models\midd_teacher;
use App\Models\studentLessons;
use App\Models\transferRequest;
use App\Models\uni_college;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function create()
    {
        $mucs = [];
        $uni_colleges = uni_college::all();
        foreach ($uni_colleges as $uni_college) {
            $maj_coll_unis = major_uni_college::where('uni_id', $uni_college->uni_id)->where('college_id', $uni_college->college_id)->get();
            foreach ($maj_coll_unis as $maj_coll_uni) {
                $major = major::find($maj_coll_uni->major_id);
                $college = college::find($maj_coll_uni->college_id);
                $uni = university::find($maj_coll_uni->uni_id);
                $mucs[] = ['rowId' => $maj_coll_uni?->id, 'major' => $major?->name, 'college' => $college?->name, 'uni' => $uni?->name . " " . $uni?->city];
            }
        }
        return view('student.create', ['mucs' => $mucs]);
    }
    public function store(Request $request)
    {
        $student_id = student::insertGetId([
            'name' => $request->name,
            'code' => $request->code,
            'active' => 0
        ]);
        midd_student_ucm::create([
            'student_id' => $student_id,
            'ucm_id' => $request->rowId
        ]);
        term::create([
            'student_id' => $student_id,
            'term' => 1
        ]);
        return redirect('/students/list');
    }
    public function index()
    {
        $data = [];
        $uni_colleges = uni_college::all();
        foreach ($uni_colleges as $uni_college) {
            $maj_coll_unis = major_uni_college::where('uni_id', $uni_college->uni_id)->where('college_id', $uni_college->college_id)->get();
            foreach ($maj_coll_unis as $maj_coll_uni) {
                $major = major::find($maj_coll_uni->major_id);
                $college = college::find($maj_coll_uni->college_id);
                $uni = university::find($maj_coll_uni->uni_id);
                $midd_student_ucms = midd_student_ucm::where('ucm_id', $maj_coll_uni->id)->get();
                foreach ($midd_student_ucms as $midd_student_ucm) {
                    $student = student::find($midd_student_ucm->student_id);
                    $term = term::where('student_id', $student->id)->get()->toArray();
                    $data[] = ['student' => $student, 'term' => $term[0]['term'], 'major' => $major, 'college' => $college, 'uni' => $uni];
                }
            }
        }
        return view('student.index', ['data' => $data]);
    }
    public function show($id)
    {
        $student = student::find($id);
        $term = term::where('student_id', $id)->get()->toArray();
        $midd_student_ucm = midd_student_ucm::where('student_id', $id)->get();
        $ucm = major_uni_college::find($midd_student_ucm[0]->ucm_id);
        $major = major::find($ucm->major_id);
        $college = college::find($ucm->college_id);
        $uni = university::find($ucm->uni_id);
        $data = ['student' => $student, 'term' => $term[0]['term'], 'major' => $major, 'college' => $college, 'uni' => $uni];
        return view('student.show', ['data' => $data]);
    }
    public function edit($id)
    {
        $mucs = [];
        $uni_colleges = uni_college::all();
        foreach ($uni_colleges as $uni_college) {
            $maj_coll_unis = major_uni_college::where('uni_id', $uni_college->uni_id)->where('college_id', $uni_college->college_id)->get();
            foreach ($maj_coll_unis as $maj_coll_uni) {
                $major = major::find($maj_coll_uni->major_id);
                $college = college::find($maj_coll_uni->college_id);
                $uni = university::find($maj_coll_uni->uni_id);
                $mucs[] = ['rowId' => $maj_coll_uni?->id, 'major' => $major?->name, 'college' => $college?->name, 'uni' => $uni?->name . " " . $uni?->city];
            }
        }
        $student = student::find($id);
        $midd_student_ucm = midd_student_ucm::where('student_id', $id)->get();
        $data = ['student' => $student, 'rowId' => $midd_student_ucm[0]->ucm_id];
        return view('student.edit', ['data' => $data, 'mucs' => $mucs]);
    }
    public function update(Request $request)
    {
        $student = student::find($request->id);
        $student->name = $request->name;
        $student->code = $request->code;
        $student->save();
        $midd_student_ucm = midd_student_ucm::where('student_id', $request->id)->get();
        $midd_student_ucm[0]->ucm_id = $request->rowId;
        $midd_student_ucm[0]->save();
        return redirect('/students/list');
    }
    public function delete($id)
    {
        student::find($id)->delete();
        midd_student_ucm::where('student_id', $id)->delete();
        term::where('student_id', $id)->delete();
        studentLessons::where('stu_id', $id)->delete();
        return redirect('/students/list');
    }
    public function profile()
    {
        return view('student.profile');
    }
    public function info(Request $request)
    {
        $data = [];
        $student = student::where('code', $request->code)->get();
        if (count($student) > 0) {
            $midd_student_ucm = midd_student_ucm::where('student_id', $student[0]->id)->get();
            $maj_coll_uni = major_uni_college::find($midd_student_ucm[0]->ucm_id);
            $major = major::find($maj_coll_uni->major_id);
            $college = college::find($maj_coll_uni->college_id);
            $uni = university::find($maj_coll_uni->uni_id);
            $term = term::where('student_id', $student[0]->id)->get();
            $data = ['student' => $student[0], 'term' => $term[0]->term, 'major' => $major, 'college' => $college, 'uni' => $uni];
        }
        return view('student.information', ['data' => $data]);
    }
    public function requests($id)
    {
        $student = student::find($id);
        return view('student.requests', ['student' => $student]);
    }
    public function requestStore(Request $request)
    {
        if ($request->approve) {
            approveRequest::create([
                'approve' => $request->approve,
                'stu_id' => $request->stu_id
            ]);
        }
        if ($request->transfer) {
            transferRequest::create([
                'transfer' => $request->transfer,
                'stu_id' => $request->stu_id
            ]);
        }
        return redirect('/students/list');
    }
    public function requestResult(Request $request)
    {
        foreach ($request->stu_ids as $stuId => $applies) {
            if (is_array($applies)) {
                foreach ($applies as $key => $value) {
                    if ($key == 'approve') {
                        $student = student::find($stuId);
                        $student->active = $value;
                        $student->save();
                        approveRequest::where('stu_id', $student->id)->delete();
                    }
                    // if ($key == 'transfer') {
                    // }
                }
            }
        }
        return redirect('/universities/list');
    }
}
