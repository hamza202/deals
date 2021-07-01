@extends('front-end.layouts.auth')
@section('title' , ' انشئ حساب')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/form-sign-up.css')}}"/>
    <style>
        .custom-control-label::after,
        .custom-control-input::before,
        select:required:invalid {
            color: gray;
        }

        option[value=""][disabled] {
            display: none;
        }

        option {
            color: black;
        }

        .selectColor {
            background-color: #fbfbfb;
        }

        .text {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endpush

@section('content')
    <section class="container-fluid">
        <div class="row full-page">
            <div class="col-12 col-sm-6 order-2 order-sm-1 right-section align-self-center">
                @include('front-end.layouts.includes.alerts.errors')
                @include('front-end.layouts.includes.alerts.success')

                <form class="my-4" action="{{route('advertiser.register.store')}}" method="POST">
                    @csrf
                    <div class="data-input">
                        <div class="row w-100">
                            <div class="form-group col-lg-6 mt-3">
                                <label>اسم المستخدم</label>
                                <input
                                    type="text"
                                    class="form-control input mx-2 py-4 px-2"
                                    id="user-name"
                                    placeholder="Add User Name"
                                    name="username"
                                    value="{{ old('username') }}"
                                />
                                @error('username')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 mt-3">
                                <label>الاسم</label>
                                <input
                                    type="text"
                                    class="form-control input mx-2 py-4 px-2"
                                    id="user-name"
                                    placeholder="ادخل الاسم "
                                    name="name"
                                    value="{{ old('name') }}"
                                />
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="email-input-container w-100">
                            <label>البريد الإلكتروني</label>
                            <input
                                type="text"
                                class="form-control input w-100 py-4 px-2"
                                id="user-name"
                                placeholder="ادخل البريد الالكترونى"
                                name="email"
                                value="{{ old('email') }}"
                            />
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- select 2js -->
                        <div class="d-flex justify-content-between w-100 mt-3">
                            <label class="align-self-start px-3 ">الجوال</label>
                            <label class="align-self-start px-3 ">المفتاح</label>
                            <label class="align-self-start px-3 w-25">المدينة</label>
                        </div>
                        <div class="d-flex justify-content-around w-100">
                            <input type="text"
                                   id="mobile"
                                   class="form-control input w-90 py-4 px-2"
                                   name="phone"
                                   style="width: 31%;"
                                   value="{{ old('phone') }}"
                            />
                            @error('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <select
                                required
                                id="first-num"
                                class="form-control selectColor h-25 px-2"
                                name="country_code"
                                style="width: 31%;"
                            >     @error('country_code')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <option value="" disabled selected hidden>اختر</option>
                                {{--                                <option value="00972">972+</option>--}}
                                {{--                                <option value="00970">970+</option>--}}
                                <option value="00966" selected>966+</option>
                            </select>

                            <select
                                required
                                id="city"
                                class="form-control selectColor h-25 px-2"
                                name="city_id"
                                style="width: 31%;"
                            >
                                @error('city_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <option value="" disabled selected hidden>اختر</option>
                                @isset($cities)
                                    @foreach($cities as $city)
                                        <option value="{{$city -> id}}">{{$city -> name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <!-- select 2js -->
                        <div class="how-did-know-us w-100 mt-3">
                            <label>كيف عرفت ديل</label>
                            @error('know_us')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <select name="know_us" id="know_us" class="form-control selectColor h-25 w-100" required>
                                @php
                                    $know_us = App\Models\KnowUs::all();
                                @endphp
                                <option value="" disabled selected hidden>اختر</option>
                                @foreach($know_us as $know)
                                    <option value="{{$know -> id}}">{{$know -> name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-row mt-3">
                            <div class="form-group col-lg-6">
                                <label for="password">كلمة المرور</label>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control input py-4 px-2"
                                    id="password"
                                    placeholder="*****"
                                />
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="password_confirmation">تاكيد كلمة المرور</label>
                                <input
                                    type="password"
                                    class="form-control input py-4 px-2"
                                    id="password_confirmation"
                                    placeholder="*****"
                                    name="password_confirmation"
                                />
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                            <div class="w-100">
                                <h6 class="mx-3">التفعيل عن طريق</h6>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="email"
                                           name="activeAccount"
                                           value="1"
                                           style="margin-left: 10px">
                                    <label class="form-check-label" for="email">البريد الالكتروني</label>

                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="phone"
                                           name="activeAccount"
                                           value="2"
                                           style="margin-left: 10px">
                                    <label class="form-check-label" for="phone"> الجوال</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="WP"
                                           name="activeAccount"
                                           style="margin-left: 10px"
                                           value="3">
                                    <label class="form-check-label" for="WP"> الواتساب</label>
                                </div>
                                @error('active')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>

                            <div class="radios mx-3 w-100">
                                <div>
                                    <div class="row checkbox">
                                        <input
                                            class="mx-2"
                                            type="checkbox"
                                            id="agree"
                                            name="agreement-terms"
                                            value="terms"
                                            required
                                        />
                                        <label class="checkbox-text" for="agree">
                                            اوفق على
                                            <a href="{{route('terms-and-conditions')}}">
                                           <span class="terms-text mx-1">
                                               الشروط والاحكام
                                           </span>
                                            </a>
                                        </label
                                        ><br/>
                                        @error('agreement-terms')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="row checkbox">
                                        <input
                                            class="mx-2"
                                            type="checkbox"
                                            id="agree-messeges"
                                            name="messeges"
                                            value="msg"
                                        />
                                        <label class="checkbox-text2" for="agree-messeges"
                                        ><small>اوافق على ارسال الرسائل الترويجية</small></label
                                        ><br/>
                                        @error('messeges')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="g-recaptcha"
                                     style="margin:auto"
                                     data-sitekey="6Lf_3yUaAAAAAEyUI9izolJm76J3_ABGCbhh_G2O">
                                </div>
                                @error('g-recaptcha-response')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <button class="activation-button py-3 w-50 align-self-center"
                                        style="margin: 2%">
                                    إنشاء

                                </button>

                                <a type="button" href="{{route('advertiser.register.fast')}}"
                                   class="activation-button py-3 w-50 align-self-center text"
                                   style="text-align:center !important;"
                                >
                                    <span style="margin:auto ;">  التسجيل السريع   </span>

                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 col-sm-6 order-1 order-sm-2 left-section justify-content-center">
                <a href="{{route('index')}}"> <img class="back" src="{{ asset('front-end/images/back.png')}}"/></a>
                <img class="img-fluid" src="{{ asset('front-end/images/sign-up.png')}}"/>
                <h2 class="did-you-forget-password">انشاء حساب جديد</h2>

            </div>


        </div>
    </section>



    @push('js')
        <script src='https://www.google.com/recaptcha/api.js'></script>

        <script>
            const regex = /[A-Z a-z]/;

            function validate(e) {
                const chars = e.target.value.split('');
                const char = chars.pop();
                if (!regex.test(char)) {
                    e.target.value = chars.join('');
                    console.log(`${char} is not a valid character.`);
                }
            }

            document.querySelector('#user-name').addEventListener('input', validate);

            $(document).ready(function () {
                $(".select2").select2();

                $('b[role="presentation"]').hide();

                $(".select2-selection__arrow").append(
                    '<i class="fa fa-angle-down"></i>'
                );
            })
        </script>

    @endpush
@endsection
