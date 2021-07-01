@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'الرئيسية')
@push('style')
    <link rel="stylesheet" href="{{ asset('back-end/css/main.css')}}"/>
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
@endpush

@section('content')
    <section id="main" class="mt-5 container">
        <div class="d-flex flex-wrap justify-content-center">
            <div class="main-card shadow-sm text-center pt-3 pb-1 px-3 ml-3 mt-3">
                <h5>عدد الطلبات بإنتظار التفعيل</h5>
                <h1 class="my-3">{{App\Models\Advertising::where('status' , 1) -> count()}}</h1>
                <h6>طلب</h6>
            </div>
            <div class="main-card shadow-sm text-center pt-3 pb-1 px-3 ml-3 mt-3">
                <h5>عدد الإعلانات</h5>
                <h1 class="my-3">{{App\Models\Advertising::get() -> count()}}</h1>
                <h6>إعلان</h6>
            </div>
            <div class="main-card shadow-sm text-center pt-3 pb-1 px-3 ml-3 mt-3">
                <h5> عدد الزوار </h5>
                <h1 class="my-3">{{ VisitLog::all()->count()}}</h1>
                <h6>زائر</h6>
            </div>
            <div class="main-card shadow-sm text-center pt-3 pb-1 px-3 ml-3 mt-3">
                <h5>عدد العملاء المسجلين</h5>
                <h1 class="my-3">{{App\Models\Advertiser::get() -> count()}}</h1>
                <h6>عميل</h6>
            </div>
            <div class="main-card shadow-sm text-center pt-3 pb-1 px-3 ml-3 mt-3">
                <h5>طلبات الاستشاره</h5>
                <h1 class="my-3">{{App\Models\Consultation::get() -> count()}}</h1>
                <h6>طلب</h6>
            </div>
            <div class="main-card shadow-sm text-center pt-3 pb-1 px-3 ml-3 mt-3">
                <h5>العمولات المدفوعة</h5>
                <h1 class="my-3">{{App\Models\Money_Transfer::get() -> count()}}</h1>
                <h6>عمولة</h6>
            </div>
        </div>
        <div id="main-details" class="d-flex flex-wrap mt-5 mb-4">
            <button id="recent-ads" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill active">
                آخر الإعلانات
            </button>
            <button id="wait-orders" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill">
                طلبات بانتظار التفعيل
            </button>
            <button id="review-works" class="btn btn-primary px-3 ml-3 mt-3 rounded-pill">
                عمولات بانتظار المراجعة
            </button>
        </div>
        <!-- Cards ad -->
        <div id="ad-cards-section" class="row mt-5">

            @isset($rows)
                @foreach($rows as $row)
                    <div class="col-12 col-xl-3 col-lg-4 col-sm-6">
                        <div class="card mt-3">
                            <div class="head-card align-items-end d-flex justify-content-end"

                                 @if(json_decode($row->photos) != null)

                                 style="background-image: url({{ asset('front-end/'.json_decode($row->photos)[0])}});">
                                @else

                                    style="background-image:
                                    url({{ asset( 'front-end/images/advertising-images/no_image.png') }} );">
                                @endif

                            </div>
                            <div class="body-card px-3">
                                <div class="d-flex justify-content-between mt-3">
                                    <h6>{{$row -> title}}</h6>
                                </div>
                                <div class="d-flex body-card-icon">
                                    <div class="d-flex ml-4 align-items-center">
                                        <i class="far fa-user ml-2"></i>
                                        <p>{{$row -> advertiser -> name}}</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt ml-2"></i>
                                        <p>{{$row -> cityAdvertising -> name}}</p>
                                    </div>
                                </div>
                                <p class="mt-3 content-card-text">
                                    {{$row -> description}}
                                </p>
                                <h6>{{$row -> price}} ريال </h6>
                                <div class="d-flex time-publish align-items-center">
                                    <i class="far fa-clock" aria-hidden="true"></i>
                                    <p class="mr-1">
                                        @php
                                            \Carbon\Carbon::setLocale('ar');
                                        @endphp
                                        {{ \Carbon\Carbon::parse($row->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="mb-2 py-1 button-group py-3 px-1">

                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-outline-info rounded-pill"
                                            data-toggle="modal" type="button"
                                            onclick="window.location.href='{{route('moderator.advertise', $row ->id)}}'">

                                        <div class="row inside-button px-2">
                                            <p class="my-0 mx-1">تفاصيل الاعلان </p></div>
                                    </button>
                                </div>
                                <button onclick="deleteAlert({{$row -> id}})" type="submit"
                                        class="btn btn-outline-info rounded-pill">


                                    <div class="row inside-button px-2">
                                        <i class="fas fa-trash" style="color: #ef5252;"></i>
                                        <p class="my-0 mx-1">
                                            حذف
                                        </p>
                                    </div>

                                </button>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>

        <!-- wait orders -->
        <div id="wait-orders-section" class="d-none">
            <!-- table -->

            <div class="table-responsive mt-5">
                <table class="table  table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">اسم الاعلان</th>
                        <th scope="col">اسم المعلن</th>
                        <th scope="col">رقم الجوال</th>
                        <th scope="col">البريد الإلكتروني</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($rowss)
                        @foreach($rowss as $row1)
                            <tr>
                                <td>{{$row1 -> title}}</td>
                                <td> {{$row1 -> advertiser -> name}}</td>
                                <td> {{$row1 -> advertiser -> phone}}</td>
                                <td> {{$row1 -> advertiser -> email}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button"
                                                class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                data-toggle="modal" type="button"
                                                onclick="window.location.href='{{route('moderator.advertise', $row ->id)}}'">
                                            تفاصيل الاعلان
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

        <!-- review works -->
        <div id="review-works-section" class="d-none">
            <!-- table -->
            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">اسم الحوالة</th>
                        <th scope="col">اسم المعلن</th>
                        <th scope="col"> الاعلان</th>
                        <th scope="col"> الهاتف</th>
                        <th scope="col"> الايميل</th>
                        <th scope="col"> العمولة</th>
                        <th scope="col"> المرفقات</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($data)
                        @foreach($data as $row)
                            <tr>
                                <td>{{$row ->  bank_name}}</td>
                                <td>{{$row -> name}}</td>
                                <td>{{$row -> advertising -> title}}</td>
                                <td>{{$row -> phone}}</td>
                                <td>{{$row -> email}}</td>
                                <td>{{$row -> money}}</td>
                                <td><a href="{{$row -> files}}" download="bank"><i class="fa fa-download"
                                                                                   aria-hidden="true"></i></a></td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <button type="submit"
                                                onclick="window.location.href='{{route('moderator.commission.update',$row ->id)}}'"
                                                class="btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2">
                                            تأكيد
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

    <!-- <div
        class="modal fade"
        id="exampleModalCenter"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
              <h4 class="modal-title">تعديل المعلن</h4>
            </div>
            <div class="row modal-body mx-auto edit-modal-content">
              <div class="col-6 my-2">
                <h6 class="text-right input-label">الاسم</h6>
                <input
                  type="text"
                  class="form-control"
                  aria-label="Amount (to the nearest dollar)"
                />
              </div>
              <div class="col-6 my-2">
                <h6 class="text-right input-label">البريد المعلن</h6>
                <input
                  type="text"
                  class="form-control"
                  aria-label="Amount (to the nearest dollar)"
                />
              </div>
              <div class="col-6 my-2">
                <h6 class="text-right input-label">الجوال</h6>
                <input
                  type="text"
                  class="form-control"
                  aria-label="Amount (to the nearest dollar)"
                />
              </div>
              <div class="col-6 my-2">
                <h6 class="text-right input-label">العنوان</h6>
                <input
                  type="text"
                  class="form-control"
                  aria-label="Amount (to the nearest dollar)"
                />
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button
                type="button"
                class="btn btn-warning rounded-pill px-5 py-2"
                data-dismiss="modal"
              >
                تعديل
              </button>
            </div>
          </div>
        </div>
      </div> -->

    <!-- Modal -->
    <div class="modal fade" id="add-package" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h4 class="modal-title">إضافة باقة للإعلان عقار:</h4>
                </div>
                <div class="row modal-body mx-auto edit-modal-content">
                    <div class="col">
                        <h6 class="text-right input-label">باقة الأعلان:</h6>
                        <select id="first-num" class="form-control w-75 h-25 px-3 select2" name="first-num"
                                style="width: 100%;">
                            <option class="h-25">اختر باقه...</option>
                            <option class="h-25">الاسم1</option>
                            <option class="h-25">2الاسم</option>
                            <option class="h-25">3الاسم</option>
                            <option class="h-25">4الاسم</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-warning rounded-pill px-5 py-2" data-dismiss="modal">
                        اضف الباقه
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->

    @push('js')
        <script>
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

                    fetch('/moderator/advertising/delete/' + $id)

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

        </script>
    @endpush

@endsection


