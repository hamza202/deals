@extends('back-end.layouts.app')
@section('title' , 'كيف عرفت ديل')
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
        <div class="d-flex justify-content-between">
            <h5>كيف عرفت ديل</h5>
            <button type="button" class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0"
                    class="btn rounden"
                    data-toggle="modal" data-target="#add-city">
                اضافه خيار جديد
            </button>
        </div>

        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">الخيارات</th>
                    <th scope="col">الاعدادات</th>
                </tr>
                </thead>
                <tbody>
                @isset($rows)
                    @foreach($rows as $row)
                        <tr>
                            <td> {{$row->name}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                            class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                            data-toggle="modal" data-target="#edit-city"
                                            data-id="{{$row -> id}}" data-name="{{$row->name}}">
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

            <div class="justify-content-center d-flex">

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

                    <h4 class="modal-title" style="margin-left: 40%"> إضافة خيار جديد :</h4>
                </div>


                <form class="form" action="{{route('admin.knowUs.store')}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row modal-body mx-auto edit-modal-content">
                        <div class="col">
                            <label for="input-add-city" class="text-right input-label">الاسم :</label>
                            <input id="input-add-city" name="name" type="text" class="form-control"/>
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
    <!-- Optional JavaScript -->

    <div class="modal fade" id="edit-city" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل الخيار :</h4>
                </div>

                <form class="form" action="{{route('admin.knowUs.update')}}" method="POST">
                    @csrf
                    <div class="row modal-body mx-auto edit-modal-content">
                        <div class="col">
                            <label for="input-add-city" class="text-right input-label">الاسم :</label>
                            <input id="name" value="" name="name" type="text" class="form-control"/>
                            <input id="id" value="" name="id" type="hidden" class="form-control"/>
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
                    text: "سيتم حذف الخيار",
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

                    fetch('/admin/pages/knowUs/delete/' + $id)

                        .then(response => response.json()
                            .then(result => {
                                //your result
                                if (result == 'success') {
                                    swal({
                                        title: "تم الحذف",
                                        text: "تم حذف الخيار",
                                        icon: "success",
                                        button: {
                                            text: "تم",
                                            className: "rounded-pill",
                                        },
                                    });
                                    location.reload();

                                } else {
                                    swal({
                                        title: "لا يمكنك حذف هذا الخيار ",
                                        text: "لا يمكنك حذف هذا الخيار   ",
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
                $(".modal-content #id").val(id);
                $(".modal-content #name").val(name);
            });

        </script>
    @endpush

@endsection
