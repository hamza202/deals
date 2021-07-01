@extends('front-end.layouts.auth')
@section('title' , ' انشئ حساب')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/form-sign-up.css')}}"/>
@endpush

@section('content')
    <section class="container-fluid">
        <form action="{{route('advertiser.register.store1')}}" method="POST" class="w-100">
            @csrf

            <div class="row full-page">
                <div class="col-12  col-sm-6 order-2 order-sm-1 right-section">

                    @include('front-end.layouts.includes.alerts.errors')
                    @include('front-end.layouts.includes.alerts.success')

                    <div class="form-row w-100">
                        <div class="input w-100">
                            <label>اسم المستخدم</label>
                            <input
                                type="text"
                                class="form-control input mx-2 py-4 px-0"
                                id="user-name"
                                placeholder="Add User Name"
                                name="username"
                                value="{{ old('username') }}"
                            />
                            @error('username')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <br>

                        <div class="input w-50 my-4">

                            <label>الجوال</label>
                            <input type="text"
                                   id="mobile"
                                   class="form-control input py-4 px-0"
                                   name="phone"
                                   placeholder="123456789"
                                   value="{{ old('phone') }}"
                            />
                            @error('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror

                        </div>
                        <div class="input w-50  my-4" style="border-right:5px solid #FFFFFF; ">
                            <label>المفتاح</label>
                            <select
                                id="first-num"
                                class="form-control w-50 select2"
                                name="country_code"

                            >
                                @error('country_code')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <option selected value="00966">966+</option>
                            </select>
                        </div>

                        <div class="input w-50  my-4" style="border-left:5px solid #FFFFFF; ">
                            <label>كلمة المرور</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control input py-4 px-0"
                                id="password"
                                placeholder="*****"
                            />
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror

                        </div>
                        <div class="input w-50  my-4" style="border-right:5px solid #FFFFFF; ">
                            <label>تاكيد كلمة المرور</label>
                            <input
                                type="password"
                                class="form-control input py-4 px-0"
                                id="password_confirmation"
                                placeholder="*****"
                                name="password_confirmation"
                            />
                            @error('password_confirmation')
                            <span class="text-danger">{{$message}}</span>
                            @enderror

                        </div>

                        <div class="g-recaptcha"
                             style="margin: auto"
                             data-sitekey="6Lf_3yUaAAAAAEyUI9izolJm76J3_ABGCbhh_G2O">
                        </div>
                        @error('g-recaptcha-response')
                        <span class="text-danger">{{$message}}</span>
                        @enderror

                        <div class=" w-75  my-4" style="margin-right: 28%">
                            <button class="activation-button py-3 w-50 align-self-center">
                                إنشاء
                            </button>
                        </div>

                    </div>

                </div>

                <div class="col-12 col-sm-6 order-1 order-sm-2 left-section">
                    <a href="{{route('index')}}"> <img class="back" src="{{ asset('front-end/images/back.png')}}"/></a>
                    <img class="sign-up" src="{{ asset('front-end/images/sign-up.png')}}"/>
                    <h2 class="did-you-forget-password">انشاء حساب جديد</h2>

                </div>


            </div>

        </form>
    </section>



    @push('js')

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


    @endpush
@endsection
