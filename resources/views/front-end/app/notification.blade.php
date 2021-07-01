@extends('front-end.layouts.app')
@section('title' , '  الاشعارات')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">

    <link rel="stylesheet" href="{{ asset('front-end/css/notification.css')}}"/>
@endpush

@section('content')
    <section class="container site-page">
        <div class="column">
            <h2 class="title">الإشعارات</h2>
            <div class="my-5">
                <h6>جميع الاشعارات</h6>
                @if(!empty(advertiser()->notifications))
                    @foreach(  advertiser()->notifications as $noti)
                        @if($noti['type'] == "App\Notifications\NewCommentNotification")
                            <div class="card py-2 px-3 shadow-sm">
                                <div class="light"></div>

                                <div class="image-container mx-2 shadow-sm">
                                    <img src="{{$noti['data']['id']['photo']}}" class="image-card"/>
                                </div>
                                <h6 class="px-2 w-25">{{$noti['data']['id']['name']}} </h6>
                                <p class="px-2 w-25 card-description">
                                    <a class="dropdown-item"
                                       href="{{route('advertising.card-details', $noti['data']['title']['advertising_id'])}}">
                                        تم التعليق على اعلانك {{$noti['data']['data']['title']}} <br>
                                        من قبل {{$noti['data']['id']['name']}}

                                    </a>
                                </p>
                                <div class="date-and-buttons px-0">
                                    <?php
                                    $time = Carbon\Carbon::parse($noti['data']['title']['created_at'])->format('h:iA');
                                    ?>
                                    <p class="date my-2">{{$time  }} </p>
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-light dropdown-toggle"
                                            type="button"
                                            id="dropdownMenuButton"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div
                                            class="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton"
                                        >

                                            <a class="dropdown-item" href="{{route('advertiser.notification.delete' , $noti->id)}}">
                                                <div class="d-flex">
                                                    <p>ازالة هذا الاشعار</p>
                                                    <i class="fas fa-trash"></i>
                                                </div>
                                                <hr/>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                        @elseif($noti['type'] == "App\Notifications\NewFollowingNotification")
                            <div class="card py-2 px-3 shadow-sm">
                                <div class="light"></div>
                                <div class="image-container mx-2 shadow-sm">
                                    <img src="{{$noti['data']['id']['photo']}}" class="image-card"/>
                                </div>
                                <h6 class="px-2 w-25">{{$noti['data']['data']}} </h6>
                                <p class="px-2 w-25 card-description">
                                    <a class="dropdown-item"
                                       href="{{route('advertiser.profile')}}">
                                        {{$noti['data']['title']}}
                                        <br>
                                        {{$noti['data']['data']}}
                                    </a>
                                </p>
                                <div class="date-and-buttons px-0">
                                    <?php
                                    $time = Carbon\Carbon::parse($noti['created_at'])->format('h:iA');
                                    ?>
                                    <p class="date my-2">{{$time}} </p>
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-light dropdown-toggle"
                                            type="button"
                                            id="dropdownMenuButton"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div
                                            class="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton"
                                        >

                                            <a class="dropdown-item" href="{{route('advertiser.notification.delete' , $noti->id)}}">
                                                <div class="d-flex">
                                                    <p>ازالة هذا الاشعار</p>
                                                    <i class="fas fa-trash"></i>
                                                </div>
                                                <hr/>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                        @elseif($noti['type'] == "App\Notifications\NewMessagesNotification")
                            <div class="card py-2 px-3 shadow-sm">
                                <div class="light"></div>
                                <div class="image-container mx-2 shadow-sm">
                                    <img src="{{$noti['data']['id']['photo']}}" class="image-card"/>
                                </div>

                                <h6 class="px-2 w-25">{{$noti['data']['id']['name']}} </h6>
                                <p class="px-2 w-25 card-description">


                                    <a class="dropdown-item"
                                       href="{{route('advertiser.profile')}}">
                                      لديك رسالة جديدة
                                        <br>
                                        {{$noti['data']['data']}}
                                    </a>
                                </p>
                                <div class="date-and-buttons px-0">
                                    <?php
                                    $time = Carbon\Carbon::parse($noti['created_at'])->format('h:iA');
                                    ?>
                                    <p class="date my-2">{{$time}} </p>
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-light dropdown-toggle"
                                            type="button"
                                            id="dropdownMenuButton"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div
                                            class="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton"
                                        >

                                            <a class="dropdown-item" href="{{route('advertiser.notification.delete' , $noti->id)}}">
                                                <div class="d-flex">
                                                    <p>ازالة هذا الاشعار</p>
                                                    <i class="fas fa-trash"></i>
                                                </div>
                                                <hr/>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                        @elseif($noti['type'] == "App\Notifications\NewPointsNotification")
                            <div class="card py-2 px-3 shadow-sm">
                                <div class="light"></div>
                                <div class="image-container mx-2 shadow-sm">
                                    <img src="{{$noti['data']['id']['photo']}}" class="image-card"/>
                                </div>
                                <h6 class="px-2 w-25">{{$noti['data']['data']}} </h6>
                                <p class="px-2 w-25 card-description">
                                    <a class="dropdown-item"
                                       href="{{route('advertiser.points')}}">
                                        {{$noti['data']['title']}}
                                        <br>
                                    </a>
                                </p>
                                <div class="date-and-buttons px-0">
                                    <?php
                                    $time = Carbon\Carbon::parse($noti['created_at'])->format('h:iA');
                                    ?>
                                    <p class="date my-2">{{$time}} </p>
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-light dropdown-toggle"
                                            type="button"
                                            id="dropdownMenuButton"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div
                                            class="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton"
                                        >

                                            <a class="dropdown-item" href="{{route('advertiser.notification.delete' , $noti->id)}}">
                                                <div class="d-flex">
                                                    <p>ازالة هذا الاشعار</p>
                                                    <i class="fas fa-trash"></i>
                                                </div>
                                                <hr/>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endif

                    @endforeach

                @else
                    <div class="card py-2 px-3 shadow-sm">
                        <div class="light"></div>

                        <h6 class="px-2 w-25"> لا يوجد اشعارات</h6>

                    </div>
                @endif

            </div>
        </div>
    </section>
@endsection
