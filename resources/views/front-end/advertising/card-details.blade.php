@extends('front-end.layouts.app')
@section('title' , ' تفاصيل الاعلان  ')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front-end/css/owl.theme.default.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front-end/css/card-details.css')}}"/>
    {{--    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">--}}
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}

    <style>
        @media (max-width: 768px) {
            .carousel-inner .carousel-item > div {
                display: none;
            }

            .carousel-inner .carousel-item > div:first-child {
                display: block;
            }
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
        }

        /* display 3 */
        @media (min-width: 768px) {

            .carousel-inner .carousel-item-right.active,
            .carousel-inner .carousel-item-next {
                transform: translateX(33.333%);
            }

            .carousel-inner .carousel-item-left.active,
            .carousel-inner .carousel-item-prev {
                transform: translateX(-33.333%);
            }
        }

        .carousel-inner .carousel-item-right,
        .carousel-inner .carousel-item-left {
            transform: translateX(0);
        }

        div.stars {
            width: 270px;
            display: inline-block;
        }

        input.star {
            display: none;
        }

        label.star {
            float: right;
            padding:10px 3px;
            font-size: 30px;
            color: #444;
            transition: all .2s;
            font-family: 'Font Awesome 5 free';
            font-weight: 900;
        }

        input.star:checked ~ label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked ~ label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked ~ label.star:before {
            color: #F62;
        }

        label.star:hover {
            transform: rotate(-15deg) scale(1.3);
        }

        label.star:before {
            content:'\f005';
        }
    </style>

    <link rel="stylesheet" href="{{ asset('front-end/css/responsive.css')}}"/>

@endpush

@section('content')
    <section class="container mt-5">

        @include('front-end.layouts.includes.alerts.errors')
        @include('front-end.layouts.includes.alerts.success')


        <div class="row">

            <div class="col-lg-9 order-lg-2 order-sm-1">
                <div class="owl-carousel owl-theme">

                    <?php
                    foreach ((array)json_decode($advertising->photos)as $picture) { ?>
                    <div>
                        <img
                            class="owl-lazy item"
                            data-src="{{ asset( 'front-end/'.$picture) }}"
                            style="border-radius: 20px;width: 100%;height: auto;"
                            alt=""
                        />

                        <input type="hidden" value="{{$advertising -> lat}}" id="latitude" name="latitude">
                        <input type="hidden" value="{{$advertising -> lng}}" id="longitude" name="longitude">


                        @if(AdvertisingFavourite( $advertising -> id) == false )
                            <div class="love-icon-card for-slider  mt-2 ">
                                <button
                                    onclick="window.location.href='{{route('advertiser_card_advertising.addFavourite' , ['id' =>$advertising -> id ,'card_id'  =>$advertising -> id ] )}}'">
                                    <i class="far fa-heart mt-1"></i>
                                </button>
                            </div>

                        @else

                            <div class="love-icon-card  for-slider  mt-2 active ">
                                <button
                                    onclick="window.location.href='{{route('advertiser_card_advertising.removeFavourite' , ['id' =>$advertising -> id ,'card_id'  =>$advertising -> id ] )}}'">
                                    <i class="far fa-heart mt-1"></i>
                                </button>
                            </div>

                        @endif

                    </div> <?php } ?>
                    @if($advertising->vedio_url)
                        <iframe width="800" height="500"
                                src="{{$advertising->vedio_url}}">
                        </iframe>
                    @endif
                </div>
                <div class="adv-social-icons-center d-flex justify-content-end m-3 m-md-2 text-sm-center">
                    <a href="https://web.whatsapp.com/{{$advertising -> Advertiser ->phone}}">
                        <i class="fab fa-whatsapp px-2" style="font-size: 30px;"></i>
                    </a>
                    <a href="{{$advertising -> Advertiser ->twitter}}">
                        <i class="fab fa-twitter px-2" style="font-size: 30px;"></i>
                    </a>
                </div>
            </div>
            <div class="single-adv-card col-lg-3 order-lg-1 order-sm-2">
                <h3>{{ $advertising -> title}}</h3>
                <p class="costs">مبلغ الإيجار:<small> {{$advertising ->price }}ريال</small></p>
                @if($advertising ->insurance_price)
                    <p class="costs">
                        مبلغ التأمين:<small> {{$advertising ->insurance_price }}ريال</small>
                    </p>
                @endif
                <div class="above-card">
                    <p class="costs"><strong>تواصل مع المؤجر</strong></p>
                    @if(advertiser())
                        <a type="button" data-toggle="modal" data-target="#report">
                            <i class="fas fa-flag flag"></i>
                        </a>
                    @else
                        <a type="button" href="{{route('advertiser.login')}}">
                            <i class="fas fa-flag flag"></i>
                        </a>
                    @endif
                </div>
                <!-- border-color inside new div -->
                <div class="card">
                    <div class="card-content my-2">
                        <img class="image" src="{{$advertising -> advertiser ->photo }}"/>
                        <div class="card-text mx-1">
                            <p>الاسم <small>{{$advertising -> advertiser ->name }}</small></p>
                            <p>مدينة الاعلان <small>{{$advertising -> cityAdvertising ->name }}</small></p>
                            @if($advertising -> is_phone == 1)
                                <p>رقم الجوال<small>{{$advertising -> advertiser -> phone }}</small></p>
                            @endif
                        </div>
                    </div>

                    @if(!empty(advertiser()))
                        @if($advertising -> advertiser -> id ==advertiser()->id)

                        @else
                            <div class="card-buttons d-flex justify-content-around mx-1 my-2">

                                <a style="    margin-right: auto;"
                                   class="send-message btn btn-primary px-3 py-2"
                                   type="button" data-toggle="modal" data-target="#send-message"
                                   data-advertiser_id="{{$advertising -> advertiser -> id}}">
                                    رسالة خاصّة
                                </a>

                                @if($follow == false)
                                    <button type="submit"
                                            onclick="window.location.href='{{route('advertiser.addFollowing' , $advertising -> id)}}'"
                                            class="btn btn-light px-5 py-2">
                                        تابع
                                    </button>
                                @else

                                    <button type="submit"
                                            onclick="window.location.href='{{route('advertiser.removeFollowing' , $advertising -> id)}}'"
                                            class="btn btn-light px-5 py-2">
                                        إلغاء المتابعة
                                    </button>

                                @endif
                            </div>

                        @endif
                    @endif
                </div>
                @if($advertising -> lat && $advertising -> lng)
                    <div class="my-2">
                        <h6 class="my-4 costs" style="text-align: right; color: #707070;">
                            <strong>موقع الاعلان على الخريطة</strong>
                        </h6>
                        <!-- google map -->
                        <div class="form-group">
                            <div id="map" style="min-height: 190px;width: 100%;"></div>
                        </div>
                        <!-- google map -->
                    </div>
                @endif
            </div>
        </div>

        <div>
            <div class="d-flex my-5">
                <button
                    id="ad-description"
                    type="button"
                    class="description-section btn btn-light the-button px-4 py-2"
                    onclick=""
                >
                    وصف الاعلان
                </button>
                <button
                    id="comments"
                    type="button"
                    class="btn btn-light the-button px-4 mx-2"
                >
                    تعلقيات
                </button>
                <button
                    id="terms-for-ad"
                    type="button"
                    class="btn btn-light the-button"
                >
                    الشروط الخاصة للاعلان
                </button>
            </div>
            <div class="description-for-sale">
                <div class="button-result">
                    <div class="rates">
                        <p class="rate-text pb-5">
                            {{$advertising -> description }}
                        </p>
                        <div class="card">
                            <div class="rating-box shadow-sm">
                                <div>
                                    <i
                                        class="fas fa-star"
                                        style="text-align: right; font-size: 24px;"
                                    ></i>
                                </div>
                                <div class="my-3">
                                    <h6 class="mb-0" style="text-align: center; color: #8e8f94;">{{$total_rate}}</h6>
                                    <p class="mb-0" style="text-align: center; color: #8e8f94;">
                                        <small>{{$advertising -> ratingAdvertising ->count()}} Ratings</small>
                                    </p>
                                </div>
                            </div>


                            <form action="{{route('advertising.addRating')}}" method="POST">
                                @csrf

                                <input type="hidden" value="{{$advertising -> id}}" name="id">
                                <div class="first-section px-4 my-4">


                                    <h6 class="add-rate mt-4"><strong>أضف تقييم</strong></h6>

                                    @if(isset($voter_rate))
                                        <div class="stars mt-2">
                                            @if($voter_rate == 5)
                                                <input class="star star-5" id="star-5" type="radio" checked name="star"
                                                       value="5"/>
                                                <label class="star star-5" for="star-5"></label>
                                                <input class="star star-4" id="star-4" type="radio" name="star"
                                                       value="4"/>
                                                <label class="star star-4" for="star-4"></label>
                                                <input class="star star-3" id="star-3" type="radio" name="star"
                                                       value="3"/>
                                                <label class="star star-3" for="star-3"></label>
                                                <input class="star star-2" id="star-2" type="radio" name="star"
                                                       value="2"/>
                                                <label class="star star-2" for="star-2"></label>
                                                <input class="star star-1" id="star-1" type="radio" name="star"
                                                       value="1"/>
                                                <label class="star star-1" for="star-1"></label>

                                            @elseif($voter_rate == 4)
                                                <input class="star star-5" id="star-5" type="radio" name="star"
                                                       value="5"/>
                                                <label class="star star-5" for="star-5"></label>
                                                <input class="star star-4" id="star-4" type="radio" checked name="star"
                                                       value="4"/>
                                                <label class="star star-4" for="star-4"></label>
                                                <input class="star star-3" id="star-3" type="radio" name="star"
                                                       value="3"/>
                                                <label class="star star-3" for="star-3"></label>
                                                <input class="star star-2" id="star-2" type="radio" name="star"
                                                       value="2"/>
                                                <label class="star star-2" for="star-2"></label>
                                                <input class="star star-1" id="star-1" type="radio" name="star"
                                                       value="1"/>
                                                <label class="star star-1" for="star-1"></label>

                                            @elseif($voter_rate == 3)
                                                <input class="star star-5" id="star-5" type="radio" name="star"
                                                       value="5"/>
                                                <label class="star star-5" for="star-5"></label>
                                                <input class="star star-4" id="star-4" type="radio" name="star"
                                                       value="4"/>
                                                <label class="star star-4" for="star-4"></label>
                                                <input class="star star-3" id="star-3" type="radio" checked name="star"
                                                       value="3"/>
                                                <label class="star star-3" for="star-3"></label>
                                                <input class="star star-2" id="star-2" type="radio" name="star"
                                                       value="2"/>
                                                <label class="star star-2" for="star-2"></label>
                                                <input class="star star-1" id="star-1" type="radio" name="star"
                                                       value="1"/>
                                                <label class="star star-1" for="star-1"></label>

                                            @elseif($voter_rate == 2)
                                                <input class="star star-5" id="star-5" type="radio" name="star"
                                                       value="5"/>
                                                <label class="star star-5" for="star-5"></label>
                                                <input class="star star-4" id="star-4" type="radio" name="star"
                                                       value="4"/>
                                                <label class="star star-4" for="star-4"></label>
                                                <input class="star star-3" id="star-3" type="radio" name="star"
                                                       value="3"/>
                                                <label class="star star-3" for="star-3"></label>
                                                <input class="star star-2" id="star-2" type="radio" checked name="star"
                                                       value="2"/>
                                                <label class="star star-2" for="star-2"></label>
                                                <input class="star star-1" id="star-1" type="radio" name="star"
                                                       value="1"/>
                                                <label class="star star-1" for="star-1"></label>

                                            @elseif($voter_rate == 1)
                                                <input class="star star-5" id="star-5" type="radio" name="star"
                                                       value="5"/>
                                                <label class="star star-5" for="star-5"></label>
                                                <input class="star star-4" id="star-4" type="radio" name="star"
                                                       value="4"/>
                                                <label class="star star-4" for="star-4"></label>
                                                <input class="star star-3" id="star-3" type="radio" name="star"
                                                       value="3"/>
                                                <label class="star star-3" for="star-3"></label>
                                                <input class="star star-2" id="star-2" type="radio" name="star"
                                                       value="2"/>
                                                <label class="star star-2" for="star-2"></label>
                                                <input class="star star-1" id="star-1" type="radio" checked name="star"
                                                       value="1"/>
                                                <label class="star star-1" for="star-1"></label>
                                            @endif
                                            @else
                                                <div class="stars mt-2">
                                                    <input class="star star-5" id="star-5" type="radio" name="star"
                                                           value="5"/>
                                                    <label class="star star-5" for="star-5"></label>
                                                    <input class="star star-4" id="star-4" type="radio" name="star"
                                                           value="4"/>
                                                    <label class="star star-4" for="star-4"></label>
                                                    <input class="star star-3" id="star-3" type="radio" name="star"
                                                           value="3"/>
                                                    <label class="star star-3" for="star-3"></label>
                                                    <input class="star star-2" id="star-2" type="radio" name="star"
                                                           value="2"/>
                                                    <label class="star star-2" for="star-2"></label>
                                                    <input class="star star-1" id="star-1" type="radio" name="star"
                                                           value="1"/>
                                                    <label class="star star-1" for="star-1"></label>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-send-rate mx-4 my-4">
                                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">
                                                اضافة التقييم
                                            </button>
                                        </div>
                                </div>
                            </form>
                            {{--                            <form action="{{route('advertising.addComment')}}" method="POST">--}}
                            {{--                                @csrf--}}
                            {{--                                <input type="hidden" value="{{$advertising -> id}}" name="id">--}}
                            {{--                                <div class="add-new-comment">--}}
                            {{--                                    <div class="first-section px-4 my-4">--}}
                            {{--                                        <h6 class="add-rate"><strong>أضف تعليق</strong></h6>--}}
                            {{--                                    </div>--}}
                            {{--                                    <textarea--}}
                            {{--                                        class="text-area"--}}
                            {{--                                        placeholder="علق بما تراه مناسبا...."--}}
                            {{--                                        name="comment"--}}
                            {{--                                    ></textarea>--}}
                            {{--                                    <div class="card-send-rate mx-4 my-4">--}}
                            {{--                                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">--}}
                            {{--                                            إرسال--}}
                            {{--                                        </button>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}

                            {{--                            </form>--}}
                        </div>

                    </div>
                    <div class="comment-section d-none">
                        @if($advertising -> comments == 1)
                            @isset($comments)
                                @foreach($comments as $comment)
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img style="width: 55px;" src="{{$comment ->  advertiser -> photo}}"
                                                         class="img img-rounded img-fluid"/>
                                                    <p class="text-secondary text-center">{{$comment ->  created_at}} </p>
                                                </div>
                                                <div class="col-md-10" style="margin: 0 -70px;">
                                                    <p>
                                                        <a class="float-right"
                                                           href="#"><strong>{{$comment ->  advertiser -> username}}</strong></a>
                                                    </p>
                                                    <div class="clearfix"></div>
                                                    <p>  {{$comment -> comment}}</p>
                                                    <div style="
    display: flex;
    position: relative;
    top: -52px;">
                                                        <a style="    margin-right: auto;"
                                                           class="reply float-right btn btn-outline-info ml-2"
                                                           type="button" data-toggle="modal" data-target="#reply"
                                                           data-parent_id="{{$comment -> id}}">
                                                            <i class="fa fa-reply"></i> رد</a>
                                                        {{--                                                        <a type="button" data-toggle="modal" data-target="#report" >--}}
                                                        {{--                                                            <i class="fas fa-flag flag" style="font-size: 21px;padding: 9px;"></i>--}}
                                                        {{--                                                        </a>   --}}

                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $data= App\Models\AdvertisingComment::where('parent_id' , $comment ->id)->get();
                                            @endphp
                                            @if($data != null)
                                                @foreach($data as $dat)
                                                    <div style="background-color: #e2e3e46b;margin-right: 40px"
                                                         class="card card-inner">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <img style="width: 55px;"
                                                                         src="{{$comment ->  advertiser -> photo}}"
                                                                         class="img img-rounded img-fluid"/>
                                                                    <p class="text-secondary text-center">{{$comment ->  created_at}}</p>
                                                                </div>
                                                                <div class="col-md-10" style="margin: 0 -70px;">
                                                                    <p>
                                                                        <a href="#"><strong>{{$comment ->  advertiser -> username}}</strong></a>
                                                                    </p>
                                                                    <p>  {{$comment -> comment}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="row comments px-4">
                                        <div class="image-container">
                                            <img
                                                style="height: 55px; width: 55px;"
                                                src="{{$comment ->  advertiser -> photo}}"
                                            />
                                        </div>
                                        <div class="mx-2">
                                            <h6 class="name"> {{$comment ->  advertiser -> username}}</h6>
                                            <p><small>{{$comment ->  created_at}}  </small></p>
                                        </div>
                                        <div>
                                            <p class="px-4">
                                                <small>
                                                    {{$comment -> comment}}
                                                </small>
                                            </p>
                                        </div>
                                        <div class="d-flex align-self-center justify-content-end" style="width: 19%;">
                                            <button type="button" class="btn btn-outline-secondary">
                                                رد<i class="fas fa-share"></i>
                                            </button>
                                            <a class="align-self-center mx-3" type="button" data-toggle="modal" data-target="#report">
                                                <i class="fas fa-flag"></i>
                                            </a>
                                        </div>
                                        @php
                                            $data= App\Models\AdvertisingComment::where('parent_id' , $comment ->id)->get();
                                        @endphp
                                        <div class="row comments px-4">
                                            @if($data != null)

                                                @foreach($data as $dat)
                                                    <div class="image-container">
                                                        <img
                                                            style="height: 55px; width: 55px;"
                                                            src="{{$comment ->  advertiser -> photo}}"
                                                        />
                                                    </div>
                                                    <div class="mx-2">
                                                        <h6 class="name"> {{$dat ->  advertiser -> username}}</h6>
                                                        <p><small>{{$dat ->  created_at}}  </small></p>
                                                    </div>
                                                    <div>
                                                        <p class="px-4">
                                                            <small>
                                                                {{$dat -> comment}}
                                                            </small>
                                                        </p>
                                                    </div>
                                                    <br>
                                                @endforeach
                                            @endif
                                        </div>



                                    </div> --}}
                                @endforeach
                            @endisset

                            <form action="{{route('advertising.addComment')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$advertising -> id}}" name="id">
                                <input type="hidden" name="parent_id" value="0" id="parent_id">

                                <div class="add-new-comment">
                                    <div class="first-section px-4 my-4">
                                        <h6 class="add-rate"><strong>أضف تعليق</strong></h6>
                                    </div>
                                    <textarea
                                        class="text-area"
                                        placeholder="علق بما تراه مناسبا...."
                                        name="comment"
                                    ></textarea>
                                    <div class="card-send-rate mx-4 my-4">
                                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">
                                            إرسال
                                        </button>
                                    </div>
                                </div>

                            </form>
                        @else
                            <div class="mx-2">
                                <h6 class="name">ميزة التعليقات غير مفعلة </h6>
                            </div>
                        @endif

                    </div>
                    <div class="terms-for-sales d-none">
                        @if($advertising -> is_specialconditions == 1)
                            <p>
                                {{$advertising -> special_conditions}}
                            </p>
                        @else
                            <p>
                                لا يوجد شروط خاصة للاعلان
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <br>
    <br>
    @if(count($same_advertising)>0)
    <div class="container text-center my-3">
        <h2 class="font-weight-light">اعلانات مشابهة</h2>
        <div class="row mx-auto my-auto">
            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                        @foreach($same_advertising as $change)
                            <div class="carousel-item {{ $loop->index == 0 ? 'active' : ''  }}">
                                <div class="columns col-12 col-md-6 col-xl-3 col-lg-4">
                                    <div class="card mb-4">
                                        <div class="content-card">
                                            <div
                                                style="
                                                    background-image: url('{{ App\Models\Advertising::photoValue($change -> photos)}}');

                                                    "
                                                class="head-card align-items-end d-flex head-card justify-content-end"
                                            >
                                                <a
                                                    href="{{route('advertising.card-details', $change -> id)}}"
                                                    class="w-100 h-100 align-items-end d-flex justify-content-end"
                                                >

                                                </a>
                                            </div>
                                            <div class="body-card px-3">
                                                <div class="d-flex justify-content-between mt-3">
                                                    <a href="{{route('advertising.card-details', $change -> id)}}">
                                                        <h6>{{$change -> title}}</h6>
                                                    </a>

                                                    @if(AdvertisingFavourite( $change -> id) == false )
                                                        <div class="love-icon-card mt-2 ">
                                                            <button
                                                                onclick="window.location.href='{{route('advertiser_card_advertising.addFavourite' , ['id' =>$change -> id ,'card_id'  =>$advertising -> id ] )}}'">
                                                                <i class="far fa-heart mt-1"></i>
                                                            </button>
                                                        </div>

                                                    @else

                                                        <div class="love-icon-card mt-2 active ">
                                                            <button
                                                                onclick="window.location.href='{{route('advertiser_card_advertising.removeFavourite' , ['id' =>$change -> id ,'card_id'  =>$advertising -> id ] )}}'">
                                                                <i class="far fa-heart mt-1"></i>
                                                            </button>
                                                        </div>

                                                    @endif
                                                </div>
                                                <div class="d-flex body-card-icon">
                                                    <div class="d-flex ml-4 align-items-center">
                                                        <i class="far fa-user ml-2"></i>
                                                        <a href="{{route('advertiser.profile.data', $change ->  Advertiser -> id)}}">
                                                            <p>{{$change ->  Advertiser -> name }}</p>
                                                        </a>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-map-marker-alt ml-2"></i>
                                                        <a href="#">
                                                            <p>{{$change ->  cityAdvertising -> name }}</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <p class="mt-3 content-card-text">
                                                    {{ $change -> description}}
                                                </p>
                                                <h5> {{ $change -> price}} ريال </h5>


                                                <div
                                                    class="footer-card d-flex justify-content-between my-3">

                                                    <div class="d-flex">
                                                        @if(CategoryRating($change -> id)  == 5)
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>

                                                        @elseif(CategoryRating($change -> id)  == 4)
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star empty-star star-icon"></i>


                                                        @elseif(CategoryRating($change -> id)  == 3)
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star empty-star star-icon"></i>
                                                            <i class="fas fa-star empty-star star-icon"></i>


                                                        @elseif(CategoryRating($change -> id)  == 2)
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                            <i class="fas fa-star empty-star star-icon"></i>
                                                            <i class="fas fa-star empty-star star-icon"></i>
                                                            <i class="fas fa-star empty-star star-icon"></i>


                                                        @elseif(CategoryRating($change -> id)  == 1)
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
                                                            {{ \Carbon\Carbon::parse($change->created_at)->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </div>
                <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button"
                   data-slide="prev">
                    <i class="m-3 fas fa-chevron-left"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button"
                   data-slide="next">
                    <i class="m-3 fas fa-chevron-right"></i>

                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @endif
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

                        <form action="{{route('advertiser.report-abuse.advertising')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$advertising -> id}}">
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
    {{-- start reply modal form --}}
    <div class="modal fade" id="reply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">اضف رد</h5>
                    <button style="margin-left:0px" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('advertising.addComment')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$advertising -> id}}" name="id">
                    <input type="hidden" name="parent_id" value="" id="parent_id">

                    <div class="modal-body">
                        <div class="row px-2 my-1">
                            <p class="w-25 modal-card-title">
                                <strong>اضافة رد</strong>
                            </p>
                            <textarea
                                name="comment"
                                class="form-control w-75 rounded-lg"
                                placeholder="اضافة رد...."
                            ></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-dismiss="modal">
                            اغلاق
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">اضف رد</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- end reply modal form --}}
    <div class="modal fade" id="send-message" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">اضف رسالتك</h5>
                    <button style="margin-left:0px" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('storeMassege')}}" method="post">
                    @csrf
                    <input type="hidden" value="" name="advertiser_id" id="advertiser_id">
                    <input type="hidden" value="{{$advertising -> id}}" name="id">

                    <div class="modal-body">
                        <div class="row px-2 my-1">
                            <p class="w-25 modal-card-title">
                                <strong>اضافة رسالتك</strong>
                            </p>
                            <textarea
                                name="message"
                                class="form-control w-75 rounded-lg"
                                placeholder="اضافة الرسالة...."
                            ></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-dismiss="modal">
                            اغلاق
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">اضف رسالتك</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @push('js')
        <script>
            $('#recipeCarousel').carousel({
                interval: 10000
            })

            $('.carousel .carousel-item').each(function () {
                var minPerSlide = 3;
                var next = $(this).next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));

                for (var i = 0; i < minPerSlide; i++) {
                    next = next.next();
                    if (!next.length) {
                        next = $(this).siblings(':first');
                    }

                    next.children(':first-child').clone().appendTo($(this));
                }
            });

        </script>
        <script>
            $("#pac-input").focusin(function () {
                $(this).val('');
            });
            // This example adds a search box to a map, using the Google Place Autocomplete
            // feature. People can enter geographical searches. The search box will return a
            // pick list containing a mix of places and predicted search terms.
            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
            function initAutocomplete() {
                var pos = {lat:   {{ $advertising->lat }} , lng: {{ $advertising->lng }} };
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: pos
                });
                infoWindow = new google.maps.InfoWindow;
                geocoder = new google.maps.Geocoder();
                marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: '{{ $advertising->title }}'
                });
                infoWindow.setContent('{{ $advertising->title }}');
                infoWindow.open(map, marker);
                // move pin and current location
                infoWindow = new google.maps.InfoWindow;
                geocoder = new google.maps.Geocoder();
                var geocoder = new google.maps.Geocoder();
                google.maps.event.addListener(map, 'click', function (event) {
                    SelectedLatLng = event.latLng;
                    geocoder.geocode({
                        'latLng': event.latLng
                    }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                deleteMarkers();
                                addMarkerRunTime(event.latLng);
                                SelectedLocation = results[0].formatted_address;
                                console.log(results[0].formatted_address);
                                splitLatLng(String(event.latLng));
                                $("#pac-input").val(results[0].formatted_address);
                            }
                        }
                    });
                });

                function geocodeLatLng(geocoder, map, infowindow, markerCurrent) {
                    var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};
                    /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
                    $('#latitude').val(markerCurrent.position.lat());
                    $('#longitude').val(markerCurrent.position.lng());
                    geocoder.geocode({'location': latlng}, function (results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                map.setZoom(8);
                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    map: map
                                });
                                markers.push(marker);
                                infowindow.setContent(results[0].formatted_address);
                                SelectedLocation = results[0].formatted_address;
                                $("#pac-input").val(results[0].formatted_address);
                                infowindow.open(map, marker);
                            } else {
                                window.alert('No results found');
                            }
                        } else {
                            window.alert('Geocoder failed due to: ' + status);
                        }
                    });
                    SelectedLatLng = (markerCurrent.position.lat(), markerCurrent.position.lng());
                }

                function addMarkerRunTime(location) {
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                    markers.push(marker);
                }

                function setMapOnAll(map) {
                    for (var i = 0; i < markers.length; i++) {
                        markers[i].setMap(map);
                    }
                }

                function clearMarkers() {
                    setMapOnAll(null);
                }

                function deleteMarkers() {
                    clearMarkers();
                    markers = [];
                }

                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                $("#pac-input").val("{{ $advertising->address }} ");
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function () {
                    searchBox.setBounds(map.getBounds());
                });
                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function () {
                    var places = searchBox.getPlaces();
                    if (places.length == 0) {
                        return;
                    }
                    // Clear out the old markers.
                    markers.forEach(function (marker) {
                        marker.setMap(null);
                    });
                    markers = [];
                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function (place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(100, 100),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };
                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));
                        $('#latitude').val(place.geometry.location.lat());
                        $('#longitude').val(place.geometry.location.lng());
                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);
            }

            function splitLatLng(latLng) {
                var newString = latLng.substring(0, latLng.length - 1);
                var newString2 = newString.substring(1);
                var trainindIdArray = newString2.split(',');
                var lat = trainindIdArray[0];
                var Lng = trainindIdArray[1];
                $("#latitude").val(lat);
                $("#longitude").val(Lng);
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPceSsErOlOqRVJ7qIb2ZnbKTPnXb4uP0&libraries=places&callback=initAutocomplete&language=ar&region=SA
         async defer"></script>
        <script>
            $(document).ready(function () {
                $(".owl-carousel").owlCarousel({
                    rtl: true,
                    loop: true,
                    nav: true,
                    lazyLoad: true,
                    items: 1,
                    autoHeight: true,
                });
            });
        </script>
        <script src="{{ asset('front-end/js/main.js')}}"></script>
        <script src="{{ asset('front-end/js/nav-footer.js')}}"></script>
        <script src="{{ asset('front-end/js/owl.carousel.min.js')}}"></script>
        <script>
            $(document).ready(function () {
                $("#ad-description").click(function () {
                    $(".terms-for-sales").addClass("d-none");
                    $(".comment-section").addClass("d-none");
                    $(".rates").removeClass("d-none");
                    $(this)
                        .removeClass("the-button")
                        .addClass("active-btn")
                        .siblings()
                        .removeClass("active-btn");
                });
                $("#comments").click(function () {
                    $(".rates").addClass("d-none");
                    $(".terms-for-sales").addClass("d-none");
                    $(".comment-section").removeClass("d-none");
                    $(this)
                        .removeClass("the-button")
                        .addClass("active-btn")
                        .siblings()
                        .removeClass("active-btn");
                });
                $("#terms-for-ad").click(function () {
                    $(".terms-for-sales").removeClass("d-none");
                    $(".rates").addClass("d-none");
                    $(".comment-section").addClass("d-none");
                    $(this)
                        .removeClass("the-button")
                        .addClass("active-btn")
                        .siblings()
                        .removeClass("active-btn");
                });
            });
        </script>

        <script>
            $(document).on("click", ".reply", function () {
                var parent_id = $(this).data('parent_id');
                $(".modal-content #parent_id").val(parent_id);
            });


            $(document).on("click", ".send-message", function () {
                var advertiser_id = $(this).data('advertiser_id');
                $(".modal-content #advertiser_id").val(advertiser_id);
            });

        </script>
    @endpush
@endsection
