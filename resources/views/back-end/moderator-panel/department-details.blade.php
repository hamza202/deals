@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'الاقسام الفرعية')
@push('styles')
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>
@endpush
@section('content')


    <section id="department-content" class="container" style="padding-top: 100px">
        <div class="d-flex justify-content-between">
            <h5>الاقسام الفرعية ل{{ $main_category -> name }}</h5>
            <button type="button" class="test btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0"
                    class="btn rounden"
                    data-target="#add-department-details" data-toggle="modal"
                    data-id="{{ $main_category -> id }}">
                اضافه قسم فرعي
            </button>
        </div>


    @include('front-end.layouts.includes.alerts.errors')
    @include('front-end.layouts.includes.alerts.success')

    <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">القسم</th>
                    <th scope="col">عدد الإعلانات</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                </thead>
                <tbody>

                @isset($sub_categories)
                    @foreach($sub_categories as $sub_category)
                        <tr>
                            <td>{{$sub_category -> name}}</td>
                            <td>{{$sub_category -> advertisingSubCategory -> count()}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button"
                                            class="test_update btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                            data-toggle="modal" data-target="#update-department-details"
                                            data-id="{{$sub_category -> id}}" data-name="{{$sub_category -> name}}"
                                            data-parent="{{ $main_category -> id }}">
                                        تعديل
                                    </button>
                                    <button type="submit"
                                            class="btn btn-danger rounded-pill px-2 px-sm-4 red-btn border-0"
                                            onclick="deleteAlert({{$sub_category -> id}})">
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
    </section>

    <!-- Modal -->
    <div class="modal fade" id="add-department-details" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">
            <div class="modal-content px-3">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> اضافة قسم فرعي:</h4>
                </div>

                <div class="modal-body">
                    <form class="contain-form first-form pt-3" action="{{route('moderator.sub_category.store')}}"
                          method="POST">
                        @csrf
                        <div class="px-5 py-3 rounded" style="background-color: #ebebeb;">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="department-name">القسم:</label>
                                    <input type="hidden" id="id" name="id" value="">
                                    <input type="hidden" name="page" class="form-control input" id="page" value="2"
                                           required/>
                                    <input type="text" name="name" class="form-control input" id="department-name"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <button id="sub-btn" type="submit"
                                    class="green-btn border-0 btn btn-primary mx-auto w-25 py-2 rounded-pill mt-4">
                                حفظ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="update-department-details" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">
            <div class="modal-content px-3">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل قسم فرعي:</h4>
                </div>

                <div class="modal-body">

                    <form action="{{route('moderator.sub_category.update')}}"
                          method="POST">
                        @csrf
                        <div class="px-5 py-3 rounded" style="background-color: #ebebeb;">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="department-name">القسم:</label>
                                    <input type="hidden" id="id" name="id" value="">
                                    <input type="hidden" id="parent_id" name="parent_id" value="">
                                    <input type="text" name="name" class="form-control input" id="name" value=""
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <button id="sub-btn" type="submit"
                                    class="green-btn border-0 btn btn-primary mx-auto w-25 py-2 rounded-pill mt-4">
                                حفظ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <script>

            $(document).on("click", ".test", function () {
                var id = $(this).data('id');
                $(".modal-content #id").val(id);
            });

            $(document).on("click", ".test_update", function () {
                var id = $(this).data('id');
                var parent_id = $(this).data('parent');
                var name = $(this).data('name');
                $(".modal-content #id").val(id);
                $(".modal-content #parent_id").val(parent_id);
                $(".modal-content #name").val(name);
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
                    text: "سيتم حذف القسم",
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

                    fetch('/moderator/subCategory/deleteSubCategory/' + $id)

                        .then(response => response.json()
                            .then(result => {
                                //your result
                                if (result == 'success') {
                                    swal({
                                        title: "تم الحذف",
                                        text: "تم حذف القسم الفرعي",
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

        </script>
    @endpush
@endsection

