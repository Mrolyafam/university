<?php

namespace App\Http\Controllers;

use App\Models\college;
use App\Models\lesson;
use App\Models\major;
use App\Models\major_uni_college;
use App\Models\midd_lesson;
use App\Models\midd_teacher;
use App\Models\studentLessons;
use App\Models\teacher;
use App\Models\uni_college;
use App\Models\university;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function create()
    {
        $ucs = uni_college::all();
        $unis = [];
        foreach ($ucs as $uc) {
            $mucs = major_uni_college::where('uni_id', $uc?->uni_id)->where('college_id', $uc?->college_id)->get();
            foreach ($mucs as $muc) {
                $unis[$muc->uni_id]['uniData'] = university::find($muc->uni_id);
                $unis[$muc->uni_id]['colleges'][$muc->college_id]['collegeData'] = college::find($muc->college_id);
                $unis[$muc->uni_id]['colleges'][$muc->college_id]['majors'][$muc->id] = major::find($muc->major_id);
            }
        }
        return view('lesson.create', ['unis' => $unis]);
    }
    public function store(Request $request)
    {
        $lessonId = lesson::insertGetId([
            'name' => $request->name,
            'unit' => $request->unit,
            'term' => $request->term
        ]);
        foreach ($request->rows as $rowId) {
            midd_lesson::create([
                'midd_id' => $rowId,
                'lesson_id' => $lessonId
            ]);
        }
        return redirect('/lessons/list');
    }
    public function index()
    {
        $ucs = uni_college::all();
        $data = [];
        foreach ($ucs as $uc) {
            $uni = university::find($uc->uni_id);
            $college = college::find($uc->college_id);
            $mucs = major_uni_college::where('uni_id', $uni?->id)->where('college_id', $college?->id)->get();
            foreach ($mucs as $muc) {
                $major = major::find($muc->major_id);
                $midd_lessons = midd_lesson::where('midd_id', $muc->id)->get();
                foreach ($midd_lessons as $midd_lesson) {
                    $lesson = lesson::find($midd_lesson->lesson_id);
                    $data[] = ['lesson' => $lesson, 'rowId' => $muc->id, 'major' => $major?->name, 'college' => $college?->name, 'uni' => $uni?->name . " " . $uni?->city];
                }
            }
        }
        return view('lesson.index', ['data' => $data]);
    }
    public function show($lessonId, $rowId)
    {
        $muc = major_uni_college::find($rowId);
        $lesson = lesson::find($lessonId);
        $major = major::find($muc->major_id);
        $college = college::find($muc->college_id);
        $uni = university::find($muc->uni_id);
        $data = ['lesson' => $lesson, 'major' => $major->name, 'college' => $college->name, 'uni' => $uni->name . " " . $uni->city];
        return view('lesson.show', ['data' => $data]);
    }
    public function edit($lessonId, $rowId)
    {
        $lesson = lesson::find($lessonId);
        $ucs = uni_college::all();
        foreach ($ucs as $uc) {
            $mucs = major_uni_college::where('uni_id', $uc->uni_id)->where('college_id', $uc->college_id)->get();
            foreach ($mucs as $muc) {
                $unis[$muc->uni_id]['uniData'] = university::find($muc->uni_id);
                $unis[$muc->uni_id]['colleges'][$muc->college_id]['collegeData'] = college::find($muc->college_id);
                $unis[$muc->uni_id]['colleges'][$muc->college_id]['majors'][$muc->id] = major::find($muc->major_id);
            }
        }
        return view('lesson.edit', ['unis' => $unis, 'lesson' => $lesson, 'row_id' =>  $rowId]);
    }
    public function update(Request $request)
    {
        $midd_lesson = midd_lesson::where('midd_id', $request->row_id)->where('lesson_id', $request->lesson_id)->get();
        foreach ($midd_lesson as $midd_lesson_row) {
            $midd_lesson_row->delete();
        }
        if ($request->row_ids) {
            foreach ($request->row_ids as $midd_id) {
                midd_lesson::create([
                    'midd_id' => $midd_id,
                    'lesson_id' => $request->lesson_id
                ]);
            }
        }
        return redirect('/lessons/list');
    }
    public function delete($lessonId, $rowId)
    {
        $midd_lesson = midd_lesson::where('midd_id', $rowId)->where('lesson_id', $lessonId)->get();
        foreach ($midd_lesson as $midd_lesson_row) {
            studentLessons::where('midd_lesson_id', $midd_lesson_row->id)->delete();
            $mts = midd_teacher::where('midd_lesson_id', $midd_lesson_row->id)->get();
            foreach ($mts as $mt) {
                $mt?->delete();
            }
            $midd_lesson_row?->delete();
        }
        $lessons = midd_lesson::where('lesson_id', $lessonId)->get();
        if (count($lessons) == 0) {
            $lesson = lesson::find($lessonId);
            $lesson?->delete();
        }
        return redirect('/lessons/list');
    }
}
