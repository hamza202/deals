
<nav class="navbar navbar-expand-xl navbar-light bg-light shadow-sm" style="  position: relative;
  z-index: 100;">
    <div class="container-fluid top-navbar-container">
        <div class="d-flex flex-nowrap bd-highlight">
            <a class="navbar-brand order-2" href="{{route('index')}}"
            ><img id="img-brand" class="desktop-logo d-none d-xl-block" src="{{ asset('front-end/images/logo.svg')}} " alt="desktop logo"
                  style="width: 200px"/>
                <img class="mobile-logo d-xl-none d-block" src="{{ asset('front-end/images/mobile-logo.svg')}}" alt="mobile logo"/>
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto text-center link-nav">
                <li class="nav-item mx-2 {{ Request::routeIs('index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('index')}}"
                    >الرئيسية<span class="sr-only">(current)</span></a
                    >
                </li>
                <li class="nav-item mx-2 {{ Request::routeIs('about_us') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('about_us')}}">من نحن</a>
                </li>
                <li class="nav-item mx-2 {{ Request::routeIs('Category') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('Category' ,['id' => 1] )}}">سيارات
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link"
                       href="{{route('Category' ,secondCategoryHeader() )}}">{{CategoryName(secondCategoryHeader())}}</a>
                </li>
                <li class="nav-item mx-2">
                    <div class="dropdown">
                        <a class="nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            أقسام أكثر
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach(allCategoryHeader() as $index => $cat)
                                <a class="dropdown-item"
                                   href="{{route('Category' ,$cat -> id )}}">{{CategoryName( $cat -> id )}}</a>
                            @endforeach
                        </div>
                    </div>

                </li>
                <li class="nav-item mx-2 {{ Request::routeIs('call_us') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('call_us')}}">اتصل بنا</a>
                </li>
            </ul>
        </div>
        <button
            type="button"
            class="btn btn-primary mr-auto shadow-sm header-add-btn"
            id="btn-nav"
            onclick="window.location.href='{{route('advertising')}}'"
        >
            + <span class="d-sm-inline d-none">أضف اعلانك مجانا</span>
        </button>

        @if(advertiser())
            <div class="d-flex align-items-center" style="/*z-index:99;*/">
                <div class="d-flex header-notification">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarDropdown"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                onclick="{{advertiser() -> unreadNotifications ->markAsRead()}}"
                            >
                                <div
                                    class="d-flex ml-3 justify-content-center position-relative"
                                >
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                    <span id="notificatio-no">{{ advertiser() -> unreadNotifications-> count()}}</span>
                                </div>
                            </a>
                            <div
                                id="notificaion-header"
                                class="menu dropdown-menu notifiction-menu"
                                aria-labelledby="navbarDropdown"
                                style="width:300px ;height: 75vh;overflow-y: scroll!important;overflow-x: hidden;background-color: white!important;"
                            >
                                <div class="notification-details">
                                    <h3 tabindex="-1" dir="rtl" style="text-align: right ;padding: 10px"><i
                                            class="fa fa-bell" aria-hidden="true" style="color:#e2e417"></i> الاشعارات
                                    </h3>
                                    <div id="testchat" style="padding: 15px;background: #d3d3d31c;border-radius: 3px;cursor: pointer;
