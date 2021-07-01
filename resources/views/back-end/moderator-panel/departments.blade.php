@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'الأقسام')
@push('styles')
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>
@endpush
@section('content')


    @include('front-end.layouts.includes.alerts.errors')
    @include('front-end.layouts.includes.alerts.success')
    <section id="department-content" class="container" style="padding-top: 100px">
        <div class="d-flex justify-content-between">
            <h5>الاقسام الرئيسية</h5>
            <button type="button" class="btn btn-success rounded-pill px-2 px-sm-4" class="btn rounded"
                    data-toggle="modal"
                    data-target="#add-department">
                اضافه قسم رئيسى
            </button>
        </div>

        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">القسم</th>
                    <th scope="col">عدد الإعلانات</th>
                    <th scope="col">عدد الاقسام الفرعيه</th>
                    <th scope="col">الاقسام الفرعيه</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                </thead>
                <tbody>

                @isset($categories)
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category -> name}} </td>
                            <td>{{$category -> advertising -> count()}}</td>
                            <td>{{$category -> subCategories -> count()}}</td>
                            <td>

                                <button
                                    onclick="window.location.href='{{route('moderator.sub_category' , ['id' => $category -> id])}}'"
                                    class="btn btn-success rounded-pill px-2 px-sm-4 blue-btn border-0 ml-2">
                                    عرض
                                </button>
                                <button type="submit"
                                        class="add-Subcategory btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                        data-toggle="modal" data-target="#add-sub-department"
                                        data-id="{{$category -> id}}">
                                    اضافة
                                </button>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button id="test" type="submit"
                                            class="test btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                            data-toggle="modal" data-target="#edit-department"
                                            data-id="{{ $category -> id }}"
                                            data-name="{{ $category -> name }}">

                                        تعديل
                                    </button>
                                    <button type="submit"
                                            class="btn btn-danger rounded-pill px-2 px-sm-4 red-btn border-0"
                                            onclick="deleteAlert({{$category -> id}})">
                                        حذف
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset

                </tbody>

                {{ $categories->links() }}
            </table>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="add-department" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">
            <div class="modal-content px-3">


                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%">اضافة قسم رئيسي:</h4>
                </div>


                <div class="modal-body">
                    <form action="{{route('moderator.category.store')}}" method="POST">
                        @csrf
                        <div class="px-5 py-3 rounded" style="background-color: #ebebeb;">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="department-name">القسم:</label>
                                    <input type="text" name="name" class="form-control input" id="department-name"
                                           required/>
                                </div>
                            </div>
                            {{--                        <div class="form-row">--}}
                            {{--                            <div class="form-group col-12">--}}
                            {{--                                <label for="number-ads">عدد الإعلانات:</label>--}}
                            {{--                                <input type="number" class="form-control input" id="number-ads" required />--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            {{--                        <div class="form-row">--}}
                            {{--                            <div class="form-group col-12">--}}
                            {{--                                <label for="departments-details">الأقسام الفرعية:</label>--}}
                            {{--                                <select id="departments-details"  class="form-control w-75 h-25 px-3 select2" name="subCategory"--}}
                            {{--                                        style="width: 100%;" multiple>--}}
                            {{--                                    <option class="h-25">اختر الأقسام الفرعية... </option>--}}
                            {{--                                    <option class="h-25" >الاسم1</option>--}}
                            {{--                                    <option class="h-25">الاسم2</option>--}}
                            {{--                                    <option class="h-25">الاسم3</option>--}}
                            {{--                                    <option class="h-25">الاسم4</option>--}}
                            {{--                                    <option class="h-25">الاسم5</option>--}}
                            {{--                                    <option class="h-25">الاسم6</option>--}}
                            {{--                                    <option class="h-25">الاسم7</option>--}}
                            {{--                                    <option class="h-25">الاسم8</option>--}}
                            {{--                                    <option class="h-25">الاسم9</option>--}}
                            {{--                                    <option class="h-25">الاسم10</option>--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
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



    <div class="modal fade" id="edit-department" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered w-75" role="document">
            <div class="modal-content px-3">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل قسم رئيسي:</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('moderator.category.update')}}"
                          method="POST">
                        @csrf
                        <div class="px-5 py-3 rounded" style="background-color: #ebebeb;">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="department-name">القسم:</label>

                                    <input type="text" name="name" value="" class="form-control input" id="name"
                                           required/>
                                    <input type="hidden" name="id" value="" class="form-control input" id="id"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <button id="sub-btn" type="submit"
                                    class="green-btn border-0 btn btn-primary mx-auto w-25 py-2 rounded-pill mt-4">
                                تعديل
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="add-sub-department" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">
            <div class="modal-content px-3">


                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%">اضافة قسم فرعي:</h4>
                </div>


                <div class="modal-body">
                    <form class="contain-form first-form pt-3" action="{{route('moderator.sub_category.store')}}"
                          method="POST">
                        @csrf
                        <div class="px-5 py-3 rounded" style="background-color: #ebebeb;">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="department-name">القسم:</label>
                                    <input type="text" name="name" class="form-control input" id="name" required/>
                                    <input type="hidden" name="id" class="form-control input" id="id" required/>
                                    <input type="hidden" name="page" class="form-control input" id="page" value="1"
                                           required/>
                                </div>
                            </div>
                            {{--                        <div class="form-row">--}}
                            {{--                            <div class="form-group col-12">--}}
                            {{--                                <label for="number-ads">عدد الإعلانات:</label>--}}
                            {{--                                <input type="number" class="form-control input" id="number-ads" required />--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            {{--                        <div class="form-row">--}}
                            {{--                            <div class="form-group col-12">--}}
                            {{--                                <label for="departments-details">الأقسام الفرعية:</label>--}}
                            {{--                                <select id="departments-details"  class="form-control w-75 h-25 px-3 select2" name="subCategory"--}}
                            {{--                                        style="width: 100%;" multiple>--}}
                            {{--                                    <option class="h-25">اختر الأقسام الفرعية... </option>--}}
                            {{--                                    <option class="h-25" >الاسم1</option>--}}
                            {{--                                    <option class="h-25">الاسم2</option>--}}
                            {{--                                    <option class="h-25">الاسم3</option>--}}
                            {{--                                    <option class="h-25">الاسم4</option>--}}
                            {{--                                    <option class="h-25">الاسم5</option>--}}
                            {{--                                    <option class="h-25">الاسم6</option>--}}
                            {{--                                    <option class="h-25">الاسم7</option>--}}
                            {{--                                    <option class="h-25">الاسم8</option>--}}
                            {{--                                    <option class="h-25">الاسم9</option>--}}
                            {{--                                    <option class="h-25">الاسم10</option>--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
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

                    fetch('/moderator/category/delete/' + $id)

                        .then(response => response.json()
                            .then(result => {
                                //your result
                                if (result == 'success') {
                                    swal({
                                        title: "تم الحذف",
                                        text: "تم حذف القسم",
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

            $(document).on("click", ".test", function () {
                var name = $(this).data('name');
                var id = $(this).data('id');
                $(".modal-content #name").val(name);
                $(".modal-content #id").val(id);
            });

            $(document).on("click", ".add-Subcategory", function () {
                var id = $(this).data('id');
                $(".modal-content #id").val(id);
            });


        </script>
    @endpush
@endsection


