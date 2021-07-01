<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title> Visitors And Users Reports</title>
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
<h2>احصائيات زوار الموقع / اعضاء الموقع</h2>

<table style="width: 100%">


    <thead>
    <tr>
        <td><b>Type </b></td>
        <td><b> Count </b></td>
    </tr>
    </thead>
    <tbody>

    <tr>

        <td>
            Users
        </td>
        <td>
            {{$data1}}
        </td>
    </tr>
    <tr>

        <td>
            Visitors
        </td>
        <td>
            {{$data2}}
        </td>
    </tr>

    </tbody>
</table>
</body>
</html>
