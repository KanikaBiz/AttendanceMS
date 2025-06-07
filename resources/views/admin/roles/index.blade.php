@extends('layouts.master_lte')
@section('title', 'Roles Management')
@section('content')
    <h1>Roles Management</h1>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create Role</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
