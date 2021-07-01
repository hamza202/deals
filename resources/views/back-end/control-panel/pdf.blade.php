<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>امر تدلل</title>
    <style>

        * { font-family:  dejavu sans; }


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

    <table style="width: 100%;">
    <thead>
    <tr>
        <td><b>اقصى عدد للاشتراك</b></td>
        <td><b>النقاط</b></td>
        <td><b>النشاط</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach($points as $point)
    <tr>
        <td>
            {{$point->total_subscriptions}}
        </td>
        <td>
            {{$point->num_points}}
        </td>
        <td>
            {{$point->activity}}
        </td>
    </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
