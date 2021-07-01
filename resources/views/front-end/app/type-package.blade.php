@extends('front-end.layouts.app')
@section('title' , ' الباقات')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/type-package.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

@endpush

@section('content')
    <section class="container text-right px-5">

        @include('front-end.layouts.includes.alerts.errors')
        @include('front-end.layouts.includes.alerts.success')

        <h2 class="text-head">اشتراك الباقة</h2>

        @isset($rows)
            @foreach($rows as $row)
                <div class="row card shadow">
                    <h1 class="head-package mt-3 text-center">
                        {{$row -> name}}

                    </h1>
                    <div class="row">
                        <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
                            <h1>
                                مميزات الباقة
                            </h1>
                            <ol>
                                <li>عدد الاعلانات المثبتة : {{$row -> plan -> advertising}} اعلان</li>
                                <li>ترقية العضوية :{{$row -> plan ->membership}} درجة</li>
                            </ol>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                            <h1>
                                صلاحيات الباقة
                            </h1>
                            <p>{{$row -> time_line}} أيام</p>
                            <h1>
                                سعر الباقة
                            </h1>
                            @if($row -> price == 0)
                                <p>
                                    <button type="button" class="btn btn-outline-warning"
                                            onclick="window.location.href='{{route('advertiser.request.subscription.store',$row -> id)}}'"
                                    >طلب عرض سعر
                                    </button>
                                </p>
                            @else
                                <p> {{$row -> price}} ريال </p>
                            @endif
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                    <button
                        id="btn-nav"
                        type="button"
                        class="btn btn-primary btn btn-primary mx-auto rounded-pill w-50 mb-4"
                        onclick="window.location.href='{{route('advertiser.subscription.store',$row -> id)}}'"


                    >
                        اشتراك
                    </button>

                    <!-- Modal -->
                    <div
                        class="modal fade"
                        id="exampleModalCenter"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalCenterTitle"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5
                                        class="modal-title mx-auto head-modal"
                                        id="exampleModalCenterTitle"
                                    >
                                        تم إرسال الطلب
                                    </h5>
                                </div>
                                <div class="modal-body">
                                    <p class="text-modal">سيتم التواصل معك من خلال فريق ديل</p>
                                </div>
                                <div class="modal-footer">
                                    <button
                                        id="btn-nav"
                                        type="button"
                                        class="btn btn-primary btn btn-primary mx-auto rounded-pill w-50"
                                    >
                                        تم
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($row -> discount != 0)
                        <div class="discount-label">
                            خصم <strong>{{$row -> discount}}%</strong>
                        </div>
                    @endif
                </div>

            @endforeach
        @endisset
    </section>

@endsection
