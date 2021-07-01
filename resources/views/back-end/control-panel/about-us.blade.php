@extends('back-end.layouts.app')
@section('title' , 'الصفحات ')
@push('styles')
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>
@endpush

@section('content')
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')


    <section id="department-content" class="container" style="padding-top: 100px">
        <div class="d-flex justify-content-between">
            <h5>{{$title}}</h5>
            <button type="button" class="test btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0"
                    class="btn rounden"
                    data-target="#add-content" data-toggle="modal"
            >
                اضافه نص جديد
            </button>
        </div>


        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">النص</th>
                    <th scope="col">الاعدادات</th>
                </tr>
                </thead>
                <tbody>

                @isset($rows)
                    @foreach($rows as $row)
                        <tr>
                            <td>
                                {{substr($row -> content,0,100)."....."}}
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button"
                                            class="content-edit btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                            data-toggle="modal" data-target="#edite-content"
                                            data-id="{{$row -> id}}" data-content1="{{$row -> content}}">
                                        تعديل
                                    </button>
                                    <button type="button"
                                            class="btn btn-danger rounded-pill px-2 px-sm-4 red-btn border-0"
                                            onclick="deleteAlert({{$row -> id }})">
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
    <div class="modal fade" id="add-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-100" role="document">
            <div class="modal-content px-4">


                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> اضافة نص جديد :</h4>
                </div>


                <div class="modal-body">
                    <form style="
                      padding-right: 10px;
                      padding-left: 10px;
                " class="contain-form first-form pt-3 modal-content" action="{{route('admin.pages.store')}}"
                          method="POST">
                        @csrf
                        <input type="hidden" name="page_name" id="page_name" value="{{$page_name}}">
                        <input type="hidden" name="title" id="title" value="{{$title}}">
                        <input type="hidden" name="type" id="type" value="{{$type}}">
                        <div class="px-5 py-4 rounded" style="background-color: #ebebeb;">
                            <div class="row ">
                                <div class="form-group row">
                                    <label style="
                                       width: 360px;
                                       height: 50px;
                                      ">النص (أقصى عدد للحروف مسموح بإضافته 450):</label>
                                    <textarea style="width:100%;height: 200px" name="content"
                                              class="form-control input"
                                              id="content"></textarea>
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

    <div class="modal fade" id="edite-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-100" role="document">
            <div class="modal-content px-4">


                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل النص:</h4>
                </div>


                <div class="modal-body">

                    <form style="
                      padding-right: 10px;
                      padding-left: 10px;
                " class="contain-form first-form pt-3 modal-content" action="{{route('admin.pages.update')}}"
                          method="POST">
                        @csrf
                        <input type="hidden" name="page_name" id="page_name" value="{{$page_name}}">
                        <input type="hidden" name="title" id="title" value="{{$title}}">
                        <input type="hidden" name="type" id="type" value="{{$type}}">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="px-5 py-4 rounded" style="background-color: #ebebeb;">
                            <div class="row ">
                                <div class="form-group row">
                                    <label style="
                                       width: 360px;
                                       height: 50px;
                                      ">النص (أقصى عدد للحروف مسموح بإضافته 450):</label>
                                    <textarea style="width:100%;height: 200px" name="content1"
                                              class="form-control input"
                                              id="content1"></textarea>
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
            $(document).on("click", ".content-edit", function () {
                var id = $(this).data('id');
                var content1 = $(this).data('content1');
                $(".modal-content #id").val(id);
                $(".modal-content #content1").val(content1);

            });

            function deleteAlert($id) {

                swal({
                    title: "هل انت متأكد تريد الحذف؟",
                    text: "سيتم حذف النص",
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

                    fetch('/admin/pages/delete/' + $id)

                        .then(response => response.json()
                            .then(result => {
                                //your result
                                if (result == 'success') {
                                    swal({
                                        title: "تم الحذف",
                                        text: "تم حذف النص",
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

