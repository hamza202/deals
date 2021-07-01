<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>  Money Reports</title>
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
<h2>العمولات
</h2>
<hr>
<h4>Count of Commissions accept is : {{$data1}} </h4>
<h4>Total amount of Commissions accept is : {{$total}} </h4>
<hr>
<table style="width: 100%" >


    <thead>
    <tr>
        <td><b>Bank Name </b></td>
        <td><b>Name </b></td>
        <td><b> Email </b></td>
        <td><b> Phone </b></td>
        <td><b> Value </b></td>
        <td><b> Advertising  </b></td>

    </tr>
    </thead>
    <tbody>
@isset($rows)
    @foreach($rows as $row)
    <tr>
        <td>
            {{$row -> bank_name}}
        </td>
        <td>
            {{$row ->  name}}
        </td>
        <td>
            {{$row ->  email}}
        </td>
        <td>
            {{$row -> phone}}
        </td>
        <td>
            {{$row -> money}}
        </td>
        <td>
            {{$row -> advertising -> title}}
        </td>
    </tr>
  @endforeach
    @endisset
    </tbody>
</table>
</body>
</html>
