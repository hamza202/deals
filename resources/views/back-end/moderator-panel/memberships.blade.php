@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'العضويات')
@push('styles')
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>
@endpush


@section('content')

    @include('front-end.layouts.includes.alerts.errors')
    @include('front-end.layouts.includes.alerts.success')


    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="content col-12 d-flex justify-content-between my-5">
                <h5 class="title">العضويات</h5>
                <button type="button" class="btn btn-secondary the-button px-4" data-toggle="modal"
                        data-target="#AddModalCenter">إضافة عضوية
                </button>
            </div>
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">اسم العضوية</th>
                        <th scope="col">الصورة</th>
                        <th scope="col">عدد العملاء</th>
                        <th scope="col" class="text-center">المؤهلات</th>
                        <th scope="col" class="text-center">المميزات</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($memberships)
                        @foreach($memberships as $membership)
                            <tr>
                                <td>{{$membership -> title}}</td>
                                <td>
                                    <img src="{{$membership -> photo}}" alt="membership"
                                         style="width: 80px;height: 80px;">
                                </td>
                                <td>
                                    @if(!empty($membership -> advertiserMembership))
                                        {{$membership -> advertiserMembership ->count()}}
                                    @else
                                        0
                                    @endif
                                </td>
                                <td>
                                    {{$membership ->qualifications}}
                                </td>

                                <td>
                                    {{$membership ->features}}
                                </td>
                                <td>
                                    <div>
                                        <button type="button"
                                                class="edite_mem btn btn-success rounded-pill px-2 px-sm-4 "
                                                data-toggle="modal" data-target="#EditModalCenter"
                                                data-id="{{$membership -> id}}" data-title="{{$membership -> title}}"
                                                data-qualifications="{{$membership -> qualifications}}"
                                                data-features="{{$membership -> features}}"
                                        >تعديل
                                        </button>

                                        <button type="submit"
                                                class="btn btn-danger rounded-pill px-2 px-sm-4 red-btn border-0"
                                                onclick="deleteAlert({{$membership -> id}})">
                                            حذف
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
    </section>
    <!-- Modal -->
    <div class="modal fade" id="EditModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل العضوية :</h4>
                </div>


                <div class="modal-body">
                    <form class=" modal-body mx-auto edit-modal-content"
                          action="{{route('moderator.membership.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="" id="id">
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">اسم العضوية</h6>
                            <input type="text" name="title" id="title" value="" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>


                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">المؤهلات </h6>
                            <input type="text" name="qualifications" id="qualifications" value="" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">المميزات </h6>
                            <textarea type="text" name="features" id="features" value="" class="form-control"
                                      aria-label="Amount (to the nearest dollar)">
                        </textarea>
                        </div>


                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الصورة</h6>
                            <textarea type="file" class="form-control" name="photo" id="photo"
                                      aria-label="Amount (to the nearest dollar)">
                        </textarea>
                        </div>


                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill px-5 py-3"
                                    style="padding-bottom: 30px">حفظ
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal2 -->
    <div class="modal fade" id="AddModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> اضافة عضوية جديدة :</h4>
                </div>


                <div class="modal-body">
                    <form class=" modal-body mx-auto edit-modal-content"
                          action="{{route('moderator.membership.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الاسم</h6>
                            <input type="text" name="title" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الصورة</h6>
                            <input type="file" name="photo" class="form-control">
                        </div>


                        <div class="col-12 my-2">
                            <h6 class="text-right input-label"> المؤهلات</h6>
                            <textarea type="text" name="qualifications" class="form-control"
                                      aria-label="Amount (to the nearest dollar)">
                        </textarea>
                        </div>


                        <div class="col-12 my-2">
                            <h6 class="text-right input-label"> المميزات</h6>
                            <textarea type="text" name="features" class="form-control"
                                      aria-label="Amount (to the nearest dollar)">
                        </textarea>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning d-flex justify-content-center rounded-pill"
                                    style="padding-bottom: 30px">إضافة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <script>

            $(document).on("click", ".qualifications", function () {
                var id = $(this).data('id');
                $(".modal-content #id").val(id);
            });

            $(document).on("click", ".edite_mem", function () {
                var id = $(this).data('id');
                var title = $(this).data('title');
                var qualifications = $(this).data('qualifications');
                var features = $(this).data('features');


                $(".modal-content #id").val(id);
                $(".modal-content #title").val(title);
                $(".modal-content #qualifications").val(qualifications);
                $(".modal-content #features").val(features);

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

            function deleteAlert($id) {
                swal({
                    title: "هل انت متأكد تريد الحذف؟",
                    text: "سيتم حذف العضوية",
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

                    fetch('/moderator/membership/delete/' + $id)

                        .then(response => response.json()
                            .then(result => {
                                //your result
                                if (result == 'success') {
                                    swal({
                                        title: "تم الحذف",
                                        text: "تم حذف العضوية",
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


        </script>
    @endpush
@endsection

