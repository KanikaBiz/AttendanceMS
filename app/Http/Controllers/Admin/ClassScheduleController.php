<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClassSchedule;
use App\Models\User; // Assuming teachers are from the User model
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ClassScheduleController extends Controller
{
    public $prefix = 'class_schedule_';
    public $crudRoutePath = 'class-schedules';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $action = $request->route()->getActionMethod();
            $permission = match ($action) {
                'index' => $this->prefix . 'access',
                'store', 'create' => $this->prefix . 'create',
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

    public function index()
    {
        $data['schedules'] = ClassSchedule::with('subjects')->get();
        return view('admin.class-schedule.index', $data);
    }

    public function create()
    {
        $data['teachers'] = User::whereHas('roles', function ($query) {
            $query->where('title', 'Teacher');
        })->pluck('name', 'id');
        return view('admin.class-schedule.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'class_code' => 'required|string|unique:class_schedules,class_code',
            'semester' => 'required|string|max:50',
            'class_description' => 'nullable|string',
            'subjects' => 'required|array',
            'subjects.*.subject_code' => 'required|string|max:10',
            'subjects.*.subject_name' => 'required|string|max:255',
            'subjects.*.teacher_id' => 'required|exists:users,id',
            'subjects.*.day' => 'required|in:Monday,Tue,Wed,Thu,Fri,Sat,Sun',
            'subjects.*.total_credit' => 'required|integer|min:1|max:10',
        ]);

        $schedule = ClassSchedule::create($request->only(['class_name', 'class_code', 'semester', 'class_description']));
        $schedule->subjects()->createMany($request->input('subjects'));

        return redirect()
            ->route('admin.class-schedules.index')
            ->with('success', __('Class schedule created successfully.'));
    }

    public function edit($id)
    {
        $data['schedule'] = ClassSchedule::with('subjects')->findOrFail($id);
        $data['teachers'] = User::whereHas('roles', function ($query) {
            $query->where('title', 'Teacher');
        })->pluck('name', 'id');
        return view('admin.class-schedule.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $schedule = ClassSchedule::findOrFail($id);

        $request->validate([
            'class_name' => 'required|string|max:255',
            'class_code' => 'required|string|unique:class_schedules,class_code,' . $schedule->id,
            'semester' => 'required|string|max:50',
            'class_description' => 'nullable|string',
            'subjects' => 'required|array',
            'subjects.*.subject_code' => 'required|string|max:10',
            'subjects.*.subject_name' => 'required|string|max:255',
            'subjects.*.teacher_id' => 'required|exists:users,id',
            'subjects.*.day' => 'required|in:Monday,Tue,Wed,Thu,Fri,Sat,Sun',
            'subjects.*.total_credit' => 'required|integer|min:1|max:10',
        ]);

        $schedule->update($request->only(['class_name', 'class_code', 'semester', 'class_description']));
        $schedule->subjects()->delete();
        $schedule->subjects()->createMany($request->input('subjects'));

        return redirect()
            ->route('admin.class-schedules.index')
            ->with('success', __('Class schedule updated successfully.'));
    }

    public function destroy($id)
    {
        $schedule = ClassSchedule::findOrFail($id);
        $schedule->subjects()->delete();
        $schedule->delete();

        return redirect()
            ->route('admin.class-schedules.index')
            ->with('success', __('Class schedule deleted successfully.'));
    }
}
