@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'استشارات')
@push('styles')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>
@endpush

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')


    @if($filtter == 1)
        <section id="department-content" class="container" style="padding-top: 100px">

            <div id="main-details" class="d-flex flex-wrap mt-5 mb-4">
                <button id="wait-orders" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill active">
                    الطلبات الجديدة
                </button>
                <button id="review-works" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill">
                    طلبات تم الرد عليها
                </button>
            </div>

            <div class="row">
                <form class="w-100 mx-auto mb-4 mb-md-0" method="POST" action="{{route('admin.consultations')}}">
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

            <div id="wait-orders-section" class="row mt-5">
                @if(count($rows) > 0)
                    <div class="table-responsive mt-5">
                        <table class="table table-striped table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">المعلن</th>
                                <th scope="col">الاسم</th>
                                <th scope="col">الايميل</th>
                                <th scope="col">الهاتف</th>
                                <th scope="col">الاستشارة</th>
                                <th scope="col" class="text-center">الاعدادات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($rows as $row)
                                <tr>
                                    <td> {{$row->id}} </td>
                                    <td> {{$row -> advertiser -> name}}</td>
                                    <td> {{$row -> name}}</td>
                                    <td> {{$row -> email}}</td>
                                    <td> {{$row -> phone}}</td>
                                    <td> {{$row -> consultations}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit"
                                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                    data-toggle="modal" data-target="#edit-city"
                                                    data-id="{{$row -> advertiser -> id}}" data-abous="{{$row ->  id}}">
                                                الرد
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div id="review-works-section" class="row mt-5 d-none">
                @if(count($rows1) > 0)
                    <div class="table-responsive mt-5">
                        <table class="table table-striped table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">المعلن</th>
                                <th scope="col">الايميل</th>
                                <th scope="col">الاستشارة</th>
                                <th scope="col">الرد</th>
                                <th scope="col" class="text-center">الاعدادات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($rows1 as $row1)
                                <tr>
                                    <td> {{$row1 -> id}} </td>
                                    <td> {{$row1 -> advertiser -> name}}</td>
                                    <td> {{$row1 -> email}}</td>
                                    <td>
                                        {{substr($row1 -> consultations,0,50)."....."}}
                                    </td>
                                    <td>
                                        {{substr($row1 -> answer,0,50)."....."}}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit"
                                                    class="update-city2 btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                    data-toggle="modal" data-target="#edit-city2"
                                                    data-consultations="{{$row1 -> consultations}}"
                                                    data-answer="{{$row1 ->  answer}}">
                                                عرض التفاصيل
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </section>

    @else
        <section id="department-content" class="container" style="padding-top: 100px">

            <div class="row">
                <form class="w-100 mx-auto mb-4 mb-md-0" method="POST" action="{{route('admin.consultations')}}">
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

            @if(count($rows) > 0)
                <div class="table-responsive mt-5">
                    <table class="table table-striped table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">المعلن</th>
                            <th scope="col">الاسم</th>
                            <th scope="col">الايميل</th>
                            <th scope="col">الهاتف</th>
                            <th scope="col">الاستشارة</th>
                            <th scope="col" class="text-center">الاعدادات</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($rows as $row)
                            <tr>
                                <td> {{$row->id}} </td>
                                <td> {{$row -> advertiser -> name}}</td>
                                <td> {{$row -> name}}</td>
                                <td> {{$row -> email}}</td>
                                <td> {{$row -> phone}}</td>
                                <td> {{$row -> consultations}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                                class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                data-toggle="modal" data-target="#edit-city"
                                                data-id="{{$row -> advertiser -> id}}" data-abous="{{$row ->  id}}">
                                            الرد
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            @else
                لا يوجد نتائج
            @endif

        </section>

    @endif
    <div class="modal fade" id="edit-city" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> ارسال الرد :</h4>
                </div>


                <div class="modal-body">
                    <form class="form" action="{{route('moderator.consultationsAnswer')}}" method="POST">
                        @csrf
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> اضف الرد:</label>
                                <textarea id="name" name="name" type="text" class="form-control"
                                          style="height: 200px"></textarea>
                                <input id="id" value="" name="id" type="hidden" class="form-control"/>
                                <input id="abous" value="" name="abous" type="hidden" class="form-control"/>
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
                                <label for="input-add-city" class="text-right input-label"> الاستشارة:</label>
                                <textarea id="consultations" name="consultations" type="text" class="form-control"
                                          style="height: 200px"></textarea>

                                <label for="input-add-city" class="text-right input-label"> الرد:</label>
                                <textarea id="answer" name="answer" type="text" class="form-control"
                                          style="height: 200px"></textarea>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    @push('js')
        <script>
            $(document).on("click", ".update-city", function () {
                var id = $(this).data('id');
                var abous = $(this).data('abous');
                $(".modal-content #id").val(id);
                $(".modal-content #abous").val(abous);
            });
            $(document).on("click", ".update-city2", function () {
                var consultations = $(this).data('consultations');
                var answer = $(this).data('answer');
                $(".modal-content #consultations").val(consultations);
                $(".modal-content #answer").val(answer);
            });
            $(document).ready(function () {
                $("#wait-orders").click(function (e) {
                    $("#wait-orders").addClass("active").siblings().removeClass("active");
                    $("#wait-orders-section").removeClass("d-none");
                    $("#review-works-section").addClass("d-none");
                });
                $("#review-works").click(function (e) {
                    $("#review-works")
                        .addClass("active")
                        .siblings()
                        .removeClass("active");
                    $("#review-works-section").removeClass("d-none");
                    $("#wait-orders-section").addClass("d-none");
                });
            });


        </script>

    @endpush

@endsection
