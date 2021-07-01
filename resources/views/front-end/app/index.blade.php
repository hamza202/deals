@extends('front-end.layouts.site')
@push('styles')

    <link rel="stylesheet" href="{{ asset('front-end/css/custome.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front-end/css/home.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front-end/css/responsive.css')}}"/>

    <style>
        div#mai {
            display: none;
        }

        body > header > div:nth-child(3) > div:nth-child(5) > div > div.columns.col-12.col-xl-3.col-lg-4.col-sm-6.d-none.d-lg-block.header-ad-img > div > div {
            height: 385px;
        }

        body > header > div:nth-child(3) > div.col-12.col-lg-9.mt-lg-auto.mt-4 {
            margin-top: 15px !important;
        }

        body > header > div:nth-child(3) > div:nth-child(5) > div > div.columns.col-12.col-xl-3.col-lg-4.col-sm-6.d-none.d-lg-block.header-ad-img {
            padding: 0;
        }

        #overlay {
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.4);
            width: 100%;
            position: relative;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .hideoverflow {
            height: 100vh;
            width: 100%;
            overflow-y: hidden;
            position: absolute;
            top: 0;
            right: 0;
        }

        .hide {
            display: none;
        }

        .close-icon {
            cursor: pointer;
            padding: 15px;
        }
    </style>
