<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\Attendance;
use App\Models\ClassSubjectTeacher;
use App\Models\SubjectTeacher;
use App\Models\ClassStudent;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $classes = ClassModel::where('status', 1)->get();
        $students = collect();
        if ($request->class_id && $request->attendance_date) {
            $students = User::whereIn('id', ClassStudent::where('class_id', $request->class_id)->pluck('student_id'))
                ->get()
                ->map(function ($student) use ($request) {
                    $attendance = Attendance::where('student_id', $student->id)
                        ->where('class_id', $request->class_id)
                        ->whereDate('attendance_date', $request->attendance_date)
                        ->first();
                    $student->attendance_status = $attendance ? $attendance->status : 'present';
                    return $student;
                });
        }
        return view('admin.attendance.index', compact('classes', 'students'));
    }

    public function getTeachers(Request $request)
    {
        $teachers = User::whereIn('id', SubjectTeacher::whereIn('id',
            ClassSubjectTeacher::where('class_id', $request->class_id)->pluck('subject_teacher_id'))
            ->pluck('teacher_id'))->get(['id', 'name']);
        return response()->json(['teachers' => $teachers]);
    }

    public function getSubjects(Request $request)
    {
        $subjects = SubjectTeacher::where('teacher_id', $request->teacher_id)
            ->whereIn('id', ClassSubjectTeacher::where('class_id', $request->class_id)->pluck('subject_teacher_id'))
            ->with('subject')
            ->get()
            ->map(function ($subjectTeacher) {
                return [
                    'id' => $subjectTeacher->subject->id,
                    'name' => $subjectTeacher->subject->name,
                    'subject_teacher_id' => $subjectTeacher->id,
                ];
            });
        return response()->json(['subjects' => $subjects]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            // 'subject_teacher_id' => 'required|exists:class_subject_teachers,id',
            // 'attendance_date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'in:present,absent,late',
        ]);

        foreach ($request->attendance as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'class_id' => $request->class_id,
                    'subject_teacher_id' => 2,//$request->subject_teacher_id,
                    'student_id' => $studentId,
                    'attendance_date' => $request->attendance_date,
                ],
                ['status' => $status]
            );
        }

        return response()->json(['success' => 'Attendance saved successfully']);
    }
}
