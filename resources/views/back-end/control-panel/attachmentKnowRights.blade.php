@extends('back-end.layouts.app')
@section('title' , 'مرفقات اعرف حقك')
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
            <h5>مرفقات اعرف حقك</h5>
            <button type="button" class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0"
                    class="btn rounden"
                    data-toggle="modal" data-target="#add-city">
                اضافه مرفق
            </button>
        </div>

        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">اسم المرفق</th>
                    <th scope="col">المرفق</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                </thead>
                <tbody>
                @isset($datas)
                    @foreach($datas as $data)
                        <tr>

<td>{{$data->name}}</td>
                            <td><a href="{{$data->url}}" download="file"><i class="fa fa-download" aria-hidden="true"></i></a></td>

                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                            class="btn btn-danger rounded-pill px-2 px-sm-4 red-btn border-0"
                                            onclick="deleteAlert({{$data -> id}})">
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
                {{ $datas->links() }}

            </div>

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

                    <h4 class="modal-title" style="margin-left: 40%"> إضافة مرفق جديد :</h4>
                </div>


                <form class="form" action="{{route('admin.attachmentKnowRights.store')}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row modal-body mx-auto edit-modal-content">
                        <div >
                            <label for="input-add-city" class="text-right input-label">اسم المرفق :</label>
                            <input id="input-add-city" name="name" type=text class="form-control"/>
                        </div>
                        <div >
                            <label for="input-add-city" class="text-right input-label">المرفق :</label>
                            <input id="input-add-city" name="url" type="file" class="form-control"/>
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
                    text: "سيتم حذف المرفق",
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

                    fetch('/admin/attachmentKnowRights/delete/' + $id)

                        .then(response => response.json()
                            .then(result => {
                                //your result
                                if (result == 'success') {
                                    swal({
                                        title: "تم الحذف",
                                        text: "تم حذف المرفق",
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
                $(".modal-content #id").val(id);
            });

        </script>
    @endpush

@endsection