@endpush
@section('content')
    @php
        session_start();
    @endphp
    @if(!empty($first_advertising) && !isset($_SESSION['FirstVisit']))
        <div id="overlay"
             class="overlay"
        >
            <div class="card mb-3 first-card">
            <span style="width: 50px" class="pull-right clickable close-icon" data-effect="fadeOut">
                <i style="font-size: 18px;color: #a9ae00" class="fa fa-times"></i>
            </span>

                <h2 class="m-auto card-title">{{$first_advertising -> title}}</h2>
                <div class="row no-gutters" style="display: flex;margin:15px">

                    <div class="col-md-7" style="padding: 10px">
                        <img src="{{asset(App\Models\Advertising::photoValue($first_advertising -> photos))}}"
                             class="card-img" alt="..." style="max-height: 250px; object-fit: cover">
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <a href="{{route('advertising.card-details', $first_advertising -> id)}}">
                                <h6 class="card-title">{{$first_advertising -> id}}#</h6>
                                <h6 class="card-title">{{$first_advertising -> title}}</h6>
                            </a>
                            <div class="d-flex body-card-icon">
                                <div class="d-flex ml-4 align-items-center">
                                    <i class="far fa-user ml-2"></i>
                                    <a href="{{route('advertiser.profile.data', $first_advertising ->  Advertiser -> id)}}">
                                        <p>{{$first_advertising ->  Advertiser -> name }}</p>
                                    </a>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt ml-2"></i>
                                    <a href="{{route('advertising.card-details', $first_advertising -> id)}}">
                                        <p>{{$first_advertising ->  cityAdvertising -> name }}</p>
                                    </a>
                                </div>
                            </div>
                            <p class="mt-3 content-card-text">
                                {{ $first_advertising -> description}}
                            </p>
                            <h6> {{ $first_advertising -> price}} ريال </h6>

                            <div class="footer-card d-flex justify-content-between my-3">

                                <div class="d-flex">
                                    @if(CategoryRating($first_advertising -> id) == 5)
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>

                                    @elseif(CategoryRating($first_advertising -> id)  == 4)
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star empty-star star-icon"></i>


                                    @elseif(CategoryRating($first_advertising -> id)  == 3)
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star empty-star star-icon"></i>
                                        <i class="fas fa-star empty-star star-icon"></i>


                                    @elseif(CategoryRating($first_advertising -> id)  == 2)
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                        <i class="fas fa-star empty-star star-icon"></i>
                                        <i class="fas fa-star empty-star star-icon"></i>
                                        <i class="fas fa-star empty-star star-icon"></i>


                                    @elseif(CategoryRating($first_advertising -> id)  == 1)
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

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div id="webform"
         @if(!empty($first_advertising)  && !isset($_SESSION['FirstVisit']))
         class="hideoverflow"
        @endif>

    @include('front-end.layouts.includes._header')
    @include('front-end.layouts.includes.alerts.errors')
    @include('front-end.layouts.includes.alerts.success')
    <!-- Modal -->
        @if(isset($questionnaires))

            <div style="height: 34px;background: #fecb2f;">
                <div class="container">
                    <div class="col row text-center justify-content-center">
                        <p class="text-center" style="color: #fff; margin-top: 4px;">
                            الرجاء تعبئة الاستبيان التالى : <a href="{{$questionnaires ->url}}"> انقر هنا </a>
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <header class="new-head-res container mt-4">
            <div class="share-link-res-ui d-flex shared-wrapper">
                <a
                    onclick="return false"
                    id="toggole-shear-btn"
                    class="share-link-res-ali align-items-center d-flex justify-content-center postion-absolute px-3 shared-deal"
                    href="javascipt::void(0)"
                >
                    <i class="fas fa-share"></i>
                    <span class="mr-2">شارك ديل</span>
                </a>

                <div class="share-link-res-pa pr-4 d-flex justify-content-center align-items-center">
                    <div class="share-link-res-ne1 form-group col-12">
                        <label for="">رابط المشاركة</label>
                        <div class="share-link-res-group input-group">
                            <input
                                type="text"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="رابط المشاركة"
                                class="share-link-res-form form-control"
                                readonly
                                name="shear"
                                id="shearlink"
                                value="http://dealsa.co/"
                            />

                            <div class="share-link-res input-group-prepend">
                                <button
                                    type="button"
                                    id="copy-share-link"
                                    data-clipboard-target="#shearlink"
                                    class="share-link-res-new btn btn-outline-secondary form-control"
                                >
                                    <i class="fas fa-copy"></i> &nbsp; نسخ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="new-resp row">
                <div class="new-resp2 order-1 col-12 col-md-3">
                    <button
                        type="button"
                        class="button-package btn btn-secondary mb-4 mt-4 mt-md-2 py-2 rounded-pill w-100"
                        onclick="window.location.href='{{route('advertiser.subscription')}}'"
                    >
                        اشترك في الباقات
                    </button>
                </div>
                <div class="search-new-resp order-2 col-12 col-md-9">
                    <form class="w-100 mx-auto mb-4 mb-md-0" method="POST" action="{{route('index.first_search')}}">
                        @csrf
                        <div
                            class="d-flex d-flex pl-4 rounded-pill search-container py-1 pr-2"
                        >
                            <input
                                name="filter"
                                class="input-search form-control rounded-pill border-0"
                                type="search"
                                placeholder="ابحث عن ما تشاء، مثلا:(عقارات، ايجارات)"
                                aria-label="Search"
                            />
                            <button class="my-auto" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="new-list row">
                <div class="new-list1 col-12 col-lg-3">
                    <div class="new-list2 mb-3 p-3 pb-lg-5 pb-xl-4 right-menu">
                        <ul class="new-list3 d-flex d-lg-block flex-wrap justify-content-center">
                            <a class="new-list-hr" href="{{route('know-rights')}}">
                                <li class="new-list-hrli">خدمه اعرف حقك من ديل</li>
                            </a>
                            <a class="new-list-hr" href="{{route('amr-tidall')}}">
                                <li class="new-list-hrli">امر تدلل</li>
                            </a>
                            <a class="new-list-hr" href="{{route('gifts-deal')}}">
                                <li class="new-list-hrli"> هدايا آمر تدلل</li>
                            </a>
                            <a class="new-list-hr" href="{{route('type-member')}}">
                                <li class="new-list-hrli"> عضويات ديل</li>
                            </a>
                            <a class="new-list-hr" href="{{route('site-treaty')}}">
                                <li class="new-list-hrli">معاهدة الموقع</li>
                            </a>
                            <a class="new-list-hr" href="{{route('black-list')}}">
                                <li class="new-list-hrli">القائمة السوداء</li>
                            </a>
                        </ul>
                    </div>
                </div>
                <br><br>
                <div class="col-12 col-lg-9 slider-home">
                    <div
                        id="carouselExampleIndicators"
                        class="carousel slide new-slide-res"
                        data-ride="carousel"
                    >
                        <ol dir="ltr" class="new-slide-res-car carousel-indicators">
                            <?php
                            $count = 0;
                            ?>
                            @foreach(\App\Models\Slider::get()  as $counts)
                                <li
                                    data-target="#carouselExampleIndicators"
                                    data-slide-to="{{$count}}"
                                    @if($count == 0) class="active" @endif
                                ></li>
                                <?php $count++; ?>
                            @endforeach
                        </ol>
                        <div class="new-slide-res-in carousel-inner">
                            @php
                                $slide_num = 0;
                            @endphp
                            @foreach($slider as $slide)

                                @php
                                    $slide_num++;
                                @endphp
                                <div
                                    @if($slide_num == 1)
                                    class="new-slide-item carousel-item active"
                                    @else
                                    class="carousel-item new-slide-item"
                                    @endif
                                >
                                    <img
                                        class="d-block"
                                        src="{{ $slide -> photo}}"
                                        alt=" slide"
                                        width="900px"
                                        height="600px"

                                    />
                                    @if($slide -> description != null || $slide -> link != null )
                                        <div
                                            class="new-slide-res-cap carousel-caption text-right w-75">
                                            <div class="new-slide-res-text text-slider d-none d-md-block">
                                                <p>
                                                    @if($slide -> description != null)
                                                        {{ $slide -> description}}
                                                    @endif
                                                </p>
                                                <p>
                                                    @if($slide -> link != null)
                                                        <a href="{{$slide -> link}}" style="color: white">
                                                            المزيد</a>
                                                    @endif
                                                </p>
                                            </div>
                                            <button
                                                type="button"
                                                class="new-slide-res-btn btn btn-primary  mx-auto shadow-sm mt-3"
                                                id="btn-nav"
                                                onclick="window.location.href='{{route('advertiser.subscription')}}'"
                                            >
                                                اشترك الان
                                            </button>
                                        </div>
                                    @else
                                        <div
                                            class="new-slide-res-caption carousel-caption d-none d-md-block text-right w-75">
                                            <button
                                                type="button"
                                                class="new-slide-res-cap-btn btn btn-primary mx-auto shadow-sm mt-3"
                                                id="btn-nav"
                                                onclick="window.location.href='{{route('advertiser.subscription')}}'"
                                            >
                                                اشترك الان
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <a
                            class="carousel-control-prev d-none d-md-flex"
                            href="#carouselExampleIndicators"
                            role="button"
                            data-slide="prev"
                        >
              <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
              ></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a
                            class="carousel-control-next"
                            href="#carouselExampleIndicators"
                            role="button"
                            data-slide="next"
                        >
              <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
              ></span>
                            <span class="slide-number d-inline d-md-none">0<span class="num">1</span></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="card-new-res col-12 col-lg-3">
                    <div class="card-new-res-home-1 card-home">

                        @if($firstPaner != null)
                            <div
                                class="card-new-res-ele columns col-12 col-xl-3 col-lg-4 col-sm-6 d-none d-lg-block header-ad-img">
                                <div class="card-new-res card-home">
                                    <a href="{{$firstPaner->url}}">
                                        <img
                                            src="{{$firstPaner->photo}}"
                                            alt="ads"
                                            class="d-none d-lg-block header-ad-img"
                                            style="
    margin-right: -12px;width:270px;height: 435px;
