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

class TeacherController extends Controller
{
    public function create()
    {
        $ucs = uni_college::all();
        $unis = [];
        foreach ($ucs as $uc) {
            $mucs = major_uni_college::where('uni_id', $uc?->uni_id)->where('college_id', $uc?->college_id)->get();
            foreach ($mucs as $muc) {
                $midd_lessons = midd_lesson::where('midd_id', $muc->id)->get();
                foreach ($midd_lessons as $midd_lesson) {
                    $unis[$muc->uni_id]['uniData'] = university::find($muc->uni_id);
                    $unis[$muc->uni_id]['colleges'][$muc->college_id]['collegeData'] = college::find($muc->college_id);
                    $unis[$muc->uni_id]['colleges'][$muc->college_id]['majors'][$muc->id]['majorData'] = major::find($muc->major_id);
                    $unis[$muc->uni_id]['colleges'][$muc->college_id]['majors'][$muc->id]['lessons'][] = lesson::find($midd_lesson->lesson_id);
                }
            }
        }
        return view('teacher.create', ['unis' => $unis]);
    }
    public function store(Request $request)
    {
        $teacherId = teacher::insertGetId([
            'name' => $request->name
        ]);
        if ($request->lessons) {
            foreach ($request->lessons as $rowId => $lessonIds) {
                foreach ($lessonIds as $lessonId) {
                    $midd_lessons = midd_lesson::where('midd_id', $rowId)->where('lesson_id', $lessonId)->get();
                    foreach ($midd_lessons as $midd_lesson) {
                        midd_teacher::create([
                            'teacher_id' => $teacherId,
                            'midd_lesson_id' => $midd_lesson->id
                        ]);
                    }
                }
            }
        }
        return redirect('teachers/list');
    }
    public function index()
    {
        $data = [];
        $midd_teachers = midd_teacher::all();
        foreach ($midd_teachers as $midd_teacher) {
            $midd_lesson = midd_lesson::find($midd_teacher?->midd_lesson_id);
            $teacher = teacher::find($midd_teacher?->teacher_id);
            $lesson = lesson::find($midd_lesson?->lesson_id);
            $muc = major_uni_college::find($midd_lesson?->midd_id);
            $major = major::find($muc?->major_id);
            $college = college::find($muc?->college_id);
            $uni = university::find($muc?->uni_id);
            $data[] = ['teacher' => $teacher, 'lesson' => $lesson, 'major' => $major, 'college' => $college, 'uni' => $uni, 'rowId' => $midd_lesson?->id];
        }
        return view('teacher.index', ['data' => $data]);
    }
    public function show($teacherId, $rowId)
    {
        $midd_teachers = midd_teacher::where('teacher_id', $teacherId)->where('midd_lesson_id', $rowId)->get();
        foreach ($midd_teachers as $midd_teacher) {
            $teacher = teacher::find($midd_teacher->teacher_id);
            $midd_lesson = midd_lesson::find($midd_teacher->midd_lesson_id);
            $lesson = lesson::find($midd_lesson->lesson_id);
            $muc = major_uni_college::find($midd_lesson->midd_id);
            $major = major::find($muc->major_id);
            $college = college::find($muc->college_id);
            $uni = university::find($muc->uni_id);
            $data = ['teacher' => $teacher, 'lesson' => $lesson, 'major' => $major, 'college' => $college, 'uni' => $uni];
        }
        return view('teacher.show', ['data' => $data]);
    }
    public function edit($teacherId, $rowId)
    {
        $teacher = teacher::find($teacherId);
        $data = ['teacher' => $teacher, 'middLessonId' => $rowId];
        $ucs = uni_college::all();
        $unis = [];
        foreach ($ucs as $uc) {
            $mucs = major_uni_college::where('uni_id', $uc?->uni_id)->where('college_id', $uc?->college_id)->get();
            foreach ($mucs as $muc) {
                $midd_lessons = midd_lesson::where('midd_id', $muc->id)->get();
                foreach ($midd_lessons as $midd_lesson) {
                    $unis[$muc->uni_id]['uniData'] = university::find($muc->uni_id);
                    $unis[$muc->uni_id]['colleges'][$muc->college_id]['collegeData'] = college::find($muc->college_id);
                    $unis[$muc->uni_id]['colleges'][$muc->college_id]['majors'][$muc->id]['majorData'] = major::find($muc->major_id);
                    $unis[$muc->uni_id]['colleges'][$muc->college_id]['majors'][$muc->id]['lessons'][$midd_lesson->id] = lesson::find($midd_lesson->lesson_id);
                }
            }
        }
        return view('teacher.edit', ['unis' => $unis, 'data' => $data]);
    }
    public function update(Request $request)
    {
        $teacher = teacher::find($request->teacher_id);
        $teacher->name = $request->name;
        $teacher->save();
        midd_teacher::where('teacher_id', $request->teacher_id)->where('midd_lesson_id', $request->midd_lesson_id)->delete();
        if ($request->middLessons) {
            foreach ($request->middLessons as $middLessonId) {
                midd_teacher::create([
                    'teacher_id' => $request->teacher_id,
                    'midd_lesson_id' => $middLessonId
                ]);
            }
        }
        return redirect('teachers/list');
    }
    public function delete($teacherId, $rowId)
    {
        $midd_teachers = midd_teacher::where('teacher_id', $teacherId)->where('midd_lesson_id', $rowId)->get();
        foreach ($midd_teachers as $midd_teacher) {
            studentLessons::where('midd_teacher_id', $midd_teacher->id)->delete();
            $midd_teacher->delete();
        }
        $mts = midd_teacher::where('teacher_id', $teacherId)->get();
        if (count($mts) == 0) {
            $teacher = teacher::find($teacherId);
            $teacher->delete();
        }
        return redirect('teachers/list');
    }
}
