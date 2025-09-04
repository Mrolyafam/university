<?php

namespace App\Http\Controllers;

use App\Models\midd_lesson;
use App\Models\lesson;
use App\Models\student;
use App\Models\term;
use App\Models\midd_student_ucm;
use App\Models\teacher;
use App\Models\midd_teacher;
use App\Models\studentLessons;
use Illuminate\Http\Request;

class StudentLessonsController extends Controller
{
    public function create($id)
    {
        $student = student::find($id);
        if ($student->active == 1) {
            $data = [];
            $term = term::where('student_id', $id)->get();
            $midd_student_ucm = midd_student_ucm::where('student_id', $id)->get();
            $midd_lessons = midd_lesson::where('midd_id', $midd_student_ucm[0]->ucm_id)->get();
            foreach ($midd_lessons as $midd_lesson) {
                $lesson = lesson::find($midd_lesson->lesson_id);
                if ($lesson->term == $term[0]->term) {
                    $midd_teachers = midd_teacher::where('midd_lesson_id', $midd_lesson->id)->get();
                    foreach ($midd_teachers as $midd_teacher) {
                        $teacher = teacher::find($midd_teacher->teacher_id);
                        $data[$midd_lesson->id]['lesson'] = $lesson;
                        $data[$midd_lesson->id]['teachers'][$midd_teacher->id] = $teacher;
                    }
                }
            }
            return view('studentLessons.create', ['data' => $data, 'student' => $student, 'term' => $term[0]]);
        } else {
            return view('studentLessons.inactive', ['student' => $student]);
        }
    }
    public function store(Request $request)
    {
        if ($request->lessons) {
            foreach ($request->lessons as $middLessonId => $unitNum) {
                $studentLessons = studentLessons::where('stu_id', $request->student_id)->where('term', $request->term)->where('midd_lesson_id', $middLessonId)->where('unit', $unitNum)->where('midd_teacher_id', $request[$middLessonId])->get();
                if (count($studentLessons) == 0) {
                    studentLessons::create([
                        'stu_id' => $request->student_id,
                        'term' => $request->term,
                        'midd_lesson_id' => $middLessonId,
                        'unit' => $unitNum,
                        'midd_teacher_id' => $request[$middLessonId]
                    ]);
                }
            }
        }
        return redirect('/student/lesson/list/' . $request->student_id);
    }
    public function index($id)
    {
        $data = [];
        $studentLessons = studentLessons::where('stu_id', $id)->get();
        foreach ($studentLessons as $studentLesson) {
            $student = student::find($studentLesson->stu_id);
            $midd_teacher = midd_teacher::find($studentLesson->midd_teacher_id);
            $teacher = teacher::find($midd_teacher->teacher_id);
            $midd_lesson = midd_lesson::find($studentLesson->midd_lesson_id);
            $lesson = lesson::find($midd_lesson->lesson_id);
            $data[$studentLesson->term]['student'] = $student;
            $data[$studentLesson->term]['lessons'][$studentLesson->id] = ['lesson' => $lesson, 'teacher' => $teacher, 'unit' => $studentLesson->unit];
        }
        return view('studentLessons.index', ['data' => $data]);
    }
    public function addAndDrop($id)
    {
        $data = [];
        $student = student::find($id);
        $term = term::where('student_id', $id)->get();
        $midd_student_ucm = midd_student_ucm::where('student_id', $id)->get();
        $midd_lessons = midd_lesson::where('midd_id', $midd_student_ucm[0]->ucm_id)->get();
        foreach ($midd_lessons as $midd_lesson) {
            $lesson = lesson::find($midd_lesson->lesson_id);
            if ($lesson->term == $term[0]->term) {
                $midd_teachers = midd_teacher::where('midd_lesson_id', $midd_lesson->id)->get();
                foreach ($midd_teachers as $midd_teacher) {
                    $teacher = teacher::find($midd_teacher->teacher_id);
                    $data[$midd_lesson->id]['lesson'] = $lesson;
                    $data[$midd_lesson->id]['teachers'][$midd_teacher->id] = $teacher;
                }
            }
        }
        $studentLessons = studentLessons::where('stu_id', $id)->get();
        $SLessons = [];
        foreach ($studentLessons as $studentLesson) {
            $midd_lesson = midd_lesson::find($studentLesson->midd_lesson_id);
            $lesson = lesson::find($midd_lesson->lesson_id);
            $midd_teacher = midd_teacher::find($studentLesson->midd_teacher_id);
            $teacher = teacher::find($midd_teacher->teacher_id);
            $SLessons[$lesson->id] = $teacher->id;
        }
        return view('studentLessons.addAndDrop', ['data' => $data, 'student' => $student, 'term' => $term[0], 'SLessons' => $SLessons]);
    }
    public function update(Request $request)
    {
        studentLessons::where('stu_id', $request->student_id)->where('term', $request->term)->delete();
        if ($request->lessons) {
            foreach ($request->lessons as $middLessonId => $unitNum) {
                studentLessons::create([
                    'stu_id' => $request->student_id,
                    'term' => $request->term,
                    'midd_lesson_id' => $middLessonId,
                    'unit' => $unitNum,
                    'midd_teacher_id' => $request[$middLessonId]
                ]);
            }
        }
        return redirect('/student/lesson/list/' . $request->student_id);
    }
}
