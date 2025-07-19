@extends('components.layout.main')

@section('content')
    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <div class="relative overflow-x-auto">
            Hello, {{ auth()->user()->name }}
        </div>
    </div>
@endsection
