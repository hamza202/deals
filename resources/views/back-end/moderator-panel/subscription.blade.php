@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'طلبات الاشتراك')
@push('style')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>
@endpush

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section id="main" class="mt-5 container">
        <div id="main-details" class="d-flex flex-wrap mt-5 mb-4">
            <button id="wait-orders" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill active">
                طلبات بانتظار التفعيل
            </button>
            <button id="review-works" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill">
                طلبات مفعلة
            </button>
            <button id="review-works1" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill">
                طلبات منتهية
            </button>
            <button id="review-works2" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill">
                طلبات عرض السعر
            </button>
            <button id="review-works3" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill">
                طلبات تم الرد عليها
            </button>
        </div>
        <!-- wait orders -->
        <div id="wait-orders-section" class="row mt-5">
            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">اسم المعلن</th>
                        <th scope="col"> الباقة</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($rows)
                        @foreach($rows as $row)
                            <tr>
                                <td>{{$row -> advertiser -> name}}</td>
                                <td>{{$row -> package -> name}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                                class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                onclick="window.location.href='{{route('moderator.package.addAdvertiser' , $row -> id)}}'">
                                            تأكيد
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

        <!-- review works -->
        <div id="review-works-section" class="d-none">
            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">

                    <table class="table table-striped table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col">اسم المعلن</th>
                            <th scope="col"> الباقة</th>
                            <th scope="col"> تاريخ البداية</th>
                            <th scope="col"> تاريخ النهاية</th>
                        </tr>
                        </thead>
                        <tbody>

                        @isset($accepts)
                            @foreach($accepts as $accept)
                                <tr>
                                    <td>{{$accept -> advertiser -> name}}</td>
                                    <td>{{$accept -> package -> name}}</td>
                                    <td>{{$accept -> start_date }}</td>
                                    <td>{{$accept -> end_date }}</td>
                                </tr>
                            @endforeach
                        @endisset

                        </tbody>
                    </table>
                    {{$accepts -> links()}}
                </table>
            </div>
        </div>


        <div id="review-works1-section" class="d-none">
            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">

                    <table class="table table-striped table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col">اسم المعلن</th>
                            <th scope="col"> الباقة</th>
                            <th scope="col"> تاريخ البداية</th>
                            <th scope="col"> تاريخ النهاية</th>
                        </tr>
                        </thead>
                        <tbody>

                        @isset($finish)
                            @foreach($finish as $finishs)
                                <tr>
                                    <td>{{$finishs -> advertiser -> name}}</td>
                                    <td>{{$finishs -> package -> name}}</td>
                                    <td>{{$finishs -> start_date }}</td>
                                    <td>{{$finishs -> end_date }}</td>
                                </tr>
                            @endforeach
                        @endisset

                        </tbody>
                    </table>
                    {{$finish -> links()}}
                </table>
            </div>
        </div>


        <div id="review-works2-section" class="d-none">
            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">

                    <table class="table table-striped table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col">اسم المعلن</th>
                            <th scope="col">ايميل المعلن</th>
                            <th scope="col"> الباقة</th>
                            <th scope="col"> الرد</th>
                        </tr>
                        </thead>
                        <tbody>

                        @isset($newRequests)
                            @foreach($newRequests as $newRequest)
                                <tr>
                                    <td>{{$newRequest -> advertiser -> name}}</td>
                                    <td>{{$newRequest -> advertiser -> email}}</td>
                                    <td>{{$newRequest -> package -> name}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit"
                                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                    data-toggle="modal" data-target="#edit-city"
                                                    data-id="{{$newRequest -> advertiser -> id}}"
                                                    data-sponsored="{{$newRequest ->  id}}">
                                                الرد
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset

                        </tbody>
                    </table>
                    {{$finish -> links()}}
                </table>
            </div>
        </div>


        <div id="review-works3-section" class="d-none">
            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">

                    <table class="table table-striped table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col">اسم المعلن</th>
                            <th scope="col">ايميل المعلن</th>
                            <th scope="col"> الباقة</th>
                            <th scope="col"> تفاصيل الرد</th>
                        </tr>
                        </thead>
                        <tbody>

                        @isset($oldRequests)
                            @foreach($oldRequests as $oldRequest)
                                <tr>
                                    <td>{{$oldRequest -> advertiser -> name}}</td>
                                    <td>{{$oldRequest -> advertiser -> email}}</td>
                                    <td>{{$oldRequest -> package -> name}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit"
                                                    class="update-city2 btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                    data-toggle="modal" data-target="#edit-city2"
                                                    data-answer="{{$oldRequest ->  answer}}">
                                                عرض التفاصيل
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset

                        </tbody>
                    </table>
                    {{$finish -> links()}}
                </table>
            </div>
        </div>


        <div class="modal fade" id="edit-city" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered w-75" role="document">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>

                        <h4 class="modal-title" style="margin-left: 40%"> ارسال الرد :</h4>
                    </div>


                    <div class="modal-body">
                        <form class="form" action="{{route('moderator.PackageAnswer')}}" method="POST">
                            @csrf
                            <div class="row modal-body mx-auto edit-modal-content">
                                <div class="col">
                                    <label for="input-add-city" class="text-right input-label"> اضف الرد:</label>
                                    <textarea id="answer" name="answer" type="text" class="form-control"
                                              style="height: 200px"></textarea>
                                    <input id="id" value="" name="id" type="hidden" class="form-control"/>
                                    <input id="sponsored" value="" name="sponsored" type="hidden" class="form-control"/>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                    ارسال
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="edit-city2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered w-75" role="document">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>

                        <h4 class="modal-title" style="margin-left: 40%"> التفاصيل :</h4>
                    </div>


                    <div class="modal-body">
                        <form class="form">
                            @csrf
                            <div class="row modal-body mx-auto edit-modal-content">
                                <div class="col">

                                    <label for="input-add-city" class="text-right input-label"> الرد:</label>
                                    <textarea id="answer" name="answer" type="text" class="form-control"
                                              style="height: 200px" readonly></textarea>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>

    @push('js')
        <script>
            $(document).on("click", ".update-city", function () {
                var id = $(this).data('id');
                var sponsored = $(this).data('sponsored');
                $(".modal-content #id").val(id);
                $(".modal-content #sponsored").val(sponsored);
            });

            $(document).on("click", ".update-city2", function () {
                var answer = $(this).data('answer');
                $(".modal-content #answer").val(answer);
            });
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
                    $("#review-works2-section").addClass("d-none");
                    $("#review-works3-section").addClass("d-none");
                });
                $("#wait-orders").click(function (e) {
                    $("#wait-orders").addClass("active").siblings().removeClass("active");
                    $("#wait-orders-section").removeClass("d-none");
                    $("#ad-cards-section").addClass("d-none");
                    $("#review-works-section").addClass("d-none");
                    $("#review-works1-section").addClass("d-none");
                    $("#review-works2-section").addClass("d-none");
                    $("#review-works3-section").addClass("d-none");
                });
                $("#review-works").click(function (e) {
                    $("#review-works")
                        .addClass("active")
                        .siblings()
                        .removeClass("active");
                    $("#review-works-section").removeClass("d-none");
                    $("#ad-cards-section").addClass("d-none");
                    $("#wait-orders-section").addClass("d-none");
                    $("#review-works1-section").addClass("d-none");
                    $("#review-works2-section").addClass("d-none");
                    $("#review-works3-section").addClass("d-none");
                });
                $("#review-works1").click(function (e) {
                    $("#review-works1")
                        .addClass("active")
                        .siblings()
                        .removeClass("active");
                    $("#review-works1-section").removeClass("d-none");
                    $("#ad-cards-section").addClass("d-none");
                    $("#wait-orders-section").addClass("d-none");
                    $("#review-works-section").addClass("d-none");
                    $("#review-works2-section").addClass("d-none");
                    $("#review-works3-section").addClass("d-none");
                });
                $("#review-works2").click(function (e) {
                    $("#review-works2")
                        .addClass("active")
                        .siblings()
                        .removeClass("active");
                    $("#review-works2-section").removeClass("d-none");
                    $("#ad-cards-section").addClass("d-none");
                    $("#wait-orders-section").addClass("d-none");
                    $("#review-works-section").addClass("d-none");
                    $("#review-works1-section").addClass("d-none");
                    $("#review-works3-section").addClass("d-none");
                });
                $("#review-works3").click(function (e) {
                    $("#review-works3")
                        .addClass("active")
                        .siblings()
                        .removeClass("active");
                    $("#review-works3-section").removeClass("d-none");
                    $("#ad-cards-section").addClass("d-none");
                    $("#wait-orders-section").addClass("d-none");
                    $("#review-works-section").addClass("d-none");
                    $("#review-works1-section").addClass("d-none");
                    $("#review-works2-section").addClass("d-none");
                });
            });
        </script>
    @endpush
@endsection

