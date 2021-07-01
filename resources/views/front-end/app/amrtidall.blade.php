@extends('front-end.layouts.app')
@section('title' , ' آمر تدلل')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/amrtidall.css')}}"/>
@endpush

@section('content')
    <section class="container">
        <h2 class="text-head">برنامج الولاء امر تدلل</h2>
        <img
            class="img-fluid"
            src="{{ asset('front-end/images/amrtidall.svg')}}"
            alt="أمرك تدلل"
        />
        @isset($amrtidall)
            @foreach($amrtidall as $amr_tidall)
                <p class="text-center mt-4 mb-3">
                    {{$amr_tidall-> content}}
                    @endforeach
                    @endisset
                </p>
                <div class="row">
                    <div class="col-6 col-xl-3 col-lg-3 col-md-3">
                        <div class="card my-3 p-2">
                            <p class="my-auto text-center">نظرة عامه</p>
                        </div>
                    </div>
                    <div class="col-6 col-xl-3 col-lg-3 col-md-3">
                        <div class="card my-3 p-2">
                            <p class="my-auto text-center">الانظمام في البرنامج</p>
                        </div>
                    </div>
                    <div class="col-6 col-xl-3 col-lg-3 col-md-3">
                        <div class="card my-3 p-2">
                            <p class="my-auto text-center">النقاط المفقودة</p>
                        </div>
                    </div>
                    <div class="col-6 col-xl-3 col-lg-3 col-md-3">
                        <div class="card my-3 p-2">
                            <p class="my-auto text-center">النقاط المفقودة
                                واستبدال النقاط</p>
                        </div>
                    </div>
                </div>
                <h2 class="text-head text-body">كيفية اكتساب نقاط من ديل</h2>
                <div class="row mb-5">
                    @isset($points)
                        @foreach($points as $point)
                            <div class="col-12 col-xl-6 col-lg-6 col-md-6">
                                <div class="card p-3 rounded-0 mb-3">
                                    <div class="d-flex text-right">
                                        <div class="point my-auto">
                                            <span class="text-center number-span">{{$point -> id}}</span>
                                        </div>
                                        <div class="body-point mr-3">
                                            <h6 class="getting-points-text">{{$point -> activity}}</h6>
                                            <p class="font-weight-bold" style="margin-right: 2%">  {{$point -> num_points}}
                                                نقطة </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @endisset

                </div>
    </section>

@endsection
