@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Manage Translations</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('translations.update') }}" method="POST">
        @csrf
        @foreach($languages as $lang)
            <h2>{{ strtoupper($lang) }} Translations</h2>
            <div class="form-group">
                <textarea name="translations[{{ $lang }}]" rows="10" class="form-control">{{ json_encode($translations[$lang], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</textarea>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Update Translations</button>
    </form>
</div>
@endsection
