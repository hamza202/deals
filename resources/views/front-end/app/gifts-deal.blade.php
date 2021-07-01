@extends('front-end.layouts.app')
@section('title' , 'هدايا  آمر تدلل')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/gifts-deal.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
@endpush
@section('content')
    <section class="container mt-5 px-5">
        <div class="row">
            <form class="w-100 mx-auto mb-4 mb-md-0" method="POST" action="{{route('index.first_search')}}">
                @csrf
                <div
                    class="d-flex d-flex pl-4 rounded-pill search-container py-1 pr-2">
                    <input
                        name="filter"
                        class="input-search form-control rounded-pill border-0"
                        type="search"
                        placeholder="ابحث عن ما تشاء، مثلا:(عقارات، ايجارات)"
                        aria-label="Search"
                    />
                    <button class="my-auto" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        @include('front-end.layouts.includes.alerts.errors')
        @include('front-end.layouts.includes.alerts.success')

        <div class="row my-5">
            <h1 class="head-text">هدايا آمر تدلل </h1>
        </div>
        <div class="row">
            @isset($gifts)
                @foreach($gifts as $available)
                    <div class="col-12 col-xl-3 col-lg-4 col-md-6">
                        <div class="card ml-2 mb-4">
                            <div class="align-items-start d-flex head-card justify-content-center">
                                <img
                                    style="
    height: 170px;
    width: 240px;
"
                                    class="img-fluid"
                                    src="{{ $available -> photo}}"
                                    alt="هدية"
                                />
                            </div>
                            <div class="body-card">
                                <h1 class="text-center">{{$available ->name}}</h1>
                                <div class="d-flex justify-content-between px-3">
                                    <p>فئه العميل:</p>

                                    <p>{{ $available -> memberShip -> title}}</p>
                                </div>
                                <div class="d-flex justify-content-between px-3">
                                    <p>عدد النقاط اللازمة للهدية:</p>
                                    <p>{{ $available -> points}}</p>
                                </div>
                            </div>


                        </div>
                    </div>
                @endforeach
            @endisset
            @isset($gifts_available)
                @foreach($gifts_available as $available)
                    <div class="col-12 col-xl-3 col-lg-4 col-md-6">
                        <div class="card ml-2 mb-4">
                            <div class="align-items-start d-flex head-card justify-content-center">
                                <img
                                    style="
    height: 170px;
    width: 240px;
