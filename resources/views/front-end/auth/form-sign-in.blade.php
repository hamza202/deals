@extends('front-end.layouts.auth')
@section('title' , ' تسجيل الدخول')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/form-sign-in.css')}}" />
    <meta name="google-signin-client_id" content="448613701364-ehqsbsm698a99voj79u7dhe3tj7gjb36.apps.googleusercontent.com.apps.googleusercontent.com">

@endpush

@section('content')

    <section class="container-fluid">
        @include('front-end.layouts.includes.alerts.errors')
        @include('front-end.layouts.includes.alerts.success')

        <form  action="{{route('advertiser2.login')}}" method="POST" class="w-100" >
            @csrf
        <div class="row full-page">


            <div class="col-md-6 order-2 order-sm-1 right-section d-flex">
                <div class="log-in-head p-3 text-center d-block d-md-none">
                    <img class="img-fluid" src="{{ asset('front-end/images/sign-up.png')}}" />
                    <h3 class="mt-3 mb-0">تسجيل الدخول</h3>
                </div>
                 <div class="data-input w-100">

                    <input type="hidden" name="fcm_token" id="fcm_token" >
                    <div class="input w-100 px-3">
                        <label class="px-2 pt-2">البريد الإلكتروني / رقم الهاتف </label>
                        <input
                            type="text"
                            class="form-control input py-4 px-2"
                            id="activation-type"
                            placeholder="moh.ah@gmail.com or Phone"
                            name="username"
                        />
                    </div>
                    <div class="input w-100 my-4 px-3">
                        <label class="px-2 pt-2">كلمة المرور</label>
                        <input
                            type="password"
                            class="form-control input py-4 px-2"
                            id="activation-type"
                            placeholder="*******"
                            name="password"
                        />
                    </div>
                    <div class="remmember-pass-forget">
                        <div class="remmember-me">
                            <input
                                type="checkbox"
                                id="remmeber-me"
                                name="remmember-me"
                                value="remmember-me"
                            />
                            <label for="remmember-me" class="remmember-me-text px-2">تذكرني دائما</label>
                        </div>
                        <a href="{{route('advertiser.sendPassword')}}">
                            <p class="forgit-pass">نسيت كلمة المرور</p>
                        </a>
                    </div>
                    <a href="{{ url('/redirect') }}" class="btn btn-danger w-75 pb-3 pt-0 py-2"><i class="fab fa-google-plus-g px-2" style="color: #fff;align-items: flex-end;margin:auto"></i>التسجيل عن طريق جوجل</a>
                    </div>
                <div class="submit-buttons mt-4">
                    <button type="submit" class="btn btn-secondary login w-25 mx-2 py-3">دخول</button>
                    <button type="button"  onclick="window.location.href='{{route('advertiser.register')}}'" class="btn btn-secondary sign-up-button w-25 mx-2 py-3">انشاء حساب</button>
                </div>

            </div>


            <div class="d-md-flex justify-content-center d-none col-md-6 order-1 order-sm-2 left-section text-center">
                <a href="{{route('index')}}">   <img class="back" src="{{ asset('front-end/images/back.png')}}" /> </a>
                <img class="img-fluid" src="{{ asset('front-end/images/sign-up.png')}}" />

                <h2 class="did-you-forget-password">تسجيل الدخول</h2>
            </div>
        </div>

        </form>
    </section>

    @push('js')
        <script src="https://apis.google.com/js/platform.js" async defer></script>

    @endpush
@endsection
