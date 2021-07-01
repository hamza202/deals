<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>  Category Reports</title>
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
<h2>اكثر الاقسام زيارة من العملاء</h2>
<hr>

<table style="width: 100%" >


    <thead>
    <tr>
        <td><b>Name </b></td>
        <td><b> Visits count </b></td>
    </tr>
    </thead>
    <tbody>
    @isset($rows)
        @foreach($rows as $row)
            <tr>
                <td>
                    {{$row ->  name}}
                </td>
                <td>
                    {{$row -> counter}}
                </td>
            </tr>
        @endforeach
    @endisset
    </tbody>
</table>
</body>
</html>