"
                                    class="img-fluid"
                                    src="{{ $available -> photo}}"
                                    alt="كاميرا"
                                />
                            </div>
                            <div class="body-card">
                                <h1 class="text-center">{{$available ->name}}</h1>
                                <div class="d-flex justify-content-between px-3">
                                    <p>فئه العميل:</p>
                                    <p>{{ $available -> memberShip -> title}}</p>
                                </div>
                                <div class="d-flex justify-content-between px-3">
                                    <p>عدد النقاط اللازمة للهدية:</p>
                                    <p>{{ $available -> points}}</p>
                                </div>
                            </div>
                            @if(advertiser()->advertiserMembership->id != $available ->membership_id)
                                <div class="footer-card">
                                    <button
                                        type="button"
                                        class="btn btn-secondary btn py-2 w-100"
                                        data-toggle="modal"
                                        data-target="#exampleModal"
                                        disabled
                                    >
                                        الفئة غير متوافقة
                                    </button>
                                </div>
                            @elseif($available -> points <= advertiserPoints(advertiser()->id))
                                <div class="footer-card">


                                    @if(advertiser() ->email == null OR advertiser() ->is_active == 0)
                                        <button
                                            type="button"
                                            class="add-gift btn btn-primary btn py-2 w-100"
                                        >
                                            اطلب هديتك
                                        </button>
                                    @else
                                        <button
                                            type="button"
                                            class="add-gift btn btn-primary btn py-2 w-100"
                                            data-toggle="modal"
                                            data-target="#exampleModal"
                                            data-id="{{ $available -> id}}"
                                        >
                                            اطلب هديتك
                                        </button>
                                @endif
                                <!-- Modal -->
                                    <div
                                        class="modal fade"
                                        id="exampleModal"
                                        tabindex="-1"
                                        role="dialog"
                                        aria-labelledby="exampleModalLabel"
                                        aria-hidden="true"
                                    >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title mx-auto" id="staticBackdropLabel">
                                                        بيانات مقدم الطلب
                                                    </h5>
                                                </div>
                                                <form class="text-right" action="{{route('gifts-deal.store')}}"
                                                      method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="" id="id">
                                                        <div
                                                            class="align-items-center d-flex justify-content-center mb-2 row-modal-form">
                                                            <div class="d-flex justify-content-between width-row-modal">
                                                                <p>الاسم:</p>
                                                                <p>{{advertiser()->username}}</p>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="align-items-center d-flex justify-content-center mb-2 row-modal-form input-row ">
                                                            <div
                                                                class="d-flex justify-content-between align-items-end width-row-modal">
                                                                <label for="full-name" class="w-50">الاسم كامل:</label>
                                                                <input required placeholder="من فضلك أدخل اسمك كاملاً"
                                                                       class="form-control input shadow-sm" type="text"
                                                                       id="full-name" name="name">
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="align-items-center d-flex justify-content-center mb-2 row-modal-form input-row">
                                                            <div
                                                                class="d-flex justify-content-between align-items-end width-row-modal">
                                                                <label for="full-name" class="w-50">العنوان:</label>
                                                                <input required placeholder="وين تبي توصل هديتك"
                                                                       class="form-control input shadow-sm" type="text"
                                                                       id="full-name" name="address">
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="align-items-center d-flex justify-content-center mb-2 row-modal-form">
                                                            <div class="d-flex justify-content-between width-row-modal">
                                                                <p>الجوال:</p>
                                                                <div>
                                                                    <p>{{advertiser()->phone}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="align-items-center d-flex justify-content-center mb-2 row-modal-form">
                                                            <div class="d-flex justify-content-between width-row-modal">
                                                                <p>الإيميل:</p>
                                                                <p>{{advertiser()->email}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-top-0">
                                                        <button
                                                            type="submit"
                                                            class="btn btn-secondary mx-auto w-50 btn-gift"
                                                        >
                                                            تأكيد طلب الهدية والإرسال
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($available -> points >= advertiserPoints(advertiser()->id))
                                <div class="footer-card">
                                    <button
                                        type="button"
                                        class="btn btn-secondary btn py-2 w-100"
                                        data-toggle="modal"
                                        data-target="#exampleModal"
                                        disabled
                                    >
                                        نقاطك غير كافية
                                    </button>

                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endisset
            @isset($gifts_not_available)
                @foreach($gifts_not_available as $not_available)
                    <div class="col-12 col-xl-3 col-lg-4 col-md-6">
                        <div class="card ml-2 mb-4">
                            <div class="align-items-start d-flex head-card justify-content-center">
                                <img
                                    style="
    height: 170px;
    width: 240px;
"
                                    class="img-fluid"
                                    src="{{ $available -> photo}}"
                                    alt="هدية"
                                />
                            </div>
                            <div class="body-card">
                                <h1 class="text-center">{{$available ->name}}</h1>
                                <div class="d-flex justify-content-between px-3">
                                    <p>فئه العميل:</p>
                                    <p>{{ $available -> memberShip -> title}}</p>
                                </div>
                                <div class="d-flex justify-content-between px-3">
                                    <p>عدد النقاط اللازمة للهدية:</p>
                                    <p>{{ $available -> points}}</p>
                                </div>
                            </div>
                            <div class="footer-card">
                                <button
                                    type="button"
                                    class="btn btn-secondary btn py-2 w-100"
                                    data-toggle="modal"
                                    data-target="#exampleModal"
                                    disabled
                                >
                                    غير متوفر
                                </button>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </section>
    @push('js')
        <script>
            $(document).on("click", ".add-gift", function () {
                var id = $(this).data('id');
                $(".modal-content #id").val(id);
            });
        </script>
    @endpush
@endsection