">
                                        <div style="text-align: right">
                                            <a href="{{route('advertiser.notification')}}"> <small> مشاهدة كل
                                                    الاشعارات</small></a>

                                        </div>
                                    </div>
                                    <?php
                                    $notifications = advertiser()->notifications;
                                    //
                                    //
                                    $count = 0;
                                    ?>
                                    @foreach($notifications as  $notification)


                                        @if($notification['type'] == "App\Notifications\NewCommentNotification")
                                            <div class="m-2" style="display: flex;
    text-align: right;">
                                                <img src="{{$notification['data']['id']['photo']}}" alt=""
                                                     style="width: 50px;height: auto;border-radius: 50%">
                                                <a class="dropdown-item"
                                                   href="{{route('advertising.card-details', $notification['data']['title']['advertising_id'])}}">
                                                    تم التعليق على اعلانك {{$notification['data']['data']['title']}}
                                                    <br>
                                                    من قبل {{$notification['data']['id']['name']}}

                                                </a>
                                            </div>
                                            <hr>

                                        @elseif($notification['type'] == "App\Notifications\NewFollowingNotification")
                                            <div class="m-2" style="display: flex;
    text-align: right;">
                                                <img src="{{$notification['data']['id']['photo']}}" alt=""
                                                     style="width: 50px;height: auto;border-radius: 50%">
                                                <a class="dropdown-item" href="{{route('advertiser.profile')}}">
                                                    {{$notification['data']['title']}}
                                                    <br>
                                                    {{$notification['data']['data']}}
                                                </a>
                                            </div>
                                            <hr>



                                        @elseif($notification['type'] == "App\Notifications\NewMessagesNotification")
                                            <div class="m-2" style="display: flex;
    text-align: right;">
                                                <img src="{{$notification['data']['id']['photo']}}" alt=""
                                                     style="width: 50px;height: auto;border-radius: 50%">
                                                <a class="dropdown-item" href="{{route('advertiser.profile')}}">
                                                    لديك رسالة جديدة
                                                    <br>
                                                    {{$notification['data']['data']}}
                                                </a>
                                            </div>
                                            <hr>

                                        @elseif($notification['type'] == "App\Notifications\NewPointsNotification")
                                            <div class="m-2" style="display: flex;
    text-align: right;">


                                                <img src="{{$notification['data']['id']['photo']}}" alt=""
                                                     style="width: 50px;height: auto;border-radius: 50%">
                                                <a class="dropdown-item" href="{{route('advertiser.points')}}">
                                                    {{$notification['data']['title']}}
                                                    <br>
                                                </a>
                                            </div>
                                            <hr>
                                        @endif
                                    @endforeach


                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="d-flex user-drop-header">
                    <ul class="navbar-nav" id="profile-nav">
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle user-profile"
                                href="#"
                                id="navbarDropdown"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                <div class="d-flex justify-content-center position-relative">
                                    <img width="57.387" class="rounded-circle" height="57.387"
                                         src="{{ advertiser()->photo}}" alt="user photo"/>

                                </div>
                                <div>
                                    <div class="d-flex justify-content-center position-relative user-drop-text"
                                         style="position: absolute;">
                                        {{--                                                style="width: 50px"--}}
                                        <span id="welcome-txt d-block">أهلًا {{advertiser()->name}}</span>
                                        <i
                                            class="fa fa-chevron-down d-block align-self-center"
                                            aria-hidden="true"
                                        ></i>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <span
                                            id="type-member">{{  advertiser()-> advertiserMembership -> title }}</span>
                                    </div>
                                </div>
                            </a>
                            <div
                                class="menu dropdown-menu profile-menu"
                                aria-labelledby="navbarDropdown"
                            >
                                <div class="notification-details">
                                    <button type="button" class="btn btn-primary mr-auto shadow-sm" id="btn-nav">
                                        عدد النقاط:{{advertiserPoints(advertiser()->id)}}
                                    </button>
                                    <a class="dropdown-item" href="{{route('advertiser.profile')}}">الصفحة الشخصية </a>
                                    <a class="dropdown-item" href="{{route('advertiser.update-account')}}">اعدادات
                                        الحساب</a>
                                    <a class="dropdown-item" href="{{route('advertiser.points')}}">كشف النقاط</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        تسجيل الخروج
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @else
            <ul class="navbar-nav text-center link-nav flex-row log-in-list">
                <li class="nav-item mx-lg-2 border-0">
                    <a class="nav-link px-0" href="{{route('advertiser.register')}}"
                    >تسجيل<span class="sr-only">(current)</span></a
                    >
                </li>
                <li class="nav-item mx-lg-2 border-0 pr-0">
                    <a class="nav-link px-0" href="{{route('advertiser.login')}}"
                    >تسجيل الدخول<span class="sr-only">(current)</span></a
                    >
                </li>
            </ul>
        @endif
    </div>
</nav>


@if(advertiser())
    @if(advertiser() ->email == null)
        <div style="height: 34px;background: #fecb2f;">
            <div class="container">
                <div class="col row text-center justify-content-center">
                    <p class="text-center" style="color: #fff; margin-top: 4px;">
                        <a href="{{route('advertiser.update-account')}}"> بيانات الحساب غير مكتملة ، الرجاء اكمال
                            البيانات
                        </a>
                    </p>
                </div>
            </div>
        </div>
    @endif
    @if(advertiser() ->email != null AND advertiser() ->is_active == 0)
        <div style="height: 34px;background: #fecb2f;">
            <div class="container">
                <div class="col row text-center justify-content-center">
                    <p class="text-center" style="color: #fff; margin-top: 4px;">
                        قم بتوثيق الحساب
                        <a href="{{route('advertiser.fastActive',['id' => advertiser()->id])}}">انقر هنا </a>
                        , لطلب رمز تفعيل
                    </p>
                </div>
            </div>
        </div>
    @endif
@endif

<style>
    @media (min-width: 1200px) and (max-width: 1400px) {
        .top-navbar-container {
            font-size: 13px !important;
            padding: 0;
            margin: 0;
        }
        nav {
            padding: 0;
            margin: 0;
        }
        .link-nav {
            font-size: 1.3em;
        }
        .navbar-expand-xl .navbar-nav .nav-link {
            padding-right: 0;
            padding-left: 0;
        }
        .navbar-expand-xl>.container-fluid {
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap;
            font-size: 13px !important;
        }


    }
    @media (min-width: 1401px)  {
        .top-navbar-container {
            font-size: 17px !important;
            padding: 0;
            margin: 0;
        }
        nav {
            padding: 0;
            margin: 0;
        }
        .link-nav {
            font-size: 1.3em;
        }
        .navbar-expand-xl .navbar-nav .nav-link {
            padding-right: 0;
            padding-left: 0;
        }
        .navbar-expand-xl>.container-fluid {
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap;
            font-size: 17px !important;
        }


    }
</style>
