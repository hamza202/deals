@extends('front-end.layouts.app')
@section('title' , ' تواصل معنا  ')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/call-us.css')}}" />
@endpush

@section('content')
    <section class="container site-page px-5 text-right">
        <p class="call-us-title text-center text-xl-right text-lg-right">تواصل معنا</p>
        <div class="row d-flex">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="contacts">
                    <div class="contact">
                        <i class="fas fa-phone icon"></i>
                        @php
                          $row =  App\Models\Social::where('id',6)->first();
                        @endphp
                        <p class="contact-type my-3 mx-2">الهاتف: {{ $row -> link}}</p>
                    </div>
                    <div class="contact">
                        <i class="fas fa-envelope icon"></i>
                        @php
                            $row =  App\Models\Social::where('id',5)->first();
                        @endphp
                        <p class="contact-type my-3 mx-2">الهاتف: {{ $row -> link}}</p>
                    </div>
                    <div class="contact">
                        <i class="fab fa-whatsapp-square icon whatsapp"></i>
                        @php
                            $row =  App\Models\Social::where('id',7)->first();
                        @endphp
                        <p class="contact-type my-3 mx-2">الهاتف: {{ $row -> link}}</p> </div>
                </div>

                @include('front-end.layouts.includes.alerts.errors')
                @include('front-end.layouts.includes.alerts.success')
                <form class="mt-3" action="{{route('call_us.store')}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="name">الاسم</label>
                            <input
                                type="text"
                                class="form-control input"
                                id="name"
                                name="name"
                            />
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="title">العنوان</label>
                            <input
                                type="text"
                                class="form-control input"
                                id="title"
                                name="address"
                            />
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="email">البريد الإلكتروني</label>
                            <input
                                type="email"
                                class="form-control input"
                                id="email"
                                name="email"
                            />
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="phone">الهاتف</label>
                            <input
                                type="tel"
                                class="form-control input"
                                id="phone"
                                name="phone"
                            />
                            @error('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="whatsapp">الواتساب</label>
                            <input type="tel" class="form-control input" id="whatsapp" name="whatsapp" />
                            @error('whatsapp')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="titleMsg">عنوان الرسالة</label>
                            <input
                                type="text"
                                class="form-control input"
                                id="titleMsg"
                                name="title"
                            />
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="bodyMsg">اضف رسالة</label>
                            <textarea name="message" class="text-area py-5" id="bodyMsg"></textarea>
                            @error('message')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <button id="sub-btn" type="submit " class="btn btn-primary mx-auto rounded-pill w-50">ارسال</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 d-flex">
                <img class="img-fluid" src="{{ asset('front-end/images/call-us-img.svg')}}" />
            </div>
        </div>
    </section>


@endsection
