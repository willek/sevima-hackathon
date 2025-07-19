@extends('components.layout.main')

@section('content')
    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <div class="flex justify-between">
            <span>Hello, {{ auth()->user()->name }}</span>

            <span class="bg-indigo-100 text-indigo-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-indigo-900 dark:text-indigo-300">{{ auth()->user()->main_role }}</span>
        </div>
    </div>
@endsection
