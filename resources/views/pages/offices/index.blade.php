@extends('components.layout.main')

@section('content')
    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <div class="relative overflow-x-auto">
            <div class="border-b mb-4 pb-4 flex justify-between">
                <h1 class="my-auto">Offices</h1>
                <a href="{{ route('offices.create') }}">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Create
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
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Location
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lng
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offices as $key => $value)
                        <tr class="font-medium text-gray-900 whitespace-nowrap">
                            <td class="px-6 py-4 ">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $value->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $value->location }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $value->lat }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $value->lng }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    <a href="{{ route('qr.generate', $value->id) }}">
                                        <button type="button" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800">
                                            QRCode
                                        </button>
                                    </a>
                                    <a href="{{ route('offices.edit', $value->id) }}">
                                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            Edit
                                        </button>
                                    </a>
                                    {{-- <form action="{{ route('offices.destroy', $value->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                            Delete
                                        </button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
