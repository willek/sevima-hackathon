<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <h3>{{ $user->name }} - {{ $user->email }}</h3>
        <table border="1px" style="table-layout:fixed; width:100%; margin-top: 10px">
            <thead>
                <tr>
                    <th style="width:5%;">
                        #
                    </th>
                    <th style="width:20%;">
                        Date
                    </th>
                    <th style="width:15%;">
                        Office
                    </th>
                    <th style="width:20%;">
                        Clock In
                    </th>
                    <th style="width:20%;">
                        Clock Out
                    </th>
                    <th style="width:20%;">
                        Location
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($user->attendances as $key => $value)
                    <tr>
                        <td style="text-align:center; width:5%;">
                            {{ $loop->iteration }}
                        </td>
                        <td style="text-align:center; width:20%;">
                            {{ $value->date }}
                        </td>
                        <td style="text-align:center; width:15%;">
                            {{ $value->office->name }}
                        </td>
                        <td style="text-align:center; width:20%;">
                            {{ $value->clock_in }}
                        </td>
                        <td style="text-align:center; width:20%;">
                            {{ $value->clock_out }}
                        </td>
                        <td style="text-align:center; width:20%;">
                            {{ $value->lat }},
                            <br>
                            {{ $value->lng }}
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </body>

</html>
