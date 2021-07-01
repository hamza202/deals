<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>  Users Reports</title>
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
<h3>احصائيات المسجلين فى الموقع</h3>
<table style="width: 100%" >
    <thead>
    <tr>
        <td><b>Name </b></td>
        <td><b> Phone </b></td>
        <td><b>  Email </b></td>


    </tr>
    </thead>
    <tbody>
    @foreach($data as $dataa)
    <tr>


        <td>
            {{$dataa->name}}
        </td>

        <td>
            {{$dataa->phone}}
        </td>


        <td>
            {{$dataa->email}}
        </td>
    </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
