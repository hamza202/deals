@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'السلايدر')
@push('styles')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
@endpush

@section('content')
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section id="department-content" class="container" style="padding-top: 100px">
        <div class="d-flex justify-content-between">
            <h5>السلايدر</h5>

            <button type="button" class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0"
                    class="btn rounden"
                    data-toggle="modal" data-target="#add-slider">
                اضافه سلايدر
            </button>

        </div>
        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">الصورة</th>

                    <th scope="col">الوصف</th>
                    <th scope="col">رابط</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                </thead>
                <tbody>
                @isset($rows)
                    @foreach($rows as $row)
                        <tr>
                            <td>
                                <img src="{{$row -> photo}}" alt="slider" style="width: 80px;height: 80px;">
                            </td>

                            <td>
                                @if($row -> description)
                                    {{substr($row -> description,0,100)."....."}}
                                @endif
                            </td>

                            <td>
                                {{$row -> link}}
                            </td>

                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                            class="edite-slider btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                            data-toggle="modal" data-target="#edite-slider"
                                            data-id="{{$row->id}}">
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


    <div class="modal fade" id="add-slider" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> إضافة سلايدر جديد :</h4>
                </div>


                <div class="modal-body">
                    <form class="form" action="{{route('moderator.sliders.store')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label class="text-right input-label">الوصف : </label>
                                <textarea id="input-add-city" style=" width:100% ; height: 100px " name="description"
                                          class="form-control"></textarea>
                            </div>
                            @error('description')
                            <div class="row mr-2 ml-2">
                                <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                                        id="type-error">{{$message}}
                                </button>
                            </div>
                            @enderror

                            <div class="col">
                                <label class="text-right input-label">رابط : </label>
                                <input id="input-add-city" name="link" class="form-control">
                            </div>

                            <div class="col">
                                <label class="text-right input-label">الصورة:</label>
                                <input name="photo" type="file" class="form-control"/>
                            </div>
                            @error('photo')
                            <div class="row mr-2 ml-2">
                                <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                                        id="type-error">{{$message}}
                                </button>
                            </div>
                            @enderror

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


    <div class="modal fade" id="edite-slider" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل السلايدر :</h4>
                </div>


                <div class="modal-body">
                    <form class="form" action="{{route('moderator.sliders.update')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col modal-body mx-auto edit-modal-content">
                            <input type="hidden" value="" name="id" id="id">
                            <div class="col">
                                <label class="text-right input-label">الوصف : </label>
                                <textarea id="input-add-city" style=" width:100% ; height: 100px " name="description"
                                          class="form-control"> </textarea>
                            </div>

                            <div class="col">
                                <label class="text-right input-label">رابط : </label>
                                <input name="link" class="form-control">
                            </div>

                            <div class="col">
                                <label class="text-right input-label">الصورة:</label>
                                <input name="photo" type="file" class="form-control" value=""/>
                            </div>


                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تحديث
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @push('js')
        <script>
            $(document).on("click", ".edite-slider", function () {
                var id = $(this).data('id');
                $(".modal-content #id").val(id);
                console.log(id);
            });


            function deleteAlert($id) {
                swal({
                    title: "هل انت متأكد تريد الحذف؟",
                    text: "سيتم حذف السلايدر",
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

                    fetch('/moderator/pages/sliders/delete/' + $id)

                        .then(response => response.json()
                            .then(result => {
                                //your result
                                if (result == 'success') {
                                    swal({
                                        title: "تم الحذف",
                                        text: "تم حذف السلايدر",
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