"
                                        /></a>
                                    <img

                                        src="{{ asset('front-end/images/مساحة اعلانية-h.svg')}}"
                                        alt="ads"
                                        class="d-block d-lg-none w-100"
                                    />
                                </div>
                            </div>
                        @else
                            <div
                                class="card-new-home-7 columns col-12 col-xl-3 col-lg-4 col-sm-6 d-none d-lg-block header-ad-img">
                                <div class="card-new-res-b card-home">
                                    <img

                                        src="{{ asset('front-end/images/مساحة اعلانية.png')}}"
                                        alt="ads"
                                        class="d-none d-lg-block header-ad-img"
                                        style="
    margin-right: -12px;
"
                                    />
                                    <img

                                        src="{{ asset('front-end/images/مساحة اعلانية-h.svg')}}"
                                        alt="ads"
                                        class="d-block d-lg-none w-100"
                                    />
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="search-new col-12 col-lg-9 mt-4">
                    <h6 class="txt-filter-search">بحث متقدم</h6>

                    <form class="search-new-form w-100 mx-auto mb-4 mb-md-0" method="POST"
                          action="{{route('index.second_search')}}">
                        @csrf
                        <div
                            class="search-new1 d-flex flex-wrap align-items-center filter-search justify-content-between"
                        >

                            <div class="search-new2 d-flex col-12 col-md-10 row mx-auto p-0">

                                <div class="search-new3 form-group pt-1 px-1 p-0 ml-0 col-12 col-md-4">
                                    <select
                                        id=" "
                                        class="search-new4 form-control h-100 px-3 select2"
                                        name="city_id"
                                        style="width: 100%;"
                                    >
                                        @foreach($cities as $city)
                                            <option value="{{$city -> id}}">{{$city -> name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="search-new5 form-group pt-1 px-1 p-0 ml-0 col-12 col-md-4">
                                    <select
                                        id="country"
                                        class="search-new6 form-control h-100 select2"
                                        name="category_id"
                                        style="width: 100%;"
                                    >

                                        <option value="" selected disabled>اختر القسم الرئيسي</option>
                                        @foreach($main_category as $key => $country)
                                            <option value="{{$key}}"> {{$country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="search-new7 form-group pt-1 px-1 p-0 ml-0 col-12 col-md-4">

                                    <select name=state id="state"
                                            class="search-new8 form-control h-100 select2"
                                            style="width: 100%;"
                                    >
                                        <option value="" selected disabled>اختر القسم الفرعي</option>
                                    </select>

                                </div>

                                <!-- <div class="form-group pt-3">
                                <select id="" class="form-control h-100 select2" name="">
                                  <option selected>اختر القسم الداخلى</option>
                                  <option>BMW</option>
                                  <option>Audi</option>
                                  <option>Maruti</option>
                                  <option>Tesla</option>
                                </select>
                              </div> -->

                            </div>

                            <div
                                class="search-new-icons d-flex col-12 col-md-2 p-0 pt-2 pt-md-0 justify-content-center justify-content-md-end"
                            >
                                <div class="search-new-icons1 form-group pt-1 mr-3">
                                    <button type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>

                                <div class="search-new-icons2 form-group pt-1 mr-1">
                                    <a id="grid-items" class="order-icon active">
                                        <i class="fas fa-th"></i>
                                    </a>
                                </div>
                                <div class="search-new-icons3 form-group pt-1 mr-1">
                                    <a id="list-items" class="order-icon">
                                        <i class="fas fa-list"></i>
                                    </a>
                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </header>

        <main class="con-res mt-4">

            <div class="res-container-new container">
                <div class="res-row-con row">
                    @if(!empty($second_advertising))
                        <div class="res-new-v columns col-12 col-xl-3 col-lg-4 col-sm-6 d-none  d-lg-block w-100">
                            <div class="res-b card mb-4">
                                <div class="res-c content-card">
                                    <div
                                        style="
                                            background-image: url('{{ App\Models\Advertising::photoValue($second_advertising -> photos)}}');
                                            "
                                        class="res-newa head-card align-items-end d-flex head-card justify-content-end"
                                    >
                                        <a
                                            href="{{route('advertising.card-details', $second_advertising -> id)}}"
                                            class="res-te-ne w-100 h-100 align-items-end d-flex justify-content-end"
                                        >
                                            <div
                                                class="res-nn-new fixed-label align-items-center d-flex fixed-label justify-content-center"
                                            >

                                                <span>مثبت </span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="res-bo-new body-card px-3">
                                        <div class="resa-s d-flex justify-content-between mt-3">
                                            <a href="{{route('advertising.card-details', $second_advertising -> id)}}">
                                                <h6>{{$second_advertising -> id}}#</h6>
                                                <h6>{{$second_advertising -> title}}</h6>
                                            </a>

                                            @if(AdvertisingFavourite( $second_advertising -> id) == false )
                                                <div class="res-love-b love-icon-card mt-2 ">
                                                    <button
                                                        onclick="window.location.href='{{route('advertiser_index.addFavourite' , ['id' => $second_advertising -> id ] )}}'">
                                                        <i class="far fa-heart mt-1"></i>
                                                    </button>
                                                </div>

                                            @else
                                                <div class="res-love2 love-icon-card mt-2 active ">
                                                    <button
                                                        onclick="window.location.href='{{route('advertiser_index.removeFavourite' , ['id' => $second_advertising -> id ] )}}'">
                                                        <i class="far fa-heart mt-1"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="res-m-n d-flex body-card-icon">
                                            <div class="b-new d-flex ml-4 align-items-center">
                                                <i class="far fa-user ml-2"></i>
                                                <a href="{{route('advertiser.profile.data', $second_advertising ->  Advertiser -> id)}}">
                                                    <p>{{$second_advertising ->  Advertiser -> name }}</p>
                                                </a>
                                            </div>
                                            <div class="b-m-new-fle d-flex align-items-center">
                                                <i class="fas fa-map-marker-alt ml-2"></i>
                                                <a href="{{route('advertising.card-details', $second_advertising -> id)}}">
                                                    <p>{{$second_advertising ->  cityAdvertising -> name }}</p>
                                                </a>
                                            </div>
                                        </div>
                                        <p class="res-oo mt-3 content-card-text">
                                            {{ $second_advertising -> description}}
                                        </p>
                                        <h6> {{ $second_advertising -> price}} ريال </h6>


                                        <div class="res-o1 footer-card d-flex justify-content-between my-3">

                                            <div class="res-p7 d-flex">
                                                @if(CategoryRating($second_advertising -> id) == 5)
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>

                                                @elseif(CategoryRating($second_advertising -> id)  == 4)
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star empty-star star-icon"></i>


                                                @elseif(CategoryRating($second_advertising -> id)  == 3)
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star empty-star star-icon"></i>
                                                    <i class="fas fa-star empty-star star-icon"></i>


                                                @elseif(CategoryRating($second_advertising -> id)  == 2)
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star empty-star star-icon"></i>
                                                    <i class="fas fa-star empty-star star-icon"></i>
                                                    <i class="fas fa-star empty-star star-icon"></i>


                                                @elseif(CategoryRating($second_advertising -> id)  == 1)
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
                                            <div class="res-po-8 d-flex time-publish align-items-center">
                                                <i class="far fa-clock" aria-hidden="true"></i>
                                                <p class="res-dd-1 mr-1">
                                                    @php
                                                        \Carbon\Carbon::setLocale('ar');
                                                    @endphp
                                                    {{ \Carbon\Carbon::parse($second_advertising->created_at)->diffForHumans() }}
                                                </p>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="res777 columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
    height: 390px;
">
                            <div
                                class="res100 h-100 align-items-center card d-flex justify-content-center mb-4 create-ad-card"
                            >
                                <button class="resu1 h-100 py-5 py-sm-0 w-100"
                                        onclick="window.location.href='{{route('advertising')}}'"
                                >

                                    <div class="res7o d-flex justify-content-center">
                                        <i class="fas fa-plus-circle"></i>
                                    </div>
                                    <h6 class="res-pl-7 fixed-ad">ثبت اعلانك هنا</h6>
                                </button>
                            </div>
                        </div>

                    @endif

                    @if(count($fixed_advertising->toArray())==3)

                        @foreach($fixed_advertising as $fixed_advertising)
                            <div class="re1 columns col-12 col-xl-3 col-lg-4 col-sm-6">
                                <div class="re2 card mb-4">
                                    <div class="content-card">
                                        <div
                                            class="re3 head-card align-items-end d-flex head-card justify-content-end"
                                            style="

                                                background-image: url('{{ App\Models\Advertising::photoValue($fixed_advertising -> photos)}}');

                                                ">
                                            <a
                                                href="{{route('advertising.card-details', $fixed_advertising -> id)}}"
                                                class="re4 w-100 h-100 align-items-end d-flex justify-content-end"
                                            >
                                                <div
                                                    class="re5 fixed-label align-items-center d-flex fixed-label justify-content-center"
                                                >
                                                    <span>مثبت</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="re6 body-card px-3">
                                            <div class="d-flex justify-content-between mt-3">
                                                <a href="{{route('advertising.card-details', $fixed_advertising -> id)}}">
                                                    <h6>{{$fixed_advertising -> id}}#</h6>

                                                    <h6>{{$fixed_advertising -> title}}</h6>
                                                </a>
                                                @if(AdvertisingFavourite( $fixed_advertising -> id) == false )
                                                    <div class="love-icon-card mt-2 ">
                                                        <button
                                                            onclick="window.location.href='{{route('advertiser_index.addFavourite' , ['id' => $fixed_advertising -> id ] )}}'">
                                                            <i class="far fa-heart mt-1"></i>
                                                        </button>
                                                    </div>

                                                @else
                                                    <div class="love-icon-card mt-2 active ">
                                                        <button
                                                            onclick="window.location.href='{{route('advertiser_index.removeFavourite' , ['id' => $fixed_advertising -> id ] )}}'">
                                                            <i class="far fa-heart mt-1"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-flex body-card-icon">
                                                <div class="d-flex ml-4 align-items-center">
                                                    <i class="far fa-user ml-2"></i>

                                                    <a href="{{route('advertiser.profile.data', $fixed_advertising ->  Advertiser -> id)}}">
                                                        <p>{{$fixed_advertising ->  Advertiser -> name }}</p>
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-map-marker-alt ml-2"></i>
                                                    <a href="{{route('advertising.card-details', $fixed_advertising -> id)}}">
                                                        <p>{{$fixed_advertising ->  cityAdvertising -> name }}</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <p class="mt-3 content-card-text">
                                                {{ $fixed_advertising -> description}}
                                            </p>
                                            <h6> {{ $fixed_advertising -> price}} ريال </h6>


                                            <div class="footer-card d-flex justify-content-between my-3">

                                                <div class="d-flex">
                                                    @if(CategoryRating($fixed_advertising -> id) == 5)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>

                                                    @elseif(CategoryRating($fixed_advertising -> id)  == 4)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @elseif(CategoryRating($fixed_advertising -> id)  == 3)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @elseif(CategoryRating($fixed_advertising -> id)  == 2)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @elseif(CategoryRating($fixed_advertising -> id)  == 1)
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
                                                        {{ \Carbon\Carbon::parse($fixed_advertising->created_at)->diffForHumans() }}
                                                    </p>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endif
                    @if(count($fixed_advertising->toArray())==2)
                        @foreach($fixed_advertising as $fixed_advertising)
                            <div class="red2 columns col-12 col-xl-3 col-lg-4 col-sm-6">
                                <div class="card mb-4">
                                    <div class="content-card">
                                        <div
                                            class="head-card align-items-end d-flex head-card justify-content-end"
                                            style="

                                                background-image: url('{{ App\Models\Advertising::photoValue($fixed_advertising -> photos)}}');

                                                ">
                                            <a
                                                href="{{route('advertising.card-details', $fixed_advertising -> id)}}"
                                                class="w-100 h-100 align-items-end d-flex justify-content-end"
                                            >
                                                <div
                                                    class="fixed-label align-items-center d-flex fixed-label justify-content-center"
                                                >
                                                    <span>مثبت</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="body-card px-3">
                                            <div class="d-flex justify-content-between mt-3">
                                                <a href="{{route('advertising.card-details', $fixed_advertising -> id)}}">
                                                    <h6>{{$fixed_advertising -> id}}#</h6>

                                                    <h6>{{$fixed_advertising -> title}}</h6>
                                                </a>
                                                @if(AdvertisingFavourite( $fixed_advertising -> id) == false )
                                                    <div class="love-icon-card mt-2 ">
                                                        <button
                                                            onclick="window.location.href='{{route('advertiser_index.addFavourite' , ['id' => $fixed_advertising -> id ] )}}'">
                                                            <i class="far fa-heart mt-1"></i>
                                                        </button>
                                                    </div>

                                                @else
                                                    <div class="love-icon-card mt-2 active ">
                                                        <button
                                                            onclick="window.location.href='{{route('advertiser_index.removeFavourite' , ['id' => $fixed_advertising -> id ] )}}'">
                                                            <i class="far fa-heart mt-1"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-flex body-card-icon">
                                                <div class="d-flex ml-4 align-items-center">
                                                    <i class="far fa-user ml-2"></i>

                                                    <a href="{{route('advertiser.profile.data', $fixed_advertising ->  Advertiser -> id)}}">
                                                        <p>{{$fixed_advertising ->  Advertiser -> name }}</p>
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-map-marker-alt ml-2"></i>
                                                    <a href="{{route('advertising.card-details', $fixed_advertising -> id)}}">
                                                        <p>{{$fixed_advertising ->  cityAdvertising -> name }}</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <p class="mt-3 content-card-text">
                                                {{ $fixed_advertising -> description}}
                                            </p>
                                            <h6> {{ $fixed_advertising -> price}} ريال </h6>


                                            <div class="footer-card d-flex justify-content-between my-3">

                                                <div class="d-flex">
                                                    @if(CategoryRating($fixed_advertising -> id) == 5)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>

                                                    @elseif(CategoryRating($fixed_advertising -> id)  == 4)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @elseif(CategoryRating($fixed_advertising -> id)  == 3)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @elseif(CategoryRating($fixed_advertising -> id)  == 2)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @elseif(CategoryRating($fixed_advertising -> id)  == 1)
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
                                                        {{ \Carbon\Carbon::parse($fixed_advertising->created_at)->diffForHumans() }}
                                                    </p>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="red4 columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
    height: 390px;
">
                            <div
                                class="h-100 align-items-center card d-flex justify-content-center mb-4 create-ad-card"
                            >
                                <button class="h-100 py-5 py-sm-0 w-100"
                                        onclick="window.location.href='{{route('advertising')}}'">
                                    <div class="d-flex justify-content-center">
                                        <i class="fas fa-plus-circle"></i>
                                    </div>
                                    <h6 class="fixed-ad">ثبت اعلانك هنا</h6>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if(count($fixed_advertising->toArray())==1)
                        @foreach($fixed_advertising as $fixed_advertising)
                            <div class="red9 columns col-12 col-xl-3 col-lg-4 col-sm-6">
                                <div class="card mb-4">
                                    <div class="content-card">
                                        <div
                                            class="head-card align-items-end d-flex head-card justify-content-end"
                                            style="

                                                background-image: url('{{ App\Models\Advertising::photoValue($fixed_advertising -> photos)}}');

                                                ">
                                            <a
                                                href="{{route('advertising.card-details', $fixed_advertising -> id)}}"
                                                class="w-100 h-100 align-items-end d-flex justify-content-end"
                                            >
                                                <div
                                                    class="fixed-label align-items-center d-flex fixed-label justify-content-center"
                                                >
                                                    <span>مثبت</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="body-card px-3">
                                            <div class="d-flex justify-content-between mt-3">
                                                <a href="{{route('advertising.card-details', $fixed_advertising -> id)}}">
                                                    <h6>{{$fixed_advertising -> id}}#</h6>

                                                    <h6>{{$fixed_advertising -> title}}</h6>
                                                </a>
                                                @if(AdvertisingFavourite( $fixed_advertising -> id) == false )
                                                    <div class="love-icon-card mt-2 ">
                                                        <button
                                                            onclick="window.location.href='{{route('advertiser_index.addFavourite' , ['id' => $fixed_advertising -> id ] )}}'">
                                                            <i class="far fa-heart mt-1"></i>
                                                        </button>
                                                    </div>

                                                @else
                                                    <div class="love-icon-card mt-2 active ">
                                                        <button
                                                            onclick="window.location.href='{{route('advertiser_index.removeFavourite' , ['id' => $fixed_advertising -> id ] )}}'">
                                                            <i class="far fa-heart mt-1"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-flex body-card-icon">
                                                <div class="d-flex ml-4 align-items-center">
                                                    <i class="far fa-user ml-2"></i>

                                                    <a href="{{route('advertiser.profile.data', $fixed_advertising ->  Advertiser -> id)}}">
                                                        <p>{{$fixed_advertising ->  Advertiser -> name }}</p>
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-map-marker-alt ml-2"></i>
                                                    <a href="{{route('advertising.card-details', $fixed_advertising -> id)}}">
                                                        <p>{{$fixed_advertising ->  cityAdvertising -> name }}</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <p class="mt-3 content-card-text">
                                                {{ $fixed_advertising -> description}}
                                            </p>
                                            <h6> {{ $fixed_advertising -> price}} ريال </h6>


                                            <div class="footer-card d-flex justify-content-between my-3">

                                                <div class="d-flex">
                                                    @if(CategoryRating($fixed_advertising -> id) == 5)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>

                                                    @elseif(CategoryRating($fixed_advertising -> id)  == 4)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @elseif(CategoryRating($fixed_advertising -> id)  == 3)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @elseif(CategoryRating($fixed_advertising -> id)  == 2)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @elseif(CategoryRating($fixed_advertising -> id)  == 1)
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
                                                        {{ \Carbon\Carbon::parse($fixed_advertising->created_at)->diffForHumans() }}
                                                    </p>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="redf columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
    height: 390px;
">
                            <div
                                class="h-100 align-items-center card d-flex justify-content-center mb-4 create-ad-card"
                            >
                                <button class="h-100 py-5 py-sm-0 w-100"
                                        onclick="window.location.href='{{route('advertising')}}'">
                                    <div class="d-flex justify-content-center">
                                        <i class="fas fa-plus-circle"></i>
                                    </div>
                                    <h6 class="fixed-ad">ثبت اعلانك هنا</h6>
                                </button>
                            </div>
                        </div>
                        <div class="reff2 columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
    height: 390px;
">
                            <div
                                class="h-100 align-items-center card d-flex justify-content-center mb-4 create-ad-card"
                            >
                                <button class="h-100 py-5 py-sm-0 w-100"
                                        onclick="window.location.href='{{route('advertising')}}'">
                                    <div class="d-flex justify-content-center">
                                        <i class="fas fa-plus-circle"></i>
                                    </div>
                                    <h6 class="fixed-ad">ثبت اعلانك هنا</h6>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if(count($fixed_advertising->toArray())==0)
                        <div class="gg-res columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
    height: 390px;
">
                            <div
                                class="h-100 align-items-center card d-flex justify-content-center mb-4 create-ad-card"
                            >
                                <button class="h-100 py-5 py-sm-0 w-100"
                                        onclick="window.location.href='{{route('advertising')}}'">
                                    <div class="d-flex justify-content-center">
                                        <i class="fas fa-plus-circle"></i>
                                    </div>
                                    <h6 class="fixed-ad">ثبت اعلانك هنا</h6>
                                </button>
                            </div>
                        </div>
                        <div class="ff-8 columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
    height: 390px;
">
                            <div
                                class="h-100 align-items-center card d-flex justify-content-center mb-4 create-ad-card"
                            >
                                <button class="h-100 py-5 py-sm-0 w-100"
                                        onclick="window.location.href='{{route('advertising')}}'">
                                    <div class="d-flex justify-content-center">
                                        <i class="fas fa-plus-circle"></i>
                                    </div>
                                    <h6 class="fixed-ad">ثبت اعلانك هنا</h6>
                                </button>
                            </div>
                        </div>
                        <div class="bb88 columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
    height: 390px;
">
                            <div
                                class="h-100 align-items-center card d-flex justify-content-center mb-4 create-ad-card"
                            >
                                <button class="h-100 py-5 py-sm-0 w-100"
                                        onclick="window.location.href='{{route('advertising')}}'">
                                    <div class="d-flex justify-content-center">
                                        <i class="fas fa-plus-circle"></i>
                                    </div>
                                    <h6 class="fixed-ad">ثبت اعلانك هنا</h6>
                                </button>
                            </div>
                        </div>
                    @endif


                    @if($secondPaner != null)
                        <div class="bnm col-12 mb-4 mt-3">
                            <a href="{{$secondPaner->url}}">
                                <img class="ad-area-lg"
                                     src="{{ $secondPaner->photo}}"
                                     alt="ad-area"
                                     style="width: 1140px;height: 180px">
                            </a>
                        </div>
                    @else
                        <div class="bnv col-12 mb-4 mt-3">
                            <img class="ad-area-lg"
                                 src="{{ asset('front-end/images/مساحة اعلانية-h-lg.svg')}}"
                                 alt="ad-area">
                        </div>
                    @endif
                    @php
                        $countee = 0;
                    @endphp


                    @if(!empty($all_advertising->toArray()))
                        @foreach($all_advertising as $change)
                            @php
                                $countee = $countee+1;
                            @endphp
                            <div class="oiu columns col-12 col-xl-3 col-lg-4 col-sm-6 mai"
                                 @if($countee > 6)
                                 id="mai"
                                @endif
                            >
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
                                                    <h6>{{$change -> id}}#</h6>
                                                    <h6>{{$change -> title}}</h6>
                                                </a>

                                                @if(AdvertisingFavourite( $change -> id) == false )
                                                    <div class="love-icon-card mt-2 ">
                                                        <button
                                                            onclick="window.location.href='{{route('advertiser_index.addFavourite' , ['id' => $change -> id ] )}}'">
                                                            <i class="far fa-heart mt-1"></i>
                                                        </button>
                                                    </div>

                                                @else
                                                    <div class="love-icon-card mt-2 active ">
                                                        <button
                                                            onclick="window.location.href='{{route('advertiser_index.removeFavourite' , ['id' => $change -> id ] )}}'">
                                                            <i class="far fa-heart mt-1"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-flex body-card-icon">
                                                <div class="d-flex ml-4 align-items-center">
                                                    <i class="far fa-user ml-2"></i>
                                                    <a href="{{route('advertiser.profile.data', $change ->  Advertiser -> id)}}">
                                                        <p>{{$change->Advertiser->name }}</p>
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-map-marker-alt ml-2"></i>
                                                    <a href="{{route('advertising.card-details', $change -> id)}}">
                                                        <p>{{$change->cityAdvertising->name }}</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <p class="mt-3 content-card-text">
                                                {{ $change -> description}}
                                            </p>
                                            <h6> {{ $change -> price}} ريال </h6>


                                            <div class="footer-card d-flex justify-content-between my-3">

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
                        @endforeach

                    @else
                        <div class="bnhh col-12 mb-4 mt-3">
                            <img
                                class="ad-area-lg"
                                src="{{ asset('front-end/images/مساحة اعلانية-h-lg.svg')}}"
                                alt="ad-area"
                            />
                        </div>
                    @endif
                </div>
            </div>

            @if(!empty($all_advertising->toArray()))
                <div
                    class="vbcx row d-flex justify-content-center align-items-center load-more"
                >
                    <button class="w-100" id="mai1">
                        <div class="d-flex justify-content-center align-items-center py-2">
                            <h6 class="ml-3">
                                <a href="#" id="load">المزيد</a></h6>
                            <img src="{{ asset('front-end/images/loading.svg')}}" alt="loading..."/>
                        </div>
                    </button>
                </div>
            @endif

        </main>

        @include('front-end.layouts.includes._footer')
    </div>
    @php
        $_SESSION['FirstVisit'] = 1;
    @endphp

@endsection
@push('js')
    <script>
        $('#carouselExampleIndicators').on('slid.bs.carousel', function() {
            currentIndex = $('div.active').index() + 1;
            $('.num').html(''+currentIndex+'');
        });
        $(function () {
            $("#mai").slice(0, 10).show(); // select the first ten
            $("#load").click(function (e) { // click event for load more
                e.preventDefault();
                $("div.mai:hidden").slice(0, 5).show(); // select next 10 hidden divs and show them
                if ($("div.mai:hidden").length == 0) { // check if any hidden divs still exist
                    $("#mai1").hide();
                }
            });
        });
        $('.close-icon').on('click', function () {
            $(this).closest('.overlay').fadeOut();
            document.getElementById('webform').classList.remove('hideoverflow');
            document.getElementById('overlay').classList.add('hide');
        })
        $('#country').change(function () {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-state-list')}}?country_id=" + countryID,
                    success: function (res) {
                        if (res) {
                            $("#state").empty();
                            $("#state").append('');
                            $.each(res, function (key, value) {
                                $("#state").append('<option value="' + key + '">' + value + '</option>');
                            });

                        } else {
                            $("#state").empty();
                        }
                    }
                });
            } else {
                $("#state").empty();
            }
        });
    </script>
@endpush
