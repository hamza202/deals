@extends('back-end.layouts.app')
@section('title' , 'الباقات')
@push('style')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>
@endpush

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section id="department-content" class="container" style="padding-top:50px">
        <div class="d-flex justify-content-between">
            <h5>الباقات</h5>
            <button type="button" class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0"
                    class="btn rounden"
                    data-toggle="modal" data-target="#add-city">
                اضافه باقة
            </button>
        </div>

        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">الاسم</th>
                    <th scope="col">السعر</th>
                    <th scope="col">عدد الأيام</th>
                    <th scope="col">قيمة الخصم</th>
                    <th scope="col">عدد الاعلانات المثبتة</th>
                    <th scope="col"> درجة زيادة العضوية</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                </thead>
                <tbody>
                @isset($rows)
                    @foreach($rows as $row)
                        <tr>
                            <td> {{$row -> name}}</td>
                            <td> {{$row -> price}}</td>
                            <td> {{$row -> time_line}}</td>
                            <td> {{$row -> discount}}</td>
                            <td> {{$row -> plan ->advertising}}</td>
                            <td> {{$row -> plan -> membership}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                            class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                            data-toggle="modal" data-target="#edit-city"
                                            data-id="{{$row -> id}}" data-name="{{$row -> name}}"
                                            data-time_line="{{$row -> time_line}}" data-price="{{$row -> price}}"
                                            data-advertising="{{$row -> plan ->advertising}}"
                                            data-membership="{{$row -> plan ->membership}}">
                                        تعديل
                                    </button>
                                    <button type="submit"
                                            class="btn btn-danger rounded-pill px-2 px-sm-4 red-btn border-0"
                                            onclick="deleteAlert({{$row -> id}})">
                                        حذف
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset
                </tbody>
            </table>
            <div class="text-center">
                {{ $rows -> links() }}

            </div>

        </div>

    </section>
    <!-- Modal -->
    <div class="modal fade" id="add-city" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> اضافة باقة جديدة :</h4>
                </div>


                <div class="modal-body">
                    <form class="form" action="{{route('admin.packages.store')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">اسم الباقة:</label>
                                <input id="input-add-city" required name="name" type="text" class="form-control"/>
                            </div>
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">سعر الباقة:</label>
                                <input id="input-add-city" required value="0" name="price" type="text" class="form-control"/>
                            </div>
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">عدد أيام الباقة:</label>
                                <input id="input-add-city" required name="time_line" type="text" class="form-control"/>
                            </div>
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">عدد الاعلانات المثبتة
                                    :</label>
                                <input id="input-add-city" required name="advertising" type="text" class="form-control"/>
                            </div>
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">درجة زيادة العضوية:</label>
                                <input id="input-add-city" required name="membership" type="text" class="form-control"/>
                            </div>
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> قيمة الخصم :</label>
                                <input id="input-add-city" required value="0" name="discount" type="text" class="form-control"/>
                            </div>


                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                أضف
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="edit-city" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل الباقة :</h4>
                </div>


                <div class="modal-body">
                    <form class="form" action="{{route('admin.packages.update')}}" method="POST">
                        @csrf
                        <input id="id" value="" name="id" type="hidden" class="form-control"/>

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">اسم الباقة:</label>
                                <input id="name" value="" name="name" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">سعر الباقة:</label>
                                <input id="price" value="" name="price" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">عدد أيام الباقة :</label>
                                <input id="time_line" value="" name="time_line" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">عدد الاعلانات المثبتة
                                    :</label>
                                <input id="advertising" value="" name="advertising" type="text" class="form-control"/>
                            </div>
                        </div>

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">درجة زيادة العضوية :</label>
                                <input id="membership" value="" name="membership" type="text" class="form-control"/>
                            </div>
                        </div>

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> قيمة الخصم :</label>
                                <input id="discount" value="" name="discount" type="text" class="form-control"/>
                            </div>
                        </div>


                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تعديل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Optional JavaScript -->

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

            function deleteAlert($id) {
                swal({
                    title: "هل انت متأكد تريد الحذف؟",
                    text: "سيتم حذف الباقة",
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

                    fetch('/admin/packages/delete/' + $id)

                        .then(response => response.json()
                            .then(result => {
                                //your result
                                if (result == 'success') {
                                    swal({
                                        title: "تم الحذف",
                                        text: "تم حذف الباقة",
                                        icon: "success",
                                        button: {
                                            text: "تم",
                                            className: "rounded-pill",
                                        },
                                    });
                                    location.reload();

                                } else {
                                    swal({
                                        title: "حدثت مشكلة حاول لاحقا ",
                                        text: "حدثت مشكلة حاول لاحقا  ",
                                        icon: "warning",
                                        button: {
                                            text: "تم",
                                            className: "rounded-pill",
                                        },
                                    });

                                }
                                location.reload();
                            }).catch(err => {
                                console.log(err)
                            }));


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
                });
                $("#wait-orders").click(function (e) {
                    $("#wait-orders").addClass("active").siblings().removeClass("active");
                    $("#wait-orders-section").removeClass("d-none");
                    $("#ad-cards-section").addClass("d-none");
                    $("#review-works-section").addClass("d-none");
                });
                $("#review-works").click(function (e) {
                    $("#review-works")
                        .addClass("active")
                        .siblings()
                        .removeClass("active");
                    $("#review-works-section").removeClass("d-none");
                    $("#ad-cards-section").addClass("d-none");
                    $("#wait-orders-section").addClass("d-none");
                });
            });

            $(document).on("click", ".update-city", function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var price = $(this).data('price');
                var time_line = $(this).data('time_line');
                var membership = $(this).data('membership');
                var advertising = $(this).data('advertising');
                var discount = $(this).data('discount');
                $(".modal-content #id").val(id);
                $(".modal-content #name").val(name);
                $(".modal-content #price").val(price);
                $(".modal-content #time_line").val(time_line);
                $(".modal-content #membership").val(membership);
                $(".modal-content #advertising").val(advertising);
                $(".modal-content #discount").val(discount);
            });

        </script>
    @endpush

@endsection

