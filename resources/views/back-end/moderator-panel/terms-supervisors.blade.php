@extends('back-end.moderator-panel.layouts.app')
@section('title' , ' المشرفين')
@push('style')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
@endpush

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="content col-12 d-flex justify-content-between align-items-center my-5">
                <h5 class="title px-2"> المشرفين</h5>
                <div class="d-flex flex-column px-2">
                    <button type="button" class="btn btn-secondary the-button my-1 px-4" data-toggle="modal"
                            data-target="#AddModalCenter">إضافة مشرف
                    </button>
                </div>
            </div>
            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">الاسم</th>
                        <th scope="col">اسم المستخدم</th>
                        <th scope="col">البريد الإلكتروني</th>
                        <th scope="col"> الهاتف</th>
                        <th scope="col"> الصلاحيات</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($rows)
                        @foreach($rows as $row)
                            <tr>
                                <td>{{$row -> name}} </td>
                                <td>{{$row -> username}}</td>
                                <td>
                                    {{$row -> email}}
                                </td>
                                <td>
                                    {{$row -> phone}}
                                </td>
                                <td>
                                    <button type="button" class="update-mod btn btn-warning rounded-pill px-2 px-sm-4 "
                                            onclick="window.location.href='{{route('moderator.add.role',$row -> id)}}'"
                                    >الصلاحيات


                                    </button>
                                </td>
                                <td>
                                    <div>
                                        <button type="button"
                                                class="update-mod btn btn-success rounded-pill px-2 px-sm-4 "
                                                data-toggle="modal" data-target="#EditModalCenter"
                                                data-phone="{{$row -> phone}}" data-username="{{$row -> username}}"
                                                data-name="{{$row -> name}}" data-email="{{$row -> email}}"
                                                data-id="{{$row -> id}}">تعديل
                                        </button>
                                        <button type="button" class="btn btn-danger rounded-pill px-2 px-sm-4"
                                                onclick="deleteAlert({{$row -> id}})">حذف
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

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل بيانات المشرف :</h4>
                </div>
                <div class="modal-body">
                    <form class=" modal-body mx-auto edit-modal-content"
                          action="{{route('moderator.moderators.update')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" name="id" id="id">
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الاسم</h6>
                            <input type="text" name="name" id="name" value="" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">اسم المستخدم</h6>
                            <input type="text" name="username" id="username" value="" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">رقم الهاتف </h6>
                            <input type="text" name="phone" id="phone" value="" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">البريد الالكتروني</h6>
                            <input type="email" name="email" id="email" value="" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label"> كلمة المرور</h6>
                            <input type="password" name="password" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>


                        <div class="modal-footer d-flex justify-content-center">
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" class="btn btn-warning rounded-pill px-5 py-2"
                                >تعديل
                                </button>
                            </div>
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

                    <h4 class="modal-title" style="margin-left: 40%"> اضافة مشرف جديد :</h4>
                </div>


                <div class="modal-body">
                    <form class=" modal-body mx-auto edit-modal-content" method="POST"
                          action="{{route('moderator.moderators.store')}}">
                        @csrf
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الاسم</h6>
                            <input type="text" name="name" required class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">اسم المستخدم</h6>
                            <input type="text" name="username" required class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">رقم الهاتف</h6>
                            <input type="text" name="phone" required class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">البريد الالكتروني</h6>
                            <input type="email" name="email" required class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">كلمة المرور </h6>
                            <input type="password" name="password" required class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>


                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill px-5 py-3"
                            >انشاء
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')

        <script>
            $(document).on("click", ".update-mod", function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var username = $(this).data('username');
                var phone = $(this).data('phone');
                var email = $(this).data('email');

                $(".modal-content #id").val(id);
                $(".modal-content #name").val(name);
                $(".modal-content #username").val(username);
                $(".modal-content #email").val(email);
                $(".modal-content #phone").val(phone);
            });


            function deleteAlert($id) {
                swal({
                    title: "هل انت متأكد تريد الحذف؟",
                    text: "سيتم حذف المشرف",
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

                    fetch('/moderator/moderators/delete/' + $id)

                        .then(response => response.json()
                            .then(result => {
                                //your result
                                if (result == 'success') {
                                    swal({
                                        title: "تم الحذف",
                                        text: "تم حذف المشرف",
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

