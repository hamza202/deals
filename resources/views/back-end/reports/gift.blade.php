<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>  Gift Reports</title>
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
<h2>الهدايا</h2>
<hr>
<h4>Count of Gifts accept is : {{$data1}} Gifts</h4>
<hr>
<table style="width: 100%" >


    <thead>
    <tr>
        <td><b>Name </b></td>
        <td><b> Gift </b></td>
        <td><b> Address </b></td>
        <td><b> Email </b></td>
        <td><b> Phone </b></td>
        <td><b> Date of Accept </b></td>
    </tr>
    </thead>
    <tbody>
@isset($rows)
    @foreach($rows as $row)
    <tr>
        <td>
            {{$row -> advertiser -> name}}
        </td>
        <td>
            {{$row -> gift -> name}}
        </td>
        <td>
            {{$row -> address}}
        </td>
        <td>
            {{$row -> advertiser -> email}}
        </td>
        <td>
            {{$row -> advertiser -> phone}}
        </td>
        <td>
            {{$row -> updated_at}}
        </td>
    </tr>
  @endforeach
    @endisset
    </tbody>
</table>
</body>
</html>
