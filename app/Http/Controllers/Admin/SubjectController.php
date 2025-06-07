<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
      public $updateMode = false;

    public $prefix = 'subject_';

    public $crudRoutePath = 'subjects';

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

        // Fetch subjects related to classes
        $data['classes'] = \App\Models\ClassModel::latest()->get();
        // Fetch all subjects
        // Assuming you have a Subject model and it has a 'class_id' foreign key
        // Adjust the model name and relationship as per your application structure
        $data['subjects'] = \App\Models\Subject::with('class')->latest()->get();

        return view('admin.subject.index', $data);
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
