@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'طلبات التثبيت')
@push('style')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>
@endpush

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')
    @error('name')
    <div class="row mr-2 ml-2">
        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                id="type-error">{{$message}}
        </button>
    </div>
    @enderror

    <section id="department-content" class="container" style="padding-top:50px">


        <!-- table -->
        <div class="d-flex justify-content-between">
            <h5> طلبات التثبيت </h5>
        </div>

        <div id="main-details" class="d-flex flex-wrap mt-5 mb-4">
            <button id="wait-orders" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill active">
                طلبات بانتظار التفعيل
            </button>
            <button id="review-works" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill">
                طلبات مفعلة
            </button>
            <button id="review-no-works" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill">
                طلبات مرفوضة
            </button>
        </div>


        <div id="wait-orders-section" class="row mt-5">
            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table  table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم الاعلان</th>
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
                                <td>{{$row ->advertising -> id}}</td>
                                <td>{{$row ->advertising -> title}}</td>
                                <td> {{$row -> advertising-> advertiser -> name}}</td>
                                <td> {{$row -> advertising -> advertiser -> phone}}</td>
                                <td> {{$row -> advertising -> advertiser -> email}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button"
                                                class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                data-toggle="modal" type="button"
                                                onclick="window.location.href='{{route('moderator.advertise', $row ->advertising->id)}}'">
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

        <div id="review-works-section" class="d-none">
            <div class="table-responsive mt-5">
                <table class="table  table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم الاعلان</th>
                        <th scope="col">اسم المعلن</th>
                        <th scope="col">رقم الجوال</th>
                        <th scope="col">البريد الإلكتروني</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($rows_accepts)
                        @foreach($rows_accepts as $rows_accept)
                            <tr>
                                <td>{{$rows_accept ->advertising -> id}}</td>
                                <td>{{$rows_accept ->advertising -> title}}</td>
                                <td> {{$rows_accept -> advertising-> advertiser -> name}}</td>
                                <td> {{$rows_accept -> advertising -> advertiser -> phone}}</td>
                                <td> {{$rows_accept -> advertising -> advertiser -> email}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button"
                                                class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                data-toggle="modal" type="button"
                                                onclick="window.location.href='{{route('moderator.advertise', $rows_accept ->advertising->id)}}'">
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

        <div id="review-no-works-section" class="d-none">
            <div class="table-responsive mt-5">
                <table class="table  table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم الاعلان</th>
                        <th scope="col">اسم المعلن</th>
                        <th scope="col"> سبب الرفض</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($rows_refuses)
                        @foreach($rows_refuses as $rows_refuse)
                            <tr>
                                <td>{{$rows_refuse ->advertising -> id}}</td>
                                <td>{{$rows_refuse ->advertising -> title}}</td>
                                <td> {{$rows_refuse -> advertising-> advertiser -> name}}</td>
                                <td> {{$rows_refuse -> reason}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button"
                                                class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                data-toggle="modal" type="button"
                                                onclick="window.location.href='{{route('moderator.advertise', $rows_refuse ->advertising->id)}}'">
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

    @push('js')
        <script>
            $(document).ready(function () {
                $(".select2").select2();

                $('b[role="presentation"]').hide();

                $(".select2-selection__arrow").append(
                    '<i class="fa fa-angle-down"></i>'
                );
            });

            $(document).ready(function () {
                $("#dtHorizontalExample").DataTable({
                    scrollX: true,
                });
                $(".dataTables_length").addClass("bs-select");
            });

            function deleteAlert() {
                swal({
                    title: "هل انت متأكد تريد الحذف؟",
                    text: "سيتم حذف الاعلان",
                    icon: "warning",
                    dangerMode: true,
                    buttons: {
                        cancel: {
                            text: "الغاء",
                            value: null,
                            visible: true,
                            className: "rounded-pill",
                            closeModal: true,
                        },
                        confirm: {
                            text: "حذف",
                            value: true,
                            visible: true,
                            className: "rounded-pill",
                            closeModal: true,
                        },
                    },
                }).then((willDelete) => {
                    if (willDelete) {
                        swal({
                            title: "تم الحذف",
                            text: "تم حذف الاعلان",
                            icon: "success",
                            button: {
                                text: "تم",
                                className: "rounded-pill",
                            },
                        });
                    }
                });
            }

            $(document).ready(function () {
                $(".love-icon-card").click(function (e) {
                    $(this).toggleClass("active");
                });
                $("#recent-ads").click(function (e) {
                    $("#recent-ads").addClass("active").siblings().removeClass("active");
                    $("#ad-cards-section").removeClass("d-none");
                    $("#wait-orders-section").addClass("d-none");
                    $("#review-works-section").addClass("d-none");
                    $("#review-no-works-section").addClass("d-none");
                });
                $("#wait-orders").click(function (e) {
                    $("#wait-orders").addClass("active").siblings().removeClass("active");
                    $("#wait-orders-section").removeClass("d-none");
                    $("#ad-cards-section").addClass("d-none");
                    $("#review-works-section").addClass("d-none");
                    $("#review-no-works-section").addClass("d-none");
                });
                $("#review-works").click(function (e) {
                    $("#review-works")
                        .addClass("active")
                        .siblings()
                        .removeClass("active");
                    $("#review-works-section").removeClass("d-none");
                    $("#review-no-works-section").addClass("d-none");
                    $("#ad-cards-section").addClass("d-none");
                    $("#wait-orders-section").addClass("d-none");
                });
                $("#review-no-works").click(function (e) {
                    $("#review-no-works")
                        .addClass("active")
                        .siblings()
                        .removeClass("active");
                    $("#review-no-works-section").removeClass("d-none");
                    $("#review-works-section").addClass("d-none");
                    $("#ad-cards-section").addClass("d-none");
                    $("#wait-orders-section").addClass("d-none");
                });
            });
            $(document).on("click", ".update-city", function () {
                var id = $(this).data('id');
                $(".modal-content #id").val(id);
            });
        </script>
    @endpush

@endsection
