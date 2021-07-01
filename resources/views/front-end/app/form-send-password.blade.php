@extends('front-end.layouts.auth')
@section('title' , ' ارسال كلمة المرور ')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/form-send-activation.css')}}" />
@endpush

@section('content')
    <section class="container-fluid">
        <div class="row full-page">
            <div class="col-12 col-sm-6 order-2 order-sm-1 right-section d-flex align-items-center">
                <div>
                    <h2 class="title my-lg-5 my-md-3 my-3">عميلنا الغالي</h2>
                    <div class="data-input my-lg-5 my-md-3 my-3">
                        <h4>
                            نأمل ادخالك المعرف الخاص بك المسجل لدينا لارسال كلمة المرور<small
                            >(بريدك الالكتروني او الجوال او الواتساب)</small
                            >
                        </h4>
                        <form class="w-100" action="{{route('advertiser.active_password.store')}}" method="POST">
                            @csrf

                            <div class="radio-inputs w-75 my-lg-5 my-md-3 my-3 row" style="align-content: center ;margin: auto">

                                <input
                                    style="width: 100%;"
                                    type="text"
                                    class="form-control input py-4"
                                    id="activation-type"
                                    name="name"
                                    placeholder="ادخل بريد الإلكتروني او رقم جوال المسجل لدينا او واتساب"
                                />
                                <p>الارسال عن طريق</p>
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
                            <div class="radio-inputs my-lg-5 my-md-3 my-3 w-75 mx-auto" style="align-content: center">
                                <button class="activation-button px-3 py-3" type="submit">
                                    طلب كلمة المرور
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 order-1 order-sm-2 left-section">
                <a href="{{route('index')}}">   <img class="back" src="{{ asset('front-end/images/back.png')}}" /></a>
                <img class="img-fluid" src="{{ asset('front-end/images/sign-up.png')}}" />
                <h2 class="did-you-forget-password">هل نسيت كلمة المرور</h2>
            </div>
        </div>
    </section>

@endsection
