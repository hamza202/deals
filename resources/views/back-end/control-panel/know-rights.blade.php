@extends('back-end.layouts.app')
@section('title' , 'اعرف حقك')

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="content col-12 d-flex justify-content-between align-items-center my-5">
                <h5 class="title"> اعرف حقك</h5>
                <div class="d-flex flex-column">
                    <button type="button" class="btn btn-secondary the-button my-1 px-4" data-toggle="modal"
                            data-target="#AddModalCenter">اضافة حق جديد
                    </button>
                    <button type="button" class="btn btn-secondary the-button my-1 px-4"
                            onclick="window.location.href='{{route('admin.attachmentKnowRights')}}'">المرفقات
                    </button>
                </div>
            </div>


            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">الصورة</th>
                        <th scope="col">العنوان</th>
                        <th scope="col"> الوصف</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($rows)
                        @foreach($rows as $row)
                            <tr>

                                <td class="w-25">
                                    <img src="{{$row -> photo}}"
                                         style="object-fit: cover;border-radius: 20px; width: 60px;height: 60px"
                                         height="20%"/>
                                </td>
                                <td>{{$row ->title }}</td>
                                <td>{{$row ->content}}</td>
                                <td>

                                    <button type="button" class="right-edit btn btn-success rounded-pill"
                                            data-toggle="modal"
                                            data-target="#EditModalCenter"
                                            data-id="{{$row -> id}}"
                                            data-title="{{$row -> title}}"
                                            data-conten1="{{$row -> content}}"
                                    >
                                        تعديل
                                    </button>

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


    <div class="modal fade" id="AddModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> اضافة حق جديد :</h4>
                </div>


                <div class="modal-body">
                    <form class=" modal-body mx-auto edit-modal-content" action="{{route('admin.know-right.store')}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">العنوان</h6>
                            <input type="text" name="title" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الوصف</h6>
                            <textarea name="content1" class="form-control"
                                      aria-label="Amount (to the nearest dollar)"></textarea>
                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الصورة </h6>
                            <input type="file" name="photo" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button
                                style="display: flex;
                        align-items: center;"
                                type="submit" class="btn btn-warning rounded-pill px-5 py-3"
                            >حفظ
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->


    <div class="modal fade" id="EditModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل الحق :</h4>
                </div>


                <div class="modal-body">
                    <form class=" modal-body mx-auto edit-modal-content" action="{{route('admin.know-right.update')}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="">
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">العنوان</h6>
                            <input type="text" name="title" id="title" value="" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الوصف</h6>
                            <textarea placeholder="" name="content1" id="content1" class="form-control"></textarea>
                        </div>


                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الصورة </h6>
                            <input type="file" name="photo" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button style="display: flex;
                        align-items: center;" type="submit" class="btn btn-warning rounded-pill"
                            >تحديث
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal2 -->


    @push('js')
        <script>
            $(document).on("click", ".right-edit", function () {
                var id = $(this).data('id');
                var title = $(this).data('title');
                var content1 = $(this).data('content1');

                $(".modal-content #id").val(id);
                $(".modal-content #title").val(title);
                $(".modal-content #content1").val(content1);

            });


        </script>
    @endpush

@endsection
