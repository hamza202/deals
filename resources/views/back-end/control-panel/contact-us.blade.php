@extends('back-end.layouts.app')
@section('title' , 'تواصل معنا')
@push('styles')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>
@endpush

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')


    <section id="department-content" class="container" style="padding-top: 100px">
        <div id="main-details" class="d-flex flex-wrap mt-5 mb-4">
            <button id="wait-orders" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill active">
                الرسائل الجديدة
            </button>
            <button id="review-works" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill">
                رسائل تم الرد عليها
            </button>
        </div>


        <div id="wait-orders-section" class="row mt-5">
            <!-- table -->
            @if(count($rows) > 0)
                <div class="table-responsive mt-5">
                    <table class="table table-striped table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">الاسم</th>
                            <th scope="col">الايميل</th>
                            <th scope="col">الهاتف</th>
                            <th scope="col">العنوان</th>
                            <th scope="col">عنوان الرسالة</th>
                            <th scope="col"> الرسالة</th>
                            <th scope="col" class="text-center">الاعدادات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @isset($rows)
                            @foreach($rows as $row)
                                <tr>
                                    <td> {{$row -> id}}</td>
                                    <td> {{$row -> name}}</td>
                                    <td> {{$row -> email}}</td>
                                    <td> {{$row -> phone}}</td>
                                    <td> {{$row -> address}}</td>
                                    <td> {{$row -> title}}</td>
                                    <td>
                                        {{substr($row -> message,0,50)."..."}}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit"
                                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                    data-toggle="modal" data-target="#edit-city"
                                                    data-name="{{$row -> name}}" data-email="{{$row -> email}}"
                                                    data-description="{{$row -> message}}"
                                                    data-abous="{{$row ->  id}}">
                                                الرد
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
            @else
                <h4 class="text-dark" style="margin-right: 50% ;">لا يوجد رسائل</h4>
            @endif
        </div>
        <div id="review-works-section" class="row mt-5 d-none">
            <!-- table -->
            @if(count($data) > 0)
                <div class="table-responsive mt-5">

                    <table class="table table-striped table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width: 10%">الاسم</th>
                            <th scope="col" style="width: 10%">الايميل</th>
                            <th scope="col" style="width: 10%">عنوان الرسالة</th>
                            <th scope="col" style="width: 30%"> الرسالة</th>
                            <th scope="col" style="width: 30%">الرد</th>
                            <th scope="col" style="width: 10%">عرض التفاصيل</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $new)
                            <tr>
                                <td> {{$new -> id}}</td>
                                <td> {{$new -> name}}</td>
                                <td> {{$new -> email}}</td>
                                <td> {{$new -> title}}</td>
                                <td>
                                    {{substr($new -> message,0,50)."..."}}
                                </td>
                                <td>
                                    {{substr($new -> answer,0,50)."..."}}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                                class="update-city2 btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                data-toggle="modal" data-target="#edit-city2"
                                                data-answer="{{$new -> answer}}"
                                                data-description="{{$new -> message}}">
                                            تفاصيل الرسالة
                                        </button>


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$data -> links()}}
                </div>
            @else
                <h4 class="text-dark" style="margin-right: 50% ;">لا يوجد رسائل</h4>
            @endif
        </div>


    </section>

    <div class="modal fade" id="edit-city" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> ارسال الرد :</h4>
                </div>
                <div class="modal-body">
                    <form class="form" action="{{route('admin.contactAnswer')}}" method="POST">
                        @csrf
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الرسالة:</label>

                                <textarea id="description" name="description"
                                          style="height: 200px" class="form-control" value="" readonly>
                        </textarea>
                                <label for="input-add-city" class="text-right input-label"> اضف الرد:</label>
                                <textarea style="height: 200px" id="answer" name="answer" type="text"
                                          class="form-control"></textarea>
                                <input id="name" value="" name="name" type="hidden" class="form-control"/>
                                <input id="email" value="" name="email" type="hidden" class="form-control"/>
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

                    <h4 class="modal-title" style="margin-left: 40%"> تفاصيل الرسالة :</h4>
                </div>


                <div class="modal-body">
                    <form class="form">
                        @csrf
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الرسالة:</label>

                                <textarea style="min-width: 100% ; height: 200px" id="description" name="description"
                                          class="form-control" value="" readonly>
                        </textarea>

                                <br><br>
                                <label for="input-add-city" class="text-right input-label"> الرد:</label>

                                <textarea style="min-width: 100%; height: 200px" id="answer" name="answer"
                                          class="form-control" value="" readonly>
                        </textarea>

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
                var email = $(this).data('email');
                var abous = $(this).data('abous');
                var name = $(this).data('name');
                var description = $(this).data('description');
                $(".modal-content #name").val(name);
                $(".modal-content #abous").val(abous);
                $(".modal-content #email").val(email);
                $(".modal-content #description").val(description);
            });
            $(document).on("click", ".update-city2", function () {
                var answer = $(this).data('answer');
                var description = $(this).data('description');
                $(".modal-content #description").val(description);
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

            $('.close-icon').on('click', function () {
                $(this).closest('.overlay').fadeOut();
            })
        </script>

    @endpush


@endsection
