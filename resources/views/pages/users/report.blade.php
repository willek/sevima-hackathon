@extends('components.layout.main')

@section('content')
    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <div class="relative overflow-x-auto">
            <div class="border-b mb-4 pb-4 flex justify-between">
                <h1 class="my-auto">User Attendances</h1>

                <a href="{{ route('users.pdf', $user->id) }}">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Download PDF
                    </button>
                </a>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Office
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clock In
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clock Out
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Location
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user->attendances as $key => $value)
                    <tr class="font-medium text-gray-900 whitespace-nowrap">
                        <td class="px-6 py-4 ">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $value->date }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $value->office->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $value->clock_in }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $value->clock_out }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $value->lat }},{{ $value->lng }}
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center">
                        <td colspan="6">No Data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
