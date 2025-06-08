<?php

namespace App\Http\Controllers\Admin;

use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SemesterController extends Controller
{
    public $updateMode = false;
    public $prefix = 'semester_';
    public $crudRoutePath = 'semesters';
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
         // abort_if(Gate::denies($this->prefix . 'access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['prefix'] = $this->prefix;
        $data['crudRoutePath'] = $this->crudRoutePath;
        $data['updateMode'] = $this->updateMode;

        // get years
        $data['years'] = \App\Models\Year::latest()->get();
        // Fetch all semesters
        $data['semesters'] = \App\Models\Semester::latest()->get();

        return view('admin.semester.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $object_id = $request->object_id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'year_id' => 'required|exists:years,id',
        ], [
            'name.required' => 'The name field is required.',
            'year_id.required' => 'The year field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data = Semester::updateOrCreate(
            ['id' => $object_id],
            [
                'name' => $request->name,
                'year_id' => $request->year_id,
                'status' => true
            ]
        );

        return response()->json([
            'status' => 200,
            'type' => $object_id ? 'update-object' : 'store-object',
            'success' => $object_id ? 'Semester has been updated!' : 'Semester has been created!',
            'data' => $data,
            'html' => view('admin.semester.templates.ajax_tr', [
                'row' => $data,
                'prefix' => $this->prefix,
                'crudRoutePath' => $this->crudRoutePath
            ])->render(),
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $semester = Semester::findOrFail($id);
        return response()->json($semester);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $semester = Semester::findOrFail($id);
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'year_id' => 'required|exists:years,id',
        // ], [
        //     'name.required' => 'The name field is required.',
        //     'year_id.required' => 'The year field is required.',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 400,
        //         'error' => $validator->errors()->toArray()
        //     ]);
        // }

        // $semester->name = $request->name;
        // $semester->year_id = $request->year_id;
        // $semester->status = $request->status ?? 'active'; // Default to 'active' if not provided
        // $semester->save();

        // return response()->json(['status' => 200, 'success' => 'Semester updated successfully!', 'data' => $semester]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function changeStatus(Request $request)
    {
        $response = Semester::find($request->object_id);
        if(!$response) {
            return response()->json(['status' => 400, 'error' => 'Semester not found']);
        }
        $response->status = $request->status;
        $response->save();
        return response()->json(['success' => 'Status has been change successfully!']);
    }
}
