<!DOCTYPE html>
<html lang="en">
<head>
    <title>تفاصيل الاعلان</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('front-end/css/custome.css')}}">
    <link rel="stylesheet" href="{{ asset('back-end/css/main.css')}}" />
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


</head>
<body dir="rtl" class="text-right">

@include('back-end.layouts.includes.head')
@include('back-end.layouts.includes.alerts.errors')
@include('back-end.layouts.includes.alerts.success')

<section class="container" >

    <div class="d-flex justify-content-between">
        <h5>  الاعلانات </h5>
    </div>
    <div >
        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table  table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم الاعلان</th>
                    <th scope="col">حالة الاعلان</th>
                    <th scope="col">اسم المعلن</th>
                    <th scope="col">رقم الجوال</th>
                    <th scope="col">البريد الإلكتروني</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                </thead>
                <tbody>

                @isset($rows)
                    @foreach($rows as $row)
                        <tr>
                            <td>{{$row -> id}}</td>
                            <td>{{$row -> title}}</td>
                            <td>{{$row -> Status ->name}}</td>
                            <td> {{$row -> advertiser -> name}}</td>
                            <td> {{$row -> advertiser -> phone}}</td>
                            <td> {{$row -> advertiser -> email}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                            data-toggle="modal" type="button" onclick="window.location.href='{{route('moderator.advertise', $row ->id)}}'">
                                        تفاصيل الاعلان
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset
                </tbody>
            </table>
            {{$rows -> links()}}
        </div>
    </div>
</section>

@include('back-end.layouts.includes._footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('back-end/js/nav-footer.js')}}"></script>
<script src="{{ asset('front-end/js/main.js')}}"></script>

<script>
    $(document).ready(function () {
        $(".select2").select2();

        $('b[role="presentation"]').hide();

        $(".select2-selection__arrow").append(
            '<i class="fa fa-angle-down"></i>'
        );
    })
</script>


</body>

</html>

