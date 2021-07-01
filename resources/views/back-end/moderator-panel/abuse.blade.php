@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'الاساءات')
@push('styles')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>

@endpush
@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')


    <section id="department-content" class="container" style="padding-top: 100px">
        <div class="d-flex justify-content-between">
            <h5>الاساءات</h5>
        </div>

        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">المعلن</th>
                    <th scope="col">العنوان</th>
                    <th scope="col">نوع الاساءة</th>
                    <th scope="col">تفاصيل الاساءة</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                </thead>
                <tbody>
                @isset($rows)
                    @foreach($rows as $row)
                        <tr>
                            <td> {{$row -> advertiser -> name}}</td>
                            <td> {{$row -> address}}</td>
                            <td> {{$row -> abuse_type}}</td>
                            <td> {{$row -> comment}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                            class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                            data-toggle="modal" data-target="#edit-city"
                                            data-id="{{$row -> advertiser -> id}}" data-abous="{{$row ->  id}}">
                                        الرد
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset
                </tbody>
            </table>
            {{$rows -> links()}}
        </div>
    </section>

    <div class="modal fade" id="edit-city" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> ارسال الرد :</h4>
                </div>


                <div class="modal-body">
                    <form class="form" action="{{route('moderator.abuseAnswer')}}" method="POST">
                        @csrf
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> اضف الرد:</label>
                                <input id="name" name="name" type="text" class="form-control"/>
                                <input id="id" value="" name="id" type="hidden" class="form-control"/>
                                <input id="abous" value="" name="abous" type="hidden" class="form-control"/>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                ارسال
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>



    @push('js')
        <script>
            function deleteAlert($id) {
                swal({
                    title: "هل انت متأكد تريد الحذف؟",
                    text: "سيتم حذف التبليغ",
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

                    fetch('/moderator/consulting/abuse/delete/' + $id)

                        .then(response => response.json()
                            .then(result => {
                                //your result
                                if (result == 'success') {
                                    swal({
                                        title: "تم الحذف",
                                        text: "تم حذف التبليغ",
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

            $(document).on("click", ".update-city", function () {
                var id = $(this).data('id');
                var abous = $(this).data('abous');
                $(".modal-content #id").val(id);
                $(".modal-content #abous").val(abous);
            });
        </script>

    @endpush
@endsection
