@extends('back-end.layouts.app')
@section('title' , 'الهدايا')

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="content col-12 d-flex justify-content-between align-items-center my-5">
                <h5 class="title">برنامج هدايا</h5>
                <div class="d-flex flex-column">
                    <button type="button" class="btn btn-secondary the-button my-1 px-4" data-toggle="modal"
                            data-target="#AddModalCenter">اضافة برنامج هدايا
                    </button>
                </div>
            </div>


            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">الهدية</th>
                        <th scope="col">صورة الهدية</th>
                        <th scope="col">حاله التوفر</th>
                        <th scope="col">فئه العميل</th>
                        <th scope="col">عدد نقاط</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($gifts)
                        @foreach($gifts as $gift)
                            <tr>
                                <td>{{$gift -> name}}</td>
                                <td class="w-25">
                                    <img src="{{$gift -> photo}}" style="object-fit: cover;border-radius: 20px;"
                                         height="200px"/>
                                </td>
                                <td>

                                    <button type="button" class="available-edit btn btn-outline-dark rounded-pill"
                                            data-toggle="modal"
                                            data-target="#available-edit"
                                            data-id="{{$gift -> id}}"
                                    >
                                        {{$gift -> getAvailable()}}
                                    </button>

                                </td>


                                <td>

                                    <button type="button" class="membership-edit btn btn-outline-dark rounded-pill"
                                            data-toggle="modal"
                                            data-target="#membership-edit"
                                            data-id="{{$gift -> id}}"
                                    >
                                        {{$gift -> memberShip ->title}}
                                    </button>

                                </td>
                                <td>
                                    {{$gift -> points}}

                                </td>
                                <td>
                                    <div>
                                        <button type="button"
                                                class="gift-edit btn btn-success rounded-pill px-2 px-sm-4"
                                                data-toggle="modal" data-target="#EditModalCenter"
                                                data-id="{{$gift ->id}}"
                                                data-name="{{$gift ->name}}"
                                                data-points="{{$gift ->points}}"
                                        >
                                            تعديل
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>

                <div>
                    {{$gifts -> links()}}
                </div>
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

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل الهدية :</h4>
                </div>


                <div class="modal-body">
                    <form class=" modal-body mx-auto edit-modal-content" action="{{route('admin.gifts.update')}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="">
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الهدية</h6>
                            <input type="text" name="name" id="name" value="" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">صورة الهدية</h6>
                            <input type="file" name="photo" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">عدد نقاط</h6>
                            <input type="text" name="points" id="points" value="" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button style="display: flex;
                        align-items: center;" type="submit" class="btn btn-warning rounded-pill px-5 py-3"
                            >تحديث
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

                    <h4 class="modal-title" style="margin-left: 40%">اضافة هدية جديدة :</h4>
                </div>


                <div class="modal-body">
                    <form class=" modal-body mx-auto edit-modal-content" action="{{route('admin.gifts.store')}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الهدية</h6>
                            <input type="text" name="name" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">صورة الهدية</h6>
                            <input type="file" name="photo" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">حالة التوفر</h6>
                            <select name="available" id="available" class="know-us w-100 select2">
                                <option value="1">متوافر</option>
                                <option value="0">غير متوافر</option>
                            </select>
                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">فئة العميل </h6>
                            <select name="membership_id" id="membership_id" class="know-us w-100 select2">
                                @foreach(App\Models\Membership::all() as $row)
                                    <option value="{{$row -> id}}">{{$row -> title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">عدد نقاط</h6>
                            <input type="number" name="points" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button
                                style="display: flex;
                        align-items: center;"
                                type="submit" class="btn btn-warning rounded-pill px-5 py-2"
                            >انشاء
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->


    <div class="modal fade" id="membership-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل الهدية :</h4>
                </div>


                <div class="modal-body">
                    <form class=" modal-body mx-auto edit-modal-content"
                          action="{{route('admin.gifts.updateMembership')}}" method="POST">

                        @csrf
                        <input type="hidden" name="id" id="id" value="">


                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">فئة العميل</h6>
                            <select name="membership_id" id="membership_id" class="know-us w-100 select2 col-xl-12">
                                @foreach(App\Models\Membership::all() as $row)
                                    <option value="{{$row -> id}}">{{$row -> title}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="modal-footer d-flex justify-content-center">
                            <button
                                type="submit"
                                class="btn btn-warning rounded-pill">
                                حفظ التغييرات
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="available-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل الهدية :</h4>
                </div>


                <div class="modal-body">
                    <form class=" modal-body mx-auto edit-modal-content"
                          action="{{route('admin.gifts.updateAvailable')}}" method="POST">

                        @csrf
                        <input type="hidden" name="id" id="id" value="">


                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">حالة التوفر</h6>
                            <select name="available" id="available" class="know-us w-100 select2">
                                <option value="1">متوافر</option>
                                <option value="0">غير متوافر</option>
                            </select>
                        </div>


                        <div class="modal-footer d-flex justify-content-center">
                            <button style="display: flex;
                        align-items: center;"
                                    type="submit"
                                    class="btn btn-warning rounded-pill">
                                حفظ التغييرات
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <script>
            $(document).on("click", ".gift-edit", function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var points = $(this).data('points');

                $(".modal-content #id").val(id);
                $(".modal-content #name").val(name);
                $(".modal-content #points").val(points);

            });

            $(document).on("click", ".membership-edit", function () {
                var id = $(this).data('id');

                $(".modal-content #id").val(id);

            });

            $(document).on("click", ".available-edit", function () {
                var id = $(this).data('id');

                $(".modal-content #id").val(id);

            });

        </script>
    @endpush
@endsection
