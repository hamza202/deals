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


<h2>Active & Not Active Users</h2>

<table style="width:100%">
    <caption>percentage Active </caption>
    <tr>
        <th>Active</th>
        <th>Not Active</th>
    </tr>
    <tr>
        <td>{{$percent_active}}%</td>
        <td>{{$percent_not_active}}%</td>
    </tr>
</table>



<table style="width: 100%" >
    <caption> Active Users</caption>

    <thead>
    <tr>
        <td><b>Name </b></td>
        <td><b> Phone </b></td>
        <td><b>  Email </b></td>
        <td><b>  last login </b></td>


    </tr>
    </thead>
    <tbody>
    @foreach($active as $dataa)
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

        <td>
            {{$dataa->last_login}}
        </td>
    </tr>
        @endforeach
    </tbody>
</table>



<table style="width: 100%" >
    <caption>Not Active Users</caption>

    <thead>
    <tr>
        <td><b>Name </b></td>
        <td><b> Phone </b></td>
        <td><b>  Email </b></td>
        <td><b>  last login </b></td>


    </tr>
    </thead>
    <tbody>
    @foreach($not_active as $dataa)
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

        <td>
            {{$dataa->last_login}}
        </td>
    </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
