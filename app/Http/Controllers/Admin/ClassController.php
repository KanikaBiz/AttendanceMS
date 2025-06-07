<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ClassController extends Controller
{
  public $updateMode = false;
    public $prefix = 'class_';
    public $crudRoutePath = 'classes';
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
        // Fetch all classes
        $data['classes'] = \App\Models\ClassModel::latest()->get();
        return view('admin.classes.index', $data);
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
