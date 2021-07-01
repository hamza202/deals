@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'الاعلانات الممولة')
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
            <h5>الاعلانات الممولة</h5>
            <button type="button" class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0"
                    class="btn rounden"
                    data-toggle="modal" data-target="#add-city">
                اضافه اعلان
            </button>
        </div>

        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">الصورة</th>
                    <th scope="col">الرابط</th>
                    <th scope="col">الموقع</th>
                    <th scope="col">الحالة</th>
                    <th scope="col">تاريخ البداية</th>
                    <th scope="col">تاريخ النهاية</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                </thead>
                <tbody>
                @isset($rows)
                    @foreach($rows as $row)
                        <tr>
                            <td>
                                <img src="{{$row -> photo}}"
                                     style="object-fit: cover;border-radius: 20px;"
                                     height="100px" width="100px"/>
                            </td>
                            <td>
                                <a href="{{$row->url}}"><i class="fa fa-link"></i></a>
                            </td>
                            <td>
                                @if($row->position == 1)
                                    الرئيسية (180*1140)
                                @else
                                    الرئيسية (435*270)
                                @endif
                            </td>
                            <td>
                             {{statusDate($row->id)}}
                            </td>
                            <td> {{$row->start_date}}</td>
                            <td> {{$row->end_date}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
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
                {{ $rows->links() }}

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

                    <h4 class="modal-title" style="margin-left: 40%"> إضافة اعلان جديد :</h4>
                </div>


                <form class="form" action="{{route('moderator.sponsored.store')}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row modal-body mx-auto edit-modal-content">
                        <div class="row col-md-12">
                            <label for="input-add-city" class="text-right input-label"> الصورة:</label>
                            <input id="input-add-city" name="photo" type="file" class="form-control" required/>
                        </div>

                        <div class="row col-md-12">
                            <label for="input-add-city" class="text-right input-label"> الرابط:</label>
                            <input id="input-add-city" name="url" type="url" class="form-control" required/>
                        </div>

                        <div class="row col-md-12">
                            <label for="input-add-city" class="text-right input-label"> الموقع:</label>
                            <select name="position" id="position" class="form-control selectColor w-100" required>
                                <option value="" disabled selected hidden>اختر</option>
                                <option value="0">الرئيسية(435*270)</option>
                                <option value="1">الرئيسية(180*1140)</option>
                            </select>
                        </div>

                        <div class="row col-md-12">
                            <label for="input-add-city" class="text-right input-label"> تاريخ البداية:</label>
                            <input id="input-add-city" name="start_date" type="date" class="form-control" required/>
                        </div>

                        <div class="row col-md-12">
                            <label for="input-add-city" class="text-right input-label"> تاريخ النهاية:</label>
                            <input id="input-add-city" name="end_date" type="date" class="form-control" required/>
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

                    fetch('/admin/sponsored/delete/' + $id)

                        .then(response => response.json()
                            .then(result => {
                                //your result
                                if (result == 'success') {
                                    swal({
                                        title: "تم الحذف",
                                        text: "تم حذف الاعلان",
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
                $(".modal-content #id").val(id);
                $(".modal-content #name").val(name);
            });

        </script>
    @endpush

@endsection
