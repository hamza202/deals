@extends('back-end.layouts.app')
@section('title' , 'طلبات الهدايا ')
@push('style')
    <link rel="stylesheet" href="{{ asset('back-end/css/main.css')}}"/>
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
@endpush

@section('content')

    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section id="main" class="mt-5 container">

        <div class="row">
            <form class="w-100 mx-auto mb-4 mb-md-0" method="POST" action="{{route('admin.replace_gifts')}}">
                @csrf
                <div
                    class="d-flex d-flex pl-4 rounded-pill search-container py-1 pr-2"
                >
                    <input
                        name="filter"
                        class="input-search form-control rounded-pill border-0"
                        type="search"
                        placeholder="ابحث عن ما تشاء، مثلا:(رقم جوال العميل او الاسم او اسم المسخدم او الايميل )"
                        aria-label="Search"
                    />
                    <button class="my-auto" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
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
        <!-- wait orders -->
        <div id="wait-orders-section" class="row mt-5">
            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">اسم المعلن</th>
                        <th scope="col">ايميل المعلن</th>
                        <th scope="col">هاتف المعلن</th>
                        <th scope="col"> الهدية</th>
                        <th scope="col"> العنوان</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($rows)
                        @foreach($rows as $row)
                            <tr>
                                <td>{{$row -> advertiser -> name}}</td>
                                <td>{{$row -> advertiser -> email}}</td>
                                <td>{{$row -> advertiser -> phone}}</td>
                                <td>{{$row -> gift -> name}}</td>
                                <td>{{$row -> address }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                                class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                onclick="window.location.href='{{route('admin.replace_gifts.update' , $row -> id)}}'">
                                            تأكيد
                                        </button>

                                        <button type="submit"
                                                class="update-city btn btn-danger rounded-pill px-2 px-sm-4 red-btn border-0 ml-2"
                                                data-toggle="modal" data-target="#edit-gift"
                                                data-id="{{$row -> id}}">
                                            رفض
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endisset

                    </tbody>
                </table>

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
                            <th scope="col">ايميل المعلن</th>
                            <th scope="col">هاتف المعلن</th>
                            <th scope="col"> الهدية</th>
                            <th scope="col"> العنوان</th>
                        </tr>
                        </thead>
                        <tbody>

                        @isset($accepts)
                            @foreach($accepts as $accept)
                                <tr>
                                    <td>{{$accept -> advertiser -> name}}</td>
                                    <td>{{$accept -> advertiser -> email}}</td>
                                    <td>{{$accept -> advertiser -> phone}}</td>
                                    <td>{{$accept -> gift -> name}}</td>
                                    <td>{{$accept -> address }}</td>
                                </tr>
                            @endforeach
                        @endisset

                        </tbody>
                    </table>
                    {{$accepts -> links()}}
                </table>
            </div>
        </div>
        <div id="review-no-works-section" class="d-none">
            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">

                    <table class="table table-striped table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col">اسم المعلن</th>
                            <th scope="col">ايميل المعلن</th>
                            <th scope="col">هاتف المعلن</th>
                            <th scope="col"> الهدية</th>
                            <th scope="col"> سبب الرفض</th>
                        </tr>
                        </thead>
                        <tbody>

                        @isset($noAccepts)
                            @foreach($noAccepts as $noAccept)
                                <tr>
                                    <td>{{$noAccept -> advertiser -> name}}</td>
                                    <td>{{$noAccept -> advertiser -> email}}</td>
                                    <td>{{$noAccept -> advertiser -> phone}}</td>
                                    <td>{{$noAccept -> gift -> name}}</td>
                                    <td>{{$noAccept -> reason }}</td>
                                </tr>
                            @endforeach
                        @endisset

                        </tbody>
                    </table>
                    {{$noAccepts -> links()}}
                </table>
            </div>
        </div>

        <div class="modal fade" id="edit-gift" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered w-75" role="document">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>

                        <h4 class="modal-title" style="margin-left: 40%"> سبب الرفض :</h4>
                    </div>


                    <div class="modal-body">
                        <form class="form" action="{{route('admin.replace_gifts.updateNotAccept')}}" method="POST">
                            @csrf
                            <div class="row modal-body mx-auto edit-modal-content">
                                <div class="col">
                                    <label for="input-add-city" class="text-right input-label"> السبب:</label>
                                    <input name="reason" type="text" class="form-control"/>
                                    <input id="id" value="" name="id" type="hidden" class="form-control"/>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                    تأكيد الرفض
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

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

