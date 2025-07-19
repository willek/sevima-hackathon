@extends('components.layout.main')

@section('content')
<div class="space-y-6">
    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <div class="flex justify-between">
            <span>Hello, {{ auth()->user()->name }}</span>

            <span class="bg-indigo-100 text-indigo-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-indigo-900 dark:text-indigo-300">{{ auth()->user()->main_role }}</span>
        </div>
    </div>

    @if(!auth()->user()->todayAttendance()?->clock_in || !auth()->user()->todayAttendance()?->clock_out)
    <a href="{{ route('qr.scan') }}">
        <div class="text-center block py-12 text-2xl bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <span>Scan Here</span>
        </div>
    </a>
    @endif

    <div class="grid grid-cols-2 gap-4 mt-4">
        <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h1>Today Clock In</h1>
            <p>
                @if(auth()->user()->todayAttendance()?->clock_in)
                {{ auth()->user()->todayAttendance()->clock_in_formatted }}
                @else
                -
                @endif
            </p>
        </div>

        <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h1>Today Clock Out</h1>
            <p>
                @if(auth()->user()->todayAttendance()?->clock_out)
                {{ auth()->user()->todayAttendance()->clock_out_formatted }}
                @else
                -
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
