<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SubjectController extends Controller
{
    public $updateMode = false;
    public $prefix = 'subject_';
    public $crudRoutePath = 'subjects';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $action = $request->route()->getActionMethod();
            $permission = match ($action) {
                'index', 'edit' => $this->prefix . 'access',
                'store' => $this->prefix . 'create',
                'update', 'changeStatus' => $this->prefix . 'edit',
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
        $data['prefix'] = $this->prefix;
        $data['crudRoutePath'] = $this->crudRoutePath;
        $data['updateMode'] = $this->updateMode;
        $data['classes'] = \App\Models\ClassModel::latest()->get();
        $data['subjects'] = Subject::with('class')->latest()->get();

        return view('admin.subject.index', $data);
    }

    public function store(Request $request)
    {
        $object_id = $request->object_id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:subjects,code,' . $object_id,
            'description' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'The name field is required.',
            'code.required' => 'The code field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data = Subject::updateOrCreate(
            ['id' => $object_id],
            [
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
                'status' => true
            ]
        );

        return response()->json([
            'status' => 200,
            'type' => $object_id ? 'update-object' : 'store-object',
            'success' => $object_id ? 'Subject has been updated!' : 'Subject has been created!',
            'data' => $data,
            'html' => view('admin.subject.templates.ajax_tr', [
                'row' => $data,
                'prefix' => $this->prefix,
                'crudRoutePath' => $this->crudRoutePath
            ])->render(),
        ]);
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return response()->json($subject);
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        if(!$subject) {
            return response()->json(['status' => 400, 'error' => 'Subject not found']);
        }
        return response()->json(['status' => 200, 'success' => 'Subject deleted successfully']);
    }

    public function changeStatus(Request $request)
    {
        $response = Subject::find($request->object_id);
        if(!$response) {
            return response()->json(['status' => 400, 'error' => 'Subject not found']);
        }
        $response->status = $request->status;
        $response->save();
        return response()->json(['success' => 'Status has been change successfully!']);
    }
}
