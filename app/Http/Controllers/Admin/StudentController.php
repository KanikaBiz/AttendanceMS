<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public $updateMode = false;

    public $prefix = 'student_';

    public $crudRoutePath = 'students';

    public function __construct()
    {
      // Apply middleware to check permissions
      $this->middleware(function ($request, $next) {
        // Map the prefix and actions to specific Gate permissions
        $action = $request->route()->getActionMethod();
        $permission = match ($action) {
          'index' => $this->prefix . 'access',
          'store' => $this->prefix . 'create',
          'edit', 'update', 'changeStatus' => $this->prefix . 'edit',
          'destroy' => $this->prefix . 'delete',
          default => null,
        };

        if ($permission && Gate::denies($permission)) {
          abort(Response::HTTP_FORBIDDEN, '403, No Permission Authorization');
        }

        return $next($request);
      });
    }
    /**
     * Display a listing of the resource.
     */
public function index()
    {
        $data['prefix'] = $this->prefix;
        $data['crudRoutePath'] = $this->crudRoutePath;
        $data['updateMode'] = $this->updateMode;
        $data['roles'] = Role::pluck('title', 'id');
        $data['users'] = User::where('id', '>', 1)
            ->whereHas('roles', function ($query) {
                $query->where('title', 'Student');
            })->latest()->get();

        return view('admin.student.index', $data);
    }

    public function create()
    {
        $data['prefix'] = $this->prefix;
        $data['crudRoutePath'] = $this->crudRoutePath;
        $data['updateMode'] = $this->updateMode;
        $data['roles'] = Role::pluck('title', 'id');

        return view('admin.student.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'user_status' => 'boolean',
        ]);

        $data = $request->only(['name', 'username', 'email', 'phone_no']);
        $data['password'] = Hash::make($request->password);
        $data['status'] =  $request->status ? 1 : 0;

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $image_name = $request->username . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user'), $image_name);
            $data['profile_image'] = $image_name;
        }

        $user = User::create($data);
        $user->roles()->attach(3); // Student role ID = 3

        return redirect()
            ->route('admin.students.index')
            ->with('success', __('Student created successfully.'));
    }

    public function edit(string $id)
    {
        $data['prefix'] = $this->prefix;
        $data['crudRoutePath'] = $this->crudRoutePath;
        $data['updateMode'] = true;
        $data['user'] = User::findOrFail($id);

        if (!$data['user']) {
            return redirect()->route('admin.students.index')->with('error', 'Student not found.');
        }

        return view('admin.student.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_no' => 'required|string',
            'password' => 'nullable|string|confirmed|min:8',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'boolean',
            'old_image' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'username', 'email', 'phone_no']);
        $data['status'] =  $request->status ? 1 : 0;

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            if ($request->old_image && File::exists(public_path('uploads/user/' . $request->old_image))) {
                File::delete(public_path('uploads/user/' . $request->old_image));
            }

            $file = $request->file('profile_image');
            $image_name = $request->username . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/user'), $image_name);
            $data['profile_image'] = $image_name;
        } else {
            $data['profile_image'] = $request->old_image;
        }

        $user->update($data);

        return redirect()
            ->route('admin.students.index')
            ->with('success', __('Student updated successfully.'));
    }

    public function destroy(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($user->profile_image && File::exists(public_path('uploads/user/' . $user->profile_image))) {
            File::delete(public_path('uploads/user/' . $user->profile_image));
        }

        $user->roles()->detach();
        $user->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => __('Teacher deleted successfully.')]);
        }

        return redirect()
            ->route('admin.students.index')
            ->with('success', __('Teacher deleted successfully.'));
    }
    public function changeStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status ? 1 : 0;
        $user->save();

        return response()->json(['success' => true, 'message' => __('Status updated successfully.')]);
    }
}
