@extends('front-end.layouts.app')
@section('title' , ' اعرف حقك')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">

    <link rel="stylesheet" href="{{ asset('front-end/css/know-rights.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

@endpush

@section('content')

    @include('front-end.layouts.includes.alerts.errors')
    @include('front-end.layouts.includes.alerts.success')

    <section class="container-fluid site-page">
        <div class="row">

            <div class="head container">
                <h3 class="align-self-start">خدمة اعرف حقك من ديل</h3>
                <img class="img-fluid" src="{{ asset('front-end/images/know-rights-logo.png')}}"/>
            </div>
            <div class="container">
                <div class="row">
                    @isset($rights)
                        @foreach($rights as $right)
                            <div class="col-12 col-md-6 col-lg-4">
                                <a

                                    class="card shadow"
                                >
                                    <img class="image" src="{{ $right -> photo}}"
                                         style=" width: 350px; height: 170px;"/>

                                    <h4>{{$right -> title}}</h4>

                                    <h6>
                                        {{$right -> content}}
                                    </h6>
                                </a>
                            </div>
                        @endforeach
                    @endisset

                </div>
                <div class="row">
                    @isset($files)
                        @foreach($files as $file)
                            <div class="d-flex justify-content-center col-md-4"  style="margin-top: 1%;margin-bottom: 3%">
                                    <a
                                        type="button"
                                        class="btn btn-secondary w-100 py-3"
                                        style="background-color: #7B7B7B"
                                        href="{{$file->url}}"
                                    >
                       <span style="font-weight: bold;
                        color: #ffffff ;font-size: 20px"> {{$file->name}} </span>
                                    </a>
                            </div>
                        @endforeach
                    @endisset

                </div>

                @if(advertiser())

                    @if(advertiser() ->email == null OR advertiser() ->is_active == 0)
                        <div class="d-flex justify-content-center">
                            <a
                                type="button"
                                class="btn btn-primary  w-50 py-3"
                                style="background-color: #7B7B7B"
                            >
                       <span style="font-weight: bold;
                        color: #ffffff ;font-size: 20px">طلب استشارة </span>
                            </a>
                        </div>
                    @else
                        <div class="d-flex justify-content-center">
                            <a
                                type="button"
                                data-toggle="modal"
                                data-target="#cardModal"
                                class="btn btn-primary  w-50 py-3"
                                style="background-color: #7B7B7B"
                            >
                       <span style="font-weight: bold;
                        color: #ffffff ;font-size: 20px">طلب استشارة </span>
                            </a>
                        </div>
                    @endif

                @else
                    <div class="d-flex justify-content-center">
                        <a
                            href="{{route('advertiser.login')}}"
                            type="button"
                            class="btn btn-primary  w-50 py-3"
                            style="background-color: #7B7B7B"
                        >
                       <span style="font-weight: bold;
                        color: #ffffff ;font-size: 20px">طلب استشارة </span>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </section>
    <!-- Modal -->
    <div
        class="modal fade"
        id="cardModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="#cardModal"
        aria-hidden="true"
    >


        @if(advertiser())
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="border-bottom: none;">
                        <h5
                            class="modal-title"
                            style="width: 100%; text-align: center;"
                            id="exampleModalLongTitle"
                        >
                            بيانات مقدم الطلب
                        </h5>
                        <button
                            type="button"
                            style="position: absolute; left: 10px;"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('advertiser.consultations')}}" method="POST">
                            @csrf
                            <div class="d-flex">
                                <h5 class="w-25">الاسم:</h5>
                                <input readonly value="{{advertiser()->username}}" name="name" type="text"
                                       class="form-control w-75"/>
                            </div>
                            <br>
                            <div class="d-flex">
                                <h5 class="w-25">الجوال:</h5>
                                <input readonly value="{{advertiser()->phone}}" name="phone" type="text"
                                       class="form-control w-75"/>
                            </div>
                            <br>
                            <div class="d-flex">
                                <h5 class="w-25">البريد:</h5>
                                <input name="email" readonly value="{{advertiser()->email}}" type="email"
                                       class="form-control w-75"/>
                            </div>
                            <div class="d-flex flex-column align-items-center mt-5">
                        <textarea
                            placeholder="ادخل الطلب"
                            class="textarea w-100"
                            name="consultations"
                        ></textarea>
                                <button
                                    type="submit"
                                    class="btn btn-secondary confirm w-50 py-2 my-5"
                                >
                                    تأكيد الطلب
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
