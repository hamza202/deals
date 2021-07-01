@extends('front-end.layouts.auth')
@section('title' , ' تفعيل الحساب')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/form-activation.css')}}"/>
    <style>
        .new-codes {
            display: none;
        }
    </style>
@endpush

@section('content')

    @include('front-end.layouts.includes.alerts.errors')
    @include('front-end.layouts.includes.alerts.success')
    <section class="container-fluid">
        <div class="row full-page">
            <div class="col-12 col-sm-6 order-2 order-sm-1 right-section">
                <h2 class="title">عميلنا الغالي</h2>
                <div class="data-input w-100">
                    <h4>رجاء إدخال رمز التفعيل المرسل إليكم</h4>


                    <div> تنتهي صلاحية الرمز خلال <span style="font-size: 25px" id="time">10:00</span> دقيقة</div>


                    <!-- <button type="button">10</button> -->
                    {{--                    <input disabled type="text" placeholder="10" class="form-control disabled-input py-4" aria-describedby="emailHelp"/>--}}

                    <form id="new-code" class="data-input w-100" action="{{route('advertiser.updateActiveAccount')}}"
                          method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$id}}">

                        <input type="text" name="code" class="form-control input w-75 py-4" id="activation number"
                               aria-describedby="emailHelp" placeholder="قم بإدخال رقم التفعيل">
                        <button style="margin: 20px;" class="activation-button w-50 py-3" type="submit">تفعيل</button>
                    </form>

                    <button style="margin: 10px;" onclick="location.href = '{{route('advertiser.sendActiveCode',$id)}}'"
                            class="activation-button w-50 py-3">طلب رمز تفعيل جديد
                    </button>
                </div>
            </div>


            <div class="col-12 col-sm-6 order-1 order-sm-2 left-section">
                <a href="{{route('index')}}"> <img class="back" src="{{ asset('front-end/images/back.png')}}"/></a>
                <img class="img-fluid" src="{{ asset('front-end/images/sign-up.png')}}">
                <h2 class="did-you-forget-password">هل نسيت كلمة المرور</h2>
            </div>
        </div>
    </section>

    @push('js')
        <script>
            function startTimer(duration, display) {
                var timer = duration, minutes, seconds;
                setInterval(function () {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    display.textContent = minutes + ":" + seconds;

                    if (--timer < 0) {
                        timer = 0;
                        document.getElementById('new-code').classList.add('new-codes');
                    }
                }, 1000);
            }

            window.onload = function () {
                var fiveMinutes = 60 * 10,
                    display = document.querySelector('#time');
                startTimer(fiveMinutes, display);
            };
        </script>
    @endpush

@endsection
