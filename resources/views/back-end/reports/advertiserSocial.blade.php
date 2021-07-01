<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title> Users Social Reports</title>
    <style>

        * {
            font-family: dejavu sans;
        }


        body {
            background: #FFF;
            font-family: dejavu sans;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

<table style="width: 100%">
    <h1>احصائيات طريقة معرفة الموقع</h1>
    <thead>
    <tr>
        <td><b>Social </b></td>
        <td><b> Count </b></td>
    </tr>
    </thead>
    <tbody>

    @php
        $know_us = App\Models\KnowUs::all();
    @endphp
    @if(isset($know_us))
        @foreach ($know_us as $new)
            @php
                $data_new = App\Models\Advertiser::where('know_us', $new->id)
               ->whereBetween('created_at', [$from, $to])
               ->count();
            @endphp
            <tr>
                <td>
                    {{$new -> name}}
                </td>
                <td>
                    {{$data_new}}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
</body>
</html>
