@extends('front-end.layouts.app')
@section('title' , ' الصفحة الشخصية')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/profile.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front-end/css/responsive.css')}}"/>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    @isset($messeges)
        <script>
            window.onload = function () {
                document.getElementById('chat').click();
            }
        </script>
    @endisset
@endpush

@section('content')

    <section class="container-fluid">
        <div class="row">
            <div class="profile-head">
                <div class="d-flex site-page px-5">
                    <p class="title">الملف الشخصي</p>
                    <a type="button" data-toggle="modal" data-target="#report" style="margin: auto">
                        <i class="fas fa-flag flag"></i>
                    </a>
                </div>

                @include('front-end.layouts.includes.alerts.errors')
                @include('front-end.layouts.includes.alerts.success')


                <div style="display: flex; justify-content: center;">
                    <div class="user-details">
                        <div class="img-fluid">
                            <p class="profile-title-with-image mt-2">الملف الشخصي</p>
                            <img width="100px" class="rounded-circle" height="100px" src="{{ advertiser()->photo}}"/>
                        </div>
                        <div class="admin-and-flag align-items-baseline" style="padding: 10px;margin: 30px">
                            <h3 class="admin">{{ advertiser()-> name}}</h3>
                            <a type="button" data-toggle="modal" data-target="#report" style="margin-top: 20%">
                                <i class="fas fa-flag flag"></i>
                            </a>
                        </div>
                        <div>
                            @if(advertiserRating() == 5)
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star ml-2 full-star star-icon"></i>

                            @elseif(advertiserRating()  == 4)
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>


                            @elseif(advertiserRating()  == 3)
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>


                            @elseif(advertiserRating()  == 2)
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>


                            @elseif(advertiserRating()  == 1)
                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>


                            @else
                                <i class="fas fa-star empty-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>
                                <i class="fas fa-star empty-star star-icon"></i>

                            @endif
                        </div>


                        <div class="details my-4">
                            <a
                                type="button"
                                data-toggle="modal"
                                data-target="#exampleModalCenter"
                            >
                                <h6 class="followers">متابع: {{advertiser() ->advertiserFollower ->count()}}</h6>
                            </a>
                            <h6 class="phone">الجوال: {{ advertiser()-> phone}}</h6>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div
                    class="modal fade"
                    id="exampleModalCenter"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true"
                >
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5
                                    class="modal-title"
                                    style="width: 100%; text-align: center;"
                                    id="exampleModalLongTitle"
                                >
                                    المتابعين
                                </h5>
                                <button
                                    type="button"
                                    style="position: absolute; left: 10px;"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-label="Close"
                                >
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <section class="container-fluid">
                                    <div class="followers">

                                        @isset($followers)
                                            @foreach($followers as $followerss)
                                                <div class="one-follower">
                                                    <img
                                                        style="height: 55px; width: 55px;"
                                                        src="{{$followerss -> follower -> photo}}"
                                                    />
                                                    <div class="row justify-content-between w-100 mx-2">
                                                        <div>
                                                            <a href="{{route('advertiser.profile.data', $followerss -> follower -> id)}}">


                                                                <p style="text-align: right;">{{$followerss -> follower -> name}}</p>
                                                            </a>
                                                            <p style="text-align: right;">
                                                                <small>{{$followerss -> follower -> email}}</small>
                                                            </p>
                                                        </div>

                                                        @if(isFollowing($followerss -> follower -> id) == true)
                                                            <button
                                                                type="button"
                                                                class="btn btn-primary rounded-pill h-50 align-self-center px-3"
                                                                onclick="window.location.href='{{route('advertiser.removeFollow' , $followerss -> follower -> id)}}'"
                                                            >
                                                                إلغاء المتابعة
                                                            </button>
                                                        @else
                                                            <button
                                                                type="button"
                                                                class="btn btn-primary rounded-pill h-50 align-self-center px-3"
                                                                onclick="window.location.href='{{route('advertiser.addFollow' , $followerss -> follower -> id)}}'"
                                                            >
                                                                متابعة
                                                            </button>

                                                    @endif


                                                    <!-- <hr/> -->
                                                    </div>
                                                </div>
                                                <hr/>
                                            @endforeach
                                        @endisset

                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="button-groups mx-auto w-75">
                    <button id="my-ad" class="btn btn-primary the-button w-100 py-3">
                        إعلاناتي
                    </button>
                    <button
                        id="my-fav-ad"
                        class=" btn btn-primary the-button w-100 py-3"
                    >
                        الإعلانات المفضلة
                    </button>
                    <button

                        id="chat" class="btn btn-primary the-button w-100 py-3 ">

                        الرسائل الخاصة
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="row justify-content-center m-0">

            <div id="ad-cards" class="row site-page-card justify-content-center w-100">

                @if($advertising == null)
                    <div class="d-flex site-page px-5">
                        <p class="title"> لا يوجد اعلانات </p>
                    </div>
                @else
                    @foreach($advertising as $constant)
                        <div class="col-12 col-sm-12 col-md-6 col-xl-3 col-lg-4 ">
                            <div class="card-res-new card">
                                <div
                                    style="
                                        /*min-height: 100px;*/
                                        background-image: url('{{ App\Models\Advertising::photoValue($constant -> photos)}}');

                                        "
                                    class="photo-ca-res-new head-card align-items-end d-flex head-card justify-content-end"
                                ></div>


                                <div class="body-card px-3">
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="{{route('advertising.card-details', $constant -> id)}}">
                                            <h6>{{$constant -> id}}#</h6>
                                            <h6>{{$constant -> title}}</h6>
                                        </a>
                                    </div>


                                    <div class="d-flex body-card-icon">
                                        <div class="d-flex ml-4 align-items-center">
                                            <i class="far fa-user ml-2"></i>
                                            <a href="#">
                                                <p>{{$constant ->  Advertiser -> name }}</p>
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt ml-2"></i>
                                            <a href="#">
                                                <p>{{$constant ->  cityAdvertising -> name }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="mt-3 content-card-text">
                                        {{ $constant -> description}}
                                    </p>
                                    <h5> {{ $constant -> price}} $</h5>


                                    <div class="footer-card d-flex justify-content-between my-3">

                                        <div class="d-flex">
                                            @if(CategoryRating($constant -> id) == 5)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>

                                            @elseif(CategoryRating($constant -> id)  == 4)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>


                                            @elseif(CategoryRating($constant -> id)  == 3)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>


                                            @elseif(CategoryRating($constant -> id)  == 2)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>


                                            @elseif(CategoryRating($constant -> id)  == 1)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>


                                            @else
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>

                                            @endif
                                        </div>
                                        <div class="d-flex time-publish align-items-center">
                                            <i class="far fa-clock" aria-hidden="true"></i>
                                            <p class="mr-1">
                                                @php
                                                    \Carbon\Carbon::setLocale('ar');
                                                @endphp
                                                {{ \Carbon\Carbon::parse($constant->created_at)->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>

                                </div>

                                @php
                                    $status_ad = App\Models\FixedAdvertising::where('advertising_id',$constant->id)->first();
                                    $status1 = 2;
                                    if ($status_ad){
                                    $status1 = $status_ad->status;
                                    }

                                @endphp


                                @if($status1 == 0)
                                    <div class="mb-2 py-1" style="margin-right: 30%">
                                        <a type="button" class="update-advertising btn btn-info mx-auto shadow-sm"
                                        >
                                            قيد المراجعة
                                        </a>
                                    </div>

                                @elseif($status1 == 1)
                                    <div class="mb-2 py-1" style="margin-right: 30%">
                                        <a type="button" class="update-advertising btn btn-info mx-auto shadow-sm"
                                        >
                                            تم التثبيت
                                        </a>
                                    </div>

                                @elseif($status1 == 5)

                                    @php
                                        $neww = App\Models\FixedAdvertising::where('advertising_id' ,$constant -> id )->first();

                                    @endphp
                                    <div class="mb-2 py-1" style="margin-right: 30%">
                                        <a type="button"
                                           class="update-advertising-Reason btn btn-info mx-auto shadow-sm"
                                           data-toggle="modal"
                                           data-target="#cardModalReason"
                                           data-id="{{$neww -> reason}}"
                                        >

                                            رفض التثبيت
                                        </a>
                                    </div>

                                @else
                                    <div class="mb-2 py-1" style="margin-right: 30%">
                                        <a type="button" class="update-advertising btn btn-info mx-auto shadow-sm"
                                           data-toggle="modal"
                                           data-target="#cardModal"
                                           data-id="{{$constant -> id}}"
                                        >
                                            تثبيت الاعلان
                                        </a>
                                    </div>
                                @endif

                                <div class="mb-2 py-1 button-group">
                                    <button type="button" class="btn btn-outline-info">
                                        <a type="button"
                                           onclick="window.location.href='{{route('advertising.edit',$constant->id)}}'">
                                            <div class="row inside-button px-2">
                                                <i class="far fa-edit" style="font-size: 15px;"></i>
                                                <p class="my-0 mx-1" style="font-size: 15px;">
                                                    تعديل
                                                </p>
                                            </div>
                                        </a>
                                    </button>
                                    <button type="button" class="btn btn-outline-info">
                                        <a type="button"
                                           onclick="window.location.href='{{route('advertising.price',$constant->id)}}'">

                                            <div class="row inside-button px-2">
                                                <i class="fas fa-dollar-sign"></i>
                                                <p class="my-0 mx-1" style="font-size: 15px;">
                                                    دفع العمولة
                                                </p>
                                            </div>
                                        </a>
                                    </button>
                                    <button
                                        onclick="deleteAlert({{$constant -> id}})"
                                        type="submit"
                                        class="btn btn-outline-info"
                                    >
                                        <div class="row inside-button px-2">
                                            <i class="fas fa-trash" style="color: #ef5252;"></i>
                                            <p class="my-0 mx-1" style="font-size: 15px;">
                                                حذف
                                            </p>
                                        </div>
                                    </button>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="result d-none row site-page-card justify-content-center" style="
    width: 100%;
">

                @if($advertising_favourite == null)
                    <div class="d-flex site-page px-5">
                        <p class="title"> لا يوجد اعلانات مفضلة</p>
                    </div>
                @else
                    @foreach($advertising_favourite as $constant)
                        <div class="col-12 col-sm-12 col-md-6 col-xl-3 col-lg-4 ">
                            <div class="card-res-new card">
                                <div
                                    style="
                                        /*min-height: 100px;*/
                                        background-image: url('{{ App\Models\Advertising::photoValue($constant -> advertising-> photos)}}');

                                        "
                                    class="photo-ca-res-new head-card align-items-end d-flex head-card justify-content-end"
                                ></div>


                                <div class="body-card px-3">
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="{{route('advertising.card-details', $constant->advertising -> id)}}">
                                            <h6>{{$constant -> id}}#</h6>
                                            <h6>{{$constant -> title}}</h6>
                                        </a>

                                        @if(AdvertisingFavourite( $constant->advertising -> id) == false )
                                            <div class="love-icon-card mt-2 ">
                                                <button
                                                    onclick="window.location.href='{{route('advertiser_profile.addFavourite' , ['id' => $constant -> advertising -> id ] )}}'">
                                                    <i class="far fa-heart mt-1"></i>
                                                </button>
                                            </div>

                                        @else

                                            <div class="love-icon-card mt-2 active ">
                                                <button
                                                    onclick="window.location.href='{{route('advertiser_profile.removeFavourite' , ['id' => $constant ->advertising-> id ] )}}'">
                                                    <i class="far fa-heart mt-1"></i>
                                                </button>
                                            </div>

                                        @endif

                                    </div>
                                    <div class="d-flex body-card-icon">
                                        <div class="d-flex ml-4 align-items-center">
                                            <i class="far fa-user ml-2"></i>
                                            <a href="#">
                                                <p>{{$constant ->  Advertiser -> name }}</p>
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt ml-2"></i>
                                            <a href="#">
                                                <p>{{$constant ->  advertising ->cityAdvertising -> name }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="mt-3 content-card-text">
                                        {{ $constant -> advertising -> description}}
                                    </p>
                                    <h5> {{ $constant -> advertising-> price}} $</h5>


                                    <div class="footer-card d-flex justify-content-between my-3">

                                        <div class="d-flex">
                                            @if(CategoryRating($constant -> id) == 5)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>

                                            @elseif(CategoryRating($constant -> id)  == 4)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>


                                            @elseif(CategoryRating($constant -> id)  == 3)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>


                                            @elseif(CategoryRating($constant -> id)  == 2)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>


                                            @elseif(CategoryRating($constant -> id)  == 1)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>


                                            @else
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>

                                            @endif
                                        </div>
                                        <div class="d-flex time-publish align-items-center">
                                            <i class="far fa-clock" aria-hidden="true"></i>
                                            <p class="mr-1">
                                                @php
                                                    \Carbon\Carbon::setLocale('ar');
                                                @endphp
                                                {{ \Carbon\Carbon::parse($constant->created_at)->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

            <!-- Modal -->
            <div
                class="modal fade"
                id="cardModal1"
                tabindex="-1"
                role="dialog"
                aria-labelledby="#cardModal1"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="border-bottom: none;">
                            <h5
                                class="modal-title"
                                style="width: 100%; text-align: center;"
                                id="exampleModalLongTitle"
                            >
                                بيانات مقدم الطلب
                            </h5>
                            <button
                                type="button"
                                style="position: absolute; left: 10px;"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{--                            <section class="container-fluid">--}}
                            {{--                                <div class="row justify-content-around">--}}
                            {{--                                    <p class="modal-card-title my-1">--}}
                            {{--                                        <strong>اسم المحول</strong>--}}
                            {{--                                    </p>--}}
                            {{--                                    <input--}}
                            {{--                                        type="text"--}}
                            {{--                                        class="form-control w-75 rounded-pill"--}}
                            {{--                                        id="exampleInputEmail155"--}}
                            {{--                                        aria-describedby="emailHelp"--}}
                            {{--                                        placeholder="أضف هنا اسمك المدرج في الحوالة البنكية"--}}
                            {{--                                        name="bank_name"--}}
                            {{--                                    />--}}
                            {{--                                </div>--}}
                            {{--                                <div class="row px-2 my-1">--}}
                            {{--                                    <p class="w-25 modal-card-title" style="text-align: right;">--}}
                            {{--                                        <strong>الاسم</strong>--}}
                            {{--                                    </p>--}}
                            {{--                                    <input--}}
                            {{--                                        type="text"--}}
                            {{--                                        class="form-control w-75 rounded-pill"--}}
                            {{--                                        id="exampleInputEmail133"--}}
                            {{--                                        aria-describedby="emailHelp"--}}
                            {{--                                        name="name"--}}
                            {{--                                    />--}}
                            {{--                                </div>--}}
                            {{--                                <div class="row px-2 my-1">--}}
                            {{--                                    <p class="w-25 modal-card-title">--}}
                            {{--                                        <strong>الجوال</strong>--}}
                            {{--                                    </p>--}}
                            {{--                                    <input--}}
                            {{--                                        type="text"--}}
                            {{--                                        class="form-control w-75 rounded-pill"--}}
                            {{--                                        id="exampleInputEmail199"--}}
                            {{--                                        aria-describedby="emailHelp"--}}
                            {{--                                        name="phone"--}}
                            {{--                                    />--}}
                            {{--                                </div>--}}
                            {{--                                <div class="row px-2 my-1">--}}
                            {{--                                    <p class="w-25 modal-card-title">--}}
                            {{--                                        <strong>البريد</strong>--}}
                            {{--                                    </p>--}}
                            {{--                                    <input--}}
                            {{--                                        type="email"--}}
                            {{--                                        class="form-control w-75 rounded-pill"--}}
                            {{--                                        id="exampleInputEmail1555"--}}
                            {{--                                        aria-describedby="emailHelp"--}}
                            {{--                                        name="email"--}}
                            {{--                                    />--}}
                            {{--                                </div>--}}
                            {{--                                <div class="row px-2 my-1">--}}
                            {{--                                    <input--}}
                            {{--                                        type="hidden"--}}
                            {{--                                        class="form-control w-75 rounded-pill"--}}
                            {{--                                        id="exampleInputEmail1"--}}
                            {{--                                        aria-describedby="emailHelp"--}}
                            {{--                                        name="advertising_id"--}}

                            {{--                                    />--}}
                            {{--                                </div>--}}
                            {{--                                <div class="row px-2 my-1">--}}
                            {{--                                    <p class="w-25 modal-card-title">--}}
                            {{--                                        <strong>قيمة العمولة: </strong>--}}
                            {{--                                    </p>--}}
                            {{--                                    <p class="w-50 modal-card-description">--}}
                            {{--                                        5--}}
                            {{--                                    </p>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="column mx-n2">--}}
                            {{--                                    <p class="modal-card-title my-1">--}}
                            {{--                                        <strong>المرفقات</strong>--}}
                            {{--                                    </p>--}}
                            {{--                                    <input class="w-100" type="file" />--}}
                            {{--                                </div>--}}
                            {{--                                <p class="modal-card-description">--}}
                            {{--                                    <small--}}
                            {{--                                    >صيغة المرفقات يجب ان تكون jpeg,png,jpg,gif,svg,pdf--}}
                            {{--                                    </small>--}}
                            {{--                                </p>--}}
                            {{--                                <div--}}
                            {{--                                    class="modal-footer"--}}
                            {{--                                    style="--}}
                            {{--                      border-top: none;--}}
                            {{--                      display: flex;--}}
                            {{--                      justify-content: end;--}}
                            {{--                    "--}}
                            {{--                                >--}}
                            {{--                                    <button--}}
                            {{--                                        type="submit"--}}
                            {{--                                        class="btn btn-primary rounded-pill px-4"--}}
                            {{--                                    >--}}
                            {{--                                        إرسال--}}
                            {{--                                    </button>--}}
                            {{--                                </div>--}}
                            {{--                            </section>--}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->

            <!-- Modal -->
            <div
                class="modal fade"
                id="report"
                tabindex="-1"
                role="dialog"
                aria-labelledby="#cardModal"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="border-bottom: none;">
                            <h5
                                class="modal-title"
                                style="width: 100%; text-align: center;"
                                id="exampleModalLongTitle"
                            >
                                التبليغ عن اساءة
                            </h5>
                            <button
                                type="button"
                                style="position: absolute; left: 10px;"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <section class="container-fluid">
                                <form action="{{route('advertiser.report-abuse')}}" method="POST">
                                    @csrf
                                    <div class="row px-2 my-1 justify-content-between">
                                        <p class="modal-card-title my-1">
                                            <strong>عنوان السكن:</strong>
                                        </p>
                                        <input
                                            type="text"
                                            class="form-control w-75 rounded-pill"
                                            id="exampleInputEmail1"
                                            aria-describedby="emailHelp"
                                            placeholder="اكتب هنا مكان السكن"
                                            name="address"
                                        />
                                    </div>
                                    <div class="row px-2 my-1">
                                        <p class="w-25 modal-card-title" style="text-align: right;">
                                            <strong>نوع الاساءة:</strong>
                                        </p>
                                        <input
                                            type="text"
                                            class="form-control w-75 rounded-pill"
                                            id="reportType"
                                            aria-describedby="emailHelp"
                                            placeholder="اكتب هنا نوع الاساءة"
                                            name="abuse_type"
                                        />
                                    </div>
                                    <div class="row px-2 my-1">
                                        <p class="w-25 modal-card-title">
                                            <strong>اضافة تعليق</strong>
                                        </p>
                                        <textarea
                                            name="comment"
                                            class="form-control w-75 rounded-lg"
                                            placeholder="اضافة تعليق...."
                                        ></textarea>
                                    </div>
                                    <div
                                        class="modal-footer"
                                        style="
                      border-top: none;
                      display: flex;
                      justify-content: flex-end;
                    "
                                    >
                                        <button
                                            type="submit"
                                            class="btn btn-primary rounded-pill px-4"
                                        >
                                            إرسال
                                        </button>
                                    </div>
                                </form>

                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->

        </div>

    </section>


    <section class="container-fluid chat-for-admin d-none">
        <div class="row">
            <div class="col-lg-3">
                <!-- Search bar -->
                <div class="input-group my-4 w-100 mb-3">
                    <div class="input-group-prepend">

                    </div>
                </div>
                <!-- Search bar -->
                <!-- right section for users -->

                <div class="right-section">
                    @foreach($senders as $sender)
                        <?php
                        $user = \App\Models\Advertiser::where('id', $sender)->first();
                        ?>
                        <div class="card-messege">
                            <img class="card-image" src="{{ asset($user -> photo)}}"/>
                            <div class="card-chat-details">
                                <button onClick="renderTable({{$user -> id}})"><p class="name"> {{$user-> name}}</p>
                                </button>
                                <p class="messege">
                                    <?php
                                    $messeges = \App\Models\Chat::where([
                                        'advertiser_id' => advertiser()->id,
                                        'sender_id' => $user->id
                                    ])
                                        ->orderby('created_at', 'ASC')
                                        ->get();

                                    $messeges2 = \App\Models\Chat::where([
                                        'advertiser_id' => $user->id,
                                        'sender_id' => advertiser()->id
                                    ])
                                        ->orderby('created_at', 'ASC')
                                        ->get();

                                    $messeges = $messeges->merge($messeges2)->sortByDesc('created_at');
                                    $data = $messeges->first();
                                    ?>
                                    {{   $data ->message   }} </p>
                            </div>
                            <p class="date"> {{   $data ->created_at ->format('h:iA')   }}</p>
                        </div>
                        <hr/>
                    @endforeach
                </div>
                <!-- right section for users -->
            </div>
            <!-- left section for messeges-->

            <div class="my-5 col-lg-9">
                <!-- dropdownList-user -->

                {{--                <div class="dropdown user-list-on-mobile justify-content-center">--}}
                {{--                    <button--}}
                {{--                        class="btn btn-secondary dropdown-toggle w-50"--}}
                {{--                        type="button"--}}
                {{--                        id="dropdownMenuButton"--}}
                {{--                        data-toggle="dropdown"--}}
                {{--                        aria-haspopup="true"--}}
                {{--                        aria-expanded="false"--}}
                {{--                    >--}}
                {{--                        <div class="ml-3 align-items-center d-flex flex-1">--}}
                {{--                            <i class="fas fa-list-ul" style="color: #fff; font-size: 15px;"></i>--}}
                {{--                            <p style="margin-bottom: 0; margin-right: 0.7rem;">الدردشات</p>--}}
                {{--                        </div>--}}
                {{--                    </button>--}}
                {{--                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"--}}
                {{--                         style="max-height: 50vh;overflow-y: auto;">--}}
                {{--                        <a class="dropdown-item" href="#">--}}
                {{--                            <div class="card-messege">--}}
                {{--                                <img class="card-image" src="{{ asset('front-end/images/profile-pic.png')}}"/>--}}
                {{--                                <div class="card-chat-details">--}}
                {{--                                    <p class="name">محمد احمد</p>--}}
                {{--                                    <p class="messege">اعطيني تفاصيل اكتر</p>--}}
                {{--                                </div>--}}
                {{--                                <p class="date">12:30</p>--}}
                {{--                            </div>--}}
                {{--                            <hr/>--}}
                {{--                        </a>--}}
                {{--                        <a class="dropdown-item" href="#">--}}
                {{--                            <div class="card-messege">--}}
                {{--                                <img class="card-image" src="{{ asset('front-end/images/profile-pic.png')}}"/>--}}
                {{--                                <div class="card-chat-details">--}}
                {{--                                    <p class="name">محمد احمد</p>--}}
                {{--                                    <p class="messege">اعطيني تفاصيل اكتر</p>--}}
                {{--                                </div>--}}
                {{--                                <p class="date">12:30</p>--}}
                {{--                            </div>--}}
                {{--                            <hr/>--}}
                {{--                        </a>--}}
                {{--                        <a class="dropdown-item" href="#">--}}
                {{--                            <div class="card-messege">--}}
                {{--                                <img class="card-image" src="{{ asset('front-end/images/profile-pic.png')}}"/>--}}
                {{--                                <div class="card-chat-details">--}}
                {{--                                    <p class="name">محمد احمد</p>--}}
                {{--                                    <p class="messege">اعطيني تفاصيل اكتر</p>--}}
                {{--                                </div>--}}
                {{--                                <p class="date">12:30</p>--}}
                {{--                            </div>--}}
                {{--                            <hr/>--}}
                {{--                        </a>--}}
                {{--                        <a class="dropdown-item" href="#">--}}
                {{--                            <div class="card-messege">--}}
                {{--                                <img class="card-image" src="{{ asset('front-end/images/profile-pic.png')}}"/>--}}
                {{--                                <div class="card-chat-details">--}}
                {{--                                    <p class="name">محمد احمد</p>--}}
                {{--                                    <p class="messege">اعطيني تفاصيل اكتر</p>--}}
                {{--                                </div>--}}
                {{--                                <p class="date">12:30</p>--}}
                {{--                            </div>--}}
                {{--                            <hr/>--}}
                {{--                        </a>--}}
                {{--                    </div>--}}
                {{--                </div>--}}


                <div class="table-container">
                    @include('front-end.layouts.includes.chat')
                </div>
                <!-- send input -->

            </div>

            <!-- left section for messeges -->
        </div>
    </section>


    <div
        class="modal fade"
        id="cardModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="#cardModal"
        aria-hidden="true"
    >

        @if(advertiser())
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="border-bottom: none;">
                        <h5
                            class="modal-title"
                            style="width: 100%; text-align: center;"
                            id="exampleModalLongTitle"
                        >
                            طلب تثبيت اعلان
                        </h5>
                        <button
                            type="button"
                            style="position: absolute; left: 10px;"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('advertiser.fixed.advertising')}}" method="POST">
                            @csrf

                            <h5
                                class="modal-title"
                                style="width: 100%; text-align: center;"
                                id="exampleModalLongTitle"
                            >
                                هل انت متأكد تريد تثبيت هذا الاعلان ؟
                            </h5>
                            <input name="id" id="id" value="" type="number" hidden>

                            <button
                                type="submit"
                                class="btn btn-secondary confirm w-50 py-2 my-5"
                                style="margin-right: 20%"
                            >
                                تأكيد الطلب
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>



    <div
        class="modal fade"
        id="cardModalReason"
        tabindex="-1"
        role="dialog"
        aria-labelledby="#cardModal"
        aria-hidden="true"
    >

        @if(advertiser())
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="border-bottom: none;">
                        <h5
                            class="modal-title"
                            style="width: 100%; text-align: center;"
                            id="exampleModalLongTitle"
                        >
                            سبب الرفض
                        </h5>
                        <button
                            type="button"
                            style="position: absolute; left: 10px;"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('advertiser.fixed.advertising')}}" method="POST">
                            @csrf


                            <textarea readonly name="id" id="id" value="" style="width: 100%;height: 100px"></textarea>


                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>


    @push('js')

        <script>

            function renderTable($id) {
                var $request = $.get('/test/' + $id); // make request
                var $container = $('.table-container');

                $container.addClass('loading'); // add loading class (optional)

                $request.done(function (data) { // success
                    $container.html(data.html);
                });
                $request.always(function () {
                    $container.removeClass('loading');
                });
            }

            $(document).ready(function () {
                $("#my-ad").click(function () {
                    $("#ad-cards").removeClass("d-none");
                    $(".result").addClass("d-none");
                    $(".chat-for-admin").addClass("d-none");
                    $(this)
                        .removeClass("the-button")
                        .addClass("active-btn")
                        .siblings()
                        .addClass("the-button");
                });
                $("#my-fav-ad").click(function () {
                    $("#ad-cards").addClass("d-none");
                    $(".chat-for-admin").addClass("d-none");
                    $(".result").removeClass("d-none");
                    $(this)
                        .removeClass("the-button")
                        .addClass("active-btn")
                        .siblings()
                        .addClass("the-button");
                });
                $("#chat").click(function () {
                    $(".chat-for-admin").removeClass("d-none");
                    $(".result").addClass("d-none");
                    $("#ad-cards").addClass("d-none");
                    $(this)
                        .removeClass("the-button")
                        .addClass("active-btn")
                        .siblings()
                        .addClass("the-button");
                });
            });

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

                    fetch('/advertiser/delete/' + $id)

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

            $(document).on("click", ".update-advertising", function () {
                var id = $(this).data('id');
                $(".modal-content #id").val(id);
            });

            $(document).on("click", ".update-advertising-Reason", function () {
                var id = $(this).data('id');
                $(".modal-content #id").val(id);
            });

        </script>
    @endpush
@endsection
