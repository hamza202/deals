@extends('front-end.layouts.auth')
@section('title' , ' تفعيل الحساب')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/form-send-activation.css')}}" />
@endpush

@section('content')
    <section class="container-fluid">
        <div class="row full-page">
            <div class="col-12 col-sm-6 order-2 order-sm-1 right-section">
                <h2 class="title my-5">عميلنا الغالي</h2>
                <div class="data-input">
                    <h4 class="my-5">
                         سيتم ارسال رمز التفعيل الى المعرف الخاص بك المسجل لدينا<small
                        >(بريدك الالكتروني او الجوال او الواتساب)</small
                        >
                    </h4>
                    <form class="w-100 my-5 " style="align-content: center" action="{{route('advertiser.active_code.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$id}}">
                    <div class="radio-inputs w-100 my-5 row" style="align-content: center">
                        <p>التفعيل عن طريق</p>
                        <div class="radios-buttons row">
                            <!-- Default unchecked -->
                            <div class="custom-control  custom-radio mx-2">
                                <input
                                    type="radio"
                                    class="custom-control-input"
                                    id="email"
                                    name="activeAccount"
                                    value="1"
                                />
                                <label class="custom-control-label" for="email"
                                >البريد الإلكتروني</label
                                >
                            </div>

                            <div class="custom-control custom-radio mx-2">
                                <input
                                    type="radio"
                                    class="custom-control-input"
                                    id="phone"
                                    name="activeAccount"
                                    value="2"
                                />
                                <label class="custom-control-label" for="phone"
                                > الجوال </label
                                >
                            </div>
                            <!-- Default unchecked -->
                            <div class="custom-control custom-radio mx-2">
                                <input
                                    type="radio"
                                    class="custom-control-input"
                                    id="WP"
                                    name="activeAccount"
                                    value="3"
                                />
                                <label class="custom-control-label" for="WP"
                                >الواتساب</label
                                >
                            </div>
                        </div>
                    </div>
                    <div class="radio-inputs w-100 my-5 row" style="align-content: center">
                        <button class="activation-button px-3 py-3" type="submit" style="align-content: center">
                            طلب رمز تفعيل
                        </button>
                    </div>

                    </form>
                </div>
            </div>
            <div class="col-12 col-sm-6 order-1 order-sm-2 left-section">
                <a href="{{route('index')}}">   <img class="back" src="{{ asset('front-end/images/back.png')}}" /></a>
                <img class="sign-up" src="{{ asset('front-end/images/sign-up.png')}}" />
                <h2 class="did-you-forget-password"><a href="{{route('advertiser.sendPassword')}}">هل نسيت كلمة المرور</a></h2>
            </div>
        </div>
    </section>

@endsection
