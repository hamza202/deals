@extends('front-end.layouts.site')
@section('title' , 'الأقسام')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/clothes.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front-end/css/responsive.css')}}"/>

    <style>
        .active {
            color: #8d8282;
        }

        div.stars {
            width: 400px;
            display: inline-block;
        }

        input.star {
            display: none;
        }

        label.star {
            float: right;
            padding: 5px;
            font-size: 20px;
            color: #444;
            transition: all .2s;
        }

        input.star:checked ~ label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked ~ label.star:before {
            color: #FE7;
            text-shadow: 0 0 10px #952;
        }

        input.star-1:checked ~ label.star:before {
            color: #F62;
        }

        label.star:hover {
            transform: rotate(-15deg) scale(1.3);
        }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
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
        <div id="overlay" class="overlay">
            <div class="card mb-3" style="width: 50%">
            <span style="width: 50px" class="pull-right clickable close-icon" data-effect="fadeOut">
                <i style="font-size: 18px;color: #a9ae00" class="fa fa-times"></i>
            </span>

                <h2 class="m-auto card-title">{{$first_advertising -> title}}</h2>
                <div class="row no-gutters" style="display: flex;margin:15px">

                    <div class="col-md-7" style="padding: 10px">
                        <img src="{{asset(App\Models\Advertising::photoValue($first_advertising -> photos))}}"
                             class="card-img" alt="..." style="height: 250px">
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <a href="{{route('advertising.card-details', $first_advertising -> id)}}">
                                <h5 class="card-title">{{$first_advertising -> id}}#</h5>
                                <h5 class="card-title">{{$first_advertising -> title}}</h5>
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
                            <h5> {{ $first_advertising -> price}} ريال </h5>

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
         @if(!empty($first_advertising) && !isset($_SESSION['FirstVisit']))
         class="hideoverflow"
        @endif>

        @include('front-end.layouts.includes._header')

        <section class="container text-right">
            <!-- search form -->

        @include('front-end.layouts.includes.alerts.errors')
        @include('front-end.layouts.includes.alerts.success')


        @include('front-end.layouts.includes.search')

        <!-- path -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb d-inline-block">
                    <li class="breadcrumb-item active d-inline">
                        <a href="{{route('Category' ,$category_advertising -> id )}}">
                            {{$category_advertising -> name  }}
                        </a>
                    </li>
                </ol>
            </nav>

            <!-- cards -->

            <div class="row mt-3 mb-5">

                @if(count($constant_category->toArray())==4)

                    @foreach($constant_category as $fixed_advertising)
                        <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6">
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
                                        <h5> {{ $fixed_advertising -> price}} ريال </h5>


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
                @if(count($constant_category->toArray())==3)

                    @foreach($constant_category as $fixed_advertising)
                        <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6">
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
                                        <h5> {{ $fixed_advertising -> price}} ريال </h5>


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
                    <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
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
                                <h5 class="fixed-ad">ثبت اعلانك هنا</h5>
                            </button>
                        </div>
                    </div>
                @endif
                @if(count($constant_category->toArray())==2)
                    @foreach($constant_category as $fixed_advertising)
                        <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6">
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
                                        <h5> {{ $fixed_advertising -> price}} ريال </h5>


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

                    <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
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
                                <h5 class="fixed-ad">ثبت اعلانك هنا</h5>
                            </button>
                        </div>
                    </div>
                    <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
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
                                <h5 class="fixed-ad">ثبت اعلانك هنا</h5>
                            </button>
                        </div>
                    </div>
                @endif
                @if(count($constant_category->toArray())==1)
                    @foreach($constant_category as $fixed_advertising)
                        <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6">
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
                                        <h5> {{ $fixed_advertising -> price}}ريال </h5>


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

                    <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
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
                                <h5 class="fixed-ad">ثبت اعلانك هنا</h5>
                            </button>
                        </div>
                    </div>
                    <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
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
                                <h5 class="fixed-ad">ثبت اعلانك هنا</h5>
                            </button>
                        </div>
                    </div>
                    <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
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
                                <h5 class="fixed-ad">ثبت اعلانك هنا</h5>
                            </button>
                        </div>
                    </div>
                @endif
                @if(count($constant_category->toArray())==0)
                    <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
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
                                <h5 class="fixed-ad">ثبت اعلانك هنا</h5>
                            </button>
                        </div>
                    </div>
                    <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
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
                                <h5 class="fixed-ad">ثبت اعلانك هنا</h5>
                            </button>
                        </div>
                    </div>
                    <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
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
                                <h5 class="fixed-ad">ثبت اعلانك هنا</h5>
                            </button>
                        </div>
                    </div>
                    <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6 pb-4" style="
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
                                <h5 class="fixed-ad">ثبت اعلانك هنا</h5>
                            </button>
                        </div>
                    </div>
                @endif


                @isset($change_category)
                    @foreach($change_category as $change)
                        <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6">
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
                                                        onclick="window.location.href='{{route('advertiser_category.addFavourite' , ['id' => $change -> id , 'card_id'  =>$category_advertising -> id ] )}}'">
                                                        <i class="far fa-heart mt-1"></i>
                                                    </button>
                                                </div>

                                            @else

                                                <div class="love-icon-card mt-2 active ">
                                                    <button
                                                        onclick="window.location.href='{{route('advertiser_category.removeFavourite' , ['id' => $change -> id , 'card_id'  =>$category_advertising -> id ] )}}'">
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
                                        <h5> {{ $change -> price}} ريال</h5>


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
                @endisset


            </div>
        </section>
        @include('front-end.layouts.includes._footer')
    </div>
    @php
        $_SESSION['FirstVisit'] = 1;
    @endphp


    @push('js')
        <script>

            $('.close-icon').on('click', function () {
                $(this).closest('.overlay').fadeOut();
                document.getElementById('webform').classList.remove('hideoverflow');
                document.getElementById('overlay').classList.add('hide');
            })


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


@endsection
