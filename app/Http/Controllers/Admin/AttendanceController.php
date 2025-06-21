<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClassSchedule;
use App\Models\ClassSubject;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AttendanceController extends Controller
{
    public $prefix = 'attendance_';
    public $crudRoutePath = 'attendances';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $action = $request->route()->getActionMethod();
            $permission = match ($action) {
                'index' => $this->prefix . 'access',
                'create', 'store' => $this->prefix . 'create',
                'edit', 'update' => $this->prefix . 'edit',
                'destroy' => $this->prefix . 'delete',
                default => null,
            };

            if ($permission && Gate::denies($permission)) {
                abort(Response::HTTP_FORBIDDEN, '403, No Permission Authorization');
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = ClassSchedule::with(['subjects.attendances' => function ($q) use ($request) {
            if ($request->filled('date')) {
                $q->where('attendance_date', $request->date);
            }
        }]);

        if ($request->filled('class_id')) {
            $query->where('id', $request->class_id);
        }

        if ($request->filled('subject_id')) {
            $query->whereHas('subjects', function ($q) use ($request) {
                $q->where('id', $request->subject_id);
            });
        }

        $schedules = $query->get();

        if ($request->ajax()) {
            return response()->json(['schedules' => $schedules->map(function ($schedule) {
                $schedule->subjects->each(function ($subject) {
                    $subject->attendances->each(function ($attendance) {
                        $attendance->student = $attendance->student; // Ensure student relation is loaded
                    });
                });
                return $schedule;
            })]);
        }

        $data['schedules'] = $schedules;
        $data['prefix'] = $this->prefix;
        $data['crudRoutePath'] = $this->crudRoutePath;

        return view('admin.attendance.index', $data);
    }

    public function create()
    {
        $data['schedules'] = ClassSchedule::with('subjects')->get();
        $data['students'] = User::whereHas('roles', function ($query) {
            $query->where('title', 'Student');
        })->pluck('name', 'id');
        return view('admin.attendance.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_subject_id' => 'required|exists:class_subjects,id',
            'attendance_date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*.student_id' => 'required|exists:users,id',
            'attendances.*.status' => 'required|in:present,absent,late',
            'attendances.*.remarks' => 'nullable|string',
        ]);

        $classSubjectId = $request->input('class_subject_id');
        $attendanceDate = $request->input('attendance_date');
        $attendances = $request->input('attendances');

        foreach ($attendances as $attendance) {
            Attendance::updateOrCreate(
                [
                    'class_subject_id' => $classSubjectId,
                    'student_id' => $attendance['student_id'],
                    'attendance_date' => $attendanceDate,
                ],
                [
                    'status' => $attendance['status'],
                    'remarks' => $attendance['remarks'],
                ]
            );
        }

        return redirect()
            ->route('admin.attendances.index')
            ->with('success', __('Attendance recorded successfully.'));
    }

    public function edit($id)
    {
        $data['attendance'] = Attendance::with('classSubject.classSchedule', 'student')->findOrFail($id);
        $data['students'] = User::whereHas('roles', function ($query) {
            $query->where('title', 'Student');
        })->pluck('name', 'id');
        return view('admin.attendance.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        $request->validate([
            'status' => 'required|in:present,absent,late',
            'remarks' => 'nullable|string',
        ]);

        $attendance->update($request->only(['status', 'remarks']));

        return redirect()
            ->route('admin.attendances.index')
            ->with('success', __('Attendance updated successfully.'));
    }

    public function destroy(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => __('Attendance deleted successfully.')]);
        }

        return redirect()
            ->route('admin.attendances.index')
            ->with('success', __('Attendance deleted successfully.'));
    }
}
