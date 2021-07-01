@extends('back-end.layouts.app')
@section('title' , 'المعلنين')

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section class="container my-5">
        <div class="row">
            <div class="row col-12 justify-content-center">
                <div class="content col-12 d-flex justify-content-between my-5">
                    <h5 class="title">المعلنين</h5>
                    <button type="button" class="btn btn-secondary the-button px-4" data-toggle="modal"
                            data-target="#AddModalCenter">إضافة معلن
                    </button>
                </div>
                <h6 class="col-12 d-flex special-result-title">تخصيص النتائج</h6>
            </div>
            <div class="w-100 mx-auto d-flex align-items-center row specialize-result my-3">
                <form class="w-100 mx-auto d-flex align-items-center row specialize-result my-3"
                      action="{{route('admin.advertiser.search')}}" method="POST">
                    @csrf
                    <input type="hidden" name="filter" value="0">
                    <div class="w-100 d-flex col-12 col-lg-3 my-3">
                        <label class="select-title d-flex justify-content-center align-items-center w-100">الاسم</label>
                        <input type="text" id="name" value="{{$name}}" class="form-control w-100 h-25 px-4" name="name"
                               style="width: 100%;">
                    </div>
                    <div class="w-100 d-flex col-12 col-lg-3 my-3">
                        <label
                            class="select-title d-flex justify-content-center align-items-center w-100">المدينة</label>
                        <select id="city_id" class="form-control w-100 h-25 px-4 select2" name="city_id"
                                style="width: 100%;">
                            @foreach(App\Models\City::all() as $city)
                                <option value="{{$city -> id}}" class="h-25">{{$city -> name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-100 d-flex col-12 col-lg-3 my-3">
                        <label
                            class="select-title d-flex justify-content-center align-items-center w-75">العضوية</label>
                        <select id="membership_id" class="form-control w-100 h-25 px-4 select2" name="membership_id"
                                style="width: 100%;">
                            @foreach(App\Models\Membership::all() as $data)
                                <option value="{{$data -> id}}" class="h-25">{{$data -> title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-100 d-flex col-12 col-lg-3 my-3">
                        <button type="submit" class="rounded-pill btn btn-dark w-75 h-25 px-2">ابحث</button>
                    </div>
                </form>
            </div>
            <!-- table -->


            @if($advertisers ->count()>0)
                <div class="table-responsive mt-5">
                    <table class="table table-striped table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col">اسم المعلن</th>
                            <th scope="col">رقم الجوال</th>
                            <th scope="col">العضوية</th>
                            <th scope="col" class="text-center">عدد
                                النقاط
                            </th>
                            <th scope="col" class="text-center">تاريخ
                                التسجيل
                            </th>
                            <th scope="col" class="text-center">
                                الاعدادات
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($advertisers as $advertiser)
                            <tr>
                                <td> {{$advertiser -> name}}</td>
                                <td>
                                    {{$advertiser -> phone}}
                                </td>
                                <td>
                                    <button type="button" class="membership-edit btn btn-outline-dark rounded-pill"
                                            data-toggle="modal"
                                            data-target="#membership-edit"
                                            data-id="{{$advertiser -> id}}"
                                    >
                                        {{$advertiser -> advertiserMembership -> title}}
                                    </button>
                                </td>
                                <td>
                                    <?php
                                    $sum = 0;
                                    foreach ($advertiser->advertiserPoints as $point)
                                        $sum += $point->num_points;
                                    ?>
                                    {{$sum}}
                                </td>
                                <td>
                                    {{$advertiser -> created_at}}
                                </td>
                                <td>
                                    <div>
                                        <button type="button" class="mai btn btn-success rounded-pill"
                                                data-toggle="modal"
                                                data-target="#EditModalCenter"
                                                data-id="{{$advertiser -> id}}"
                                                data-name="{{$advertiser -> name}}"
                                                data-username="{{$advertiser -> username}}"
                                                data-phone="{{$advertiser -> phone}}"
                                                data-email="{{$advertiser -> email}}"
                                                data-membership_id="{{$advertiser -> membership_id}}"
                                                data-city_id="{{$advertiser -> city_id}}"
                                                data-address="{{$advertiser -> address}}"


                                        >تعديل
                                        </button>


                                        <button type="submit"
                                                class="btn btn-danger rounded-pill px-2 px-sm-4 red-btn border-0"
                                                onclick="deleteAlert({{$advertiser -> id}})">
                                            حذف
                                        </button>
                                        <button type="button" class="membership-edit1 btn btn-secondary rounded-pill"
                                                data-toggle="modal"
                                                data-target="#membership-edit1"
                                                data-id="{{$advertiser -> id}}"
                                        >
                                            اضافة نقاط
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $advertisers->links() }}
                    </div>
                </div>

            @else
                <h6 class="col-12 d-flex special-result-title" style="margin: 50px">لا يوجد اي نتائج</h6>
            @endif
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="EditModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل المعلن :</h4>
                </div>


                <div class="modal-body">
                    <form class="row modal-body mx-auto edit-modal-content"
                          action="{{route('admin.advertisers.update')}}"
                          method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="">

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
                            <h6 class="text-right input-label">بريد المعلن</h6>
                            <input type="email" name="email" id="email" value="" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الجوال</h6>
                            <input type="text" name="phone" id="phone" value="" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">العنوان</h6>
                            <input type="text" name="address" id="address" value="" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">

                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button style="display: flex;
                        align-items: center;"
                                    type="submit"
                                    class="btn btn-warning rounded-pill px-5 py-4">
                                حفظ التغييرات
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="membership-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل العضوية :</h4>
                </div>


                <div class="modal-body">
                    <form class="row modal-body mx-auto edit-modal-content"
                          action="{{route('admin.advertisers.updateMembership')}}" method="POST">

                        @csrf
                        <input type="hidden" name="id" id="id" value="">


                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">العضوية</h6>
                            <select name="membership_id" id="membership_id" class="know-us w-100 select2">
                                @foreach(App\Models\Membership::all() as $row)
                                    <option value="{{$row -> id}}">{{$row -> title}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="modal-footer d-flex justify-content-center">
                            <button style="display: flex;
                        align-items: center;"
                                    type="submit"
                                    class="btn btn-warning rounded-pill px-5 py-4">
                                حفظ التغييرات
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="membership-edit1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> اضافة نقاط :</h4>
                </div>


                <div class="modal-body">
                    <form class="row modal-body mx-auto edit-modal-content"
                          action="{{route('admin.advertisers.updatePoints')}}" method="POST">

                        @csrf
                        <input type="hidden" name="id" id="id" value="">


                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">النقاط</h6>
                            <input type="number" name="numPoints" id="numPoints" class="form-control cpl-md-12">

                            <h6 class="text-right input-label">السبب</h6>

                            <input type="text" name="activity" id="activity" class="form-control cpl-md-12">

                        </div>


                        <div class="modal-footer d-flex justify-content-center">
                            <button style="display: flex;
                        align-items: center;"
                                    type="submit"
                                    class="btn btn-warning rounded-pill px-5 py-4">
                                حفظ التغييرات
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

                    <h4 class="modal-title" style="margin-left: 40%"> اضافة معلن جديد :</h4>
                </div>


                <div class="modal-body">
                    <form class=" modal-body mx-auto edit-modal-content"
                          action="{{route('admin.advertisers.store')}}"
                          method="POST">
                        @csrf
                        <input type="hidden" name="id" value="1">
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الاسم</h6>
                            <input type="text" name="name" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">

                        </div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">اسم المستخدم</h6>
                            <input type="text" name="username" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">

                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">البريد الالكتروني</h6>
                            <input type="email" name="email" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">

                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">الجوال</h6>
                            <input type="text" name="phone" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">

                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">كلمة المرور</h6>
                            <input type="password" name="password" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">اعادة كلمة المرور</h6>
                            <input type="password" name="password_confirmation" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">

                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">المدينة</h6>
                            <select name="city_id" id="city_id" class="know-us w-100 select2">
                                @foreach(App\Models\City::all() as $row)
                                    <option value="{{$row -> id}}">{{$row -> name}}</option>
                                @endforeach
                            </select></div>

                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">العضوية</h6>
                            <select name="membership_id" id="membership_id" class="know-us w-100 select2">
                                @foreach(App\Models\Membership::all() as $row)
                                    <option value="{{$row -> id}}">{{$row -> title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill px-5 py-2"
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

            $(document).on("click", ".mai", function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var username = $(this).data('username');
                var phone = $(this).data('phone');
                var email = $(this).data('email');
                var address = $(this).data('address');
                var membership_id = $(this).data('membership_id');
                var city_id = $(this).data('city_id');

                $(".modal-content #id").val(id);
                $(".modal-content #name").val(name);
                $(".modal-content #username").val(username);
                $(".modal-content #phone").val(phone);
                $(".modal-content #email").val(email);
                $(".modal-content #address").val(address);
                $(e.currentTarget).find('input[name="membership_id"]').val(membership_id);
                $(e.currentTarget).find('input[name="city_id"]').val(city_id);
            });


            $(document).on("click", ".membership-edit", function () {
                var id = $(this).data('id');

                $(".modal-content #id").val(id);

            });

            $(document).on("click", ".membership-edit1", function () {
                var id = $(this).data('id');

                $(".modal-content #id").val(id);

            });


            function deleteAlert($id) {
                swal({
                    title: "هل انت متأكد تريد الحذف؟",
                    text: "سيتم حذف المعلن",
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

                    fetch('/admin/advertisers/delete/' + $id)

                        .then(response => response.json()
                            .then(result => {
                                //your result
                                if (result == 'success') {
                                    swal({
                                        title: "تم الحذف",
                                        text: "تم حذف المعلن",
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
