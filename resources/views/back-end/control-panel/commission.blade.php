@extends('back-end.layouts.app')
@section('title' , ' العمولات')
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
                طلبات بانتظار الموافقة
            </button>
            <button id="review-works" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill">
                طلبات تم مراجعتها
            </button>
            <button id="review-works1" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill">
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
                        <th scope="col">اسم الحوالة</th>
                        <th scope="col">اسم المعلن</th>
                        <th scope="col"> الاعلان</th>
                        <th scope="col"> الهاتف</th>
                        <th scope="col"> الايميل</th>
                        <th scope="col"> العمولة</th>
                        <th scope="col"> المرفقات</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($review)
                        @foreach($review as $row)
                            <tr>
                                <td>{{$row ->  bank_name}}</td>
                                <td>{{$row -> name}}</td>
                                <td>{{$row -> advertising -> title}}</td>
                                <td>{{$row -> phone}}</td>
                                <td>{{$row -> email}}</td>
                                <td>{{$row -> money}}</td>
                                <td><a href="{{$row -> files}}" download="bank"><i class="fa fa-download"
                                                                                   aria-hidden="true"></i></a></td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <button type="submit"
                                                onclick="window.location.href='{{route('admin.commission.update',$row ->id)}}'"
                                                class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2">
                                            تأكيد
                                        </button>

                                        <button type="submit"
                                                class="update-city btn btn-danger rounded-pill px-2 px-sm-4 red-btn border-0 ml-2"
                                                data-toggle="modal" data-target="#edit-city"
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
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">اسم الحوالة</th>
                        <th scope="col">اسم المعلن</th>
                        <th scope="col"> الاعلان</th>
                        <th scope="col"> الهاتف</th>
                        <th scope="col"> الايميل</th>
                        <th scope="col"> العمولة</th>
                        <th scope="col"> المرفقات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($finish)
                        @foreach($finish as $row)
                            <tr>
                                <td>{{$row ->  bank_name}}</td>
                                <td>{{$row -> name}}</td>
                                <td>{{$row -> advertising -> title}}</td>
                                <td>{{$row -> phone}}</td>
                                <td>{{$row -> email}}</td>
                                <td>{{$row -> money}}</td>
                                <td><a href="{{$row -> files}}" download="bank"><i class="fa fa-download"
                                                                                   aria-hidden="true"></i></a></td>
                            </tr>
                        @endforeach
                    @endisset

                    </tbody>
                </table>
            </div>
        </div>


        <div id="review-works1-section" class="d-none">
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">اسم الحوالة</th>
                        <th scope="col">اسم المعلن</th>
                        <th scope="col"> الاعلان</th>
                        <th scope="col"> الهاتف</th>
                        <th scope="col"> الايميل</th>
                        <th scope="col"> العمولة</th>
                        <th scope="col"> سبب الرفض</th>
                        <th scope="col"> المرفقات</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($unacceptable)
                        @foreach($unacceptable as $row)
                            <tr>
                                <td>{{$row ->  bank_name}}</td>
                                <td>{{$row -> name}}</td>
                                <td>{{$row -> advertising -> title}}</td>
                                <td>{{$row -> phone}}</td>
                                <td>{{$row -> email}}</td>
                                <td>{{$row -> money}}</td>
                                <td>{{$row -> reason}}</td>
                                <td><a href="{{$row -> files}}" download="bank"><i class="fa fa-download"
                                                                                   aria-hidden="true"></i></a></td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <button type="submit"
                                                onclick="window.location.href='{{route('admin.commission.update',$row ->id)}}'"
                                                class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2">
                                            تأكيد
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

        <div class="modal fade" id="edit-city" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered w-75" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>

                        <h4 class="modal-title" style="margin-left: 40%"> سبب الرفض :</h4>
                    </div>


                    <div class="modal-body">
                        <form class="form" action="{{route('admin.commission.accept')}}" method="POST">
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

            $(document).ready(function () {
                $(".love-icon-card").click(function (e) {
                    $(this).toggleClass("active");
                });
                $("#recent-ads").click(function (e) {
                    $("#recent-ads").addClass("active").siblings().removeClass("active");
                    $("#ad-cards-section").removeClass("d-none");
                    $("#wait-orders-section").addClass("d-none");
                    $("#review-works-section").addClass("d-none");
                    $("#review-works1-section").addClass("d-none");
                });
                $("#wait-orders").click(function (e) {
                    $("#wait-orders").addClass("active").siblings().removeClass("active");
                    $("#wait-orders-section").removeClass("d-none");
                    $("#ad-cards-section").addClass("d-none");
                    $("#review-works-section").addClass("d-none");
                    $("#review-works1-section").addClass("d-none");
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
                });
            });

            $(document).on("click", ".update-city", function () {
                var id = $(this).data('id');
                $(".modal-content #id").val(id);
            });

        </script>
    @endpush
@endsection

