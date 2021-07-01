@extends('front-end.layouts.app')
@section('title' , 'نتيجة البحث')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/clothes.css')}}" />
    <style>
        div.stars {
            width: 400px;
            display: inline-block;
        }

        input.star { display: none; }

        label.star {
            float: right;
            padding: 5px;
            font-size: 20px;
            color: #444;
            transition: all .2s;
        }

        input.star:checked ~ label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked ~ label.star:before {
            color: #FE7;
            text-shadow: 0 0 10px #952;
        }

        input.star-1:checked ~ label.star:before { color: #F62; }

        label.star:hover { transform: rotate(-15deg) scale(1.3); }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
        }
    </style>
@endpush


@php
if (isset($first_form))
$type_form = 0;
elseif(isset($second_form))
$type_form = 1;
else
 $type_form = 2;
@endphp
@section('content')
    <section class="container text-right">
        <!-- search form -->


    @include('front-end.layouts.includes.alerts.errors')
    @include('front-end.layouts.includes.alerts.success')


        <!-- cards -->
        @isset($third_form)
            @include('front-end.layouts.includes.search')
        @endisset

        <div class="row mt-3 mb-5">

            @isset($first_form)
            <form class="w-100 mx-auto mb-4 mb-md-0" method="POST" action="{{route('index.first_search')}}" >
                @csrf
                <br>
                <div
                    class="d-flex d-flex pl-4 rounded-pill search-container py-1 pr-2"
                >
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
            <br><br>
           @endisset

            @isset($second_form)
                    <header class="container mt-4">
                    <div class="row">
                    <div class="col-12 col-lg-9 mt-lg-auto mt-4">
                        <h5 class="txt-filter-search">بحث متقدم</h5>
                        <form class="w-100 mx-auto mb-4 mb-md-0" method="POST" action="{{route('index.second_search')}}">
                            @csrf
                            <div
                                class="d-flex flex-wrap align-items-center filter-search justify-content-between"
                            >

                                <div class="d-flex col-12 col-md-10 row mx-auto p-0">

                                    <div class="form-group pt-1 px-1 p-0 ml-0 col-12 col-md-4">
                                        <select
                                            id=" "
                                            class="form-control h-100 px-3 select2"
                                            name="city_id"
                                            style="width: 100%;"
                                        >
                                            @foreach($cities as $city)
                                                <option value="{{$city -> id}}">{{$city -> name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group pt-1 px-1 p-0 ml-0 col-12 col-md-4">
                                        <select
                                            id="country"
                                            class="form-control h-100 select2"
                                            name="category_id"

                                        >

                                            <option value="" selected disabled>اختر القسم الرئيسي</option>
                                            @foreach($main_category as $key => $country)
                                                <option value="{{$key}}"> {{$country}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group pt-1 px-1 p-0 ml-0 col-12 col-md-4">

                                        <select name=state id="state" class="form-control h-100 select2">
                                            <option value="" selected disabled>اختر القسم الفرعي</option>
                                        </select>

                                    </div>

                                    <!-- <div class="form-group pt-3">
                                    <select id="" class="form-control h-100 select2" name="">
                                      <option selected>اختر القسم الداخلى</option>
                                      <option>BMW</option>
                                      <option>Audi</option>
                                      <option>Maruti</option>
                                      <option>Tesla</option>
                                    </select>
                                  </div> -->

                                </div>

                                <div
                                    class="d-flex col-12 col-md-2 p-0 pt-2 pt-md-0 justify-content-center justify-content-md-end"
                                >
                                    <div class="form-group pt-1 mr-3">
                                        <button type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>

                                    <div class="form-group pt-1 mr-1">
                                        <a id="grid-items" class="order-icon active">
                                            <i class="fas fa-th"></i>
                                        </a>
                                    </div>
                                    <div class="form-group pt-1 mr-1">
                                        <a id="list-items" class="order-icon">
                                            <i class="fas fa-list"></i>
                                        </a>
                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>
                    </div><br><br></header>
                @endisset


            @isset($rows)
                @foreach($rows as $change)
                    <br><br>
                    <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6">
                        <div class="card mb-4">
                            <div class="content-card">
                                <div
                                    style="
                                        background-image: url('{{ App\Models\Advertising::photoValue($change -> photos)}}');

                                        "
                                    class="head-card align-items-end d-flex head-card justify-content-end"
                                >
                                    <a
                                         href="{{route('advertising.card-details', $change -> id)}}"
                                        class="w-100 h-100 align-items-end d-flex justify-content-end"
                                    >

                                    </a>
                                </div>
                                <div class="body-card px-3">
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="{{route('advertising.card-details', $change -> id)}}">
                                            <h6>{{$change -> id}}#</h6>
                                            <h6>{{$change -> title}}</h6>
                                        </a>

                                        @if(AdvertisingFavourite( $change -> id) == false )
                                            <div class="love-icon-card mt-2 ">
                                                <button onclick="window.location.href='{{route('advertiser_search.addFavourite' , ['id' => $change -> id , 'form_type' => $type_form] )}}'">
                                                    <i class="far fa-heart mt-1" ></i>
                                                </button>
                                            </div>

                                        @else
                                            <div class="love-icon-card mt-2 active ">
                                                <button onclick="window.location.href='{{route('advertiser_search.removeFavourite' , ['id' => $change -> id , 'form_type' => $type_form] )}}'">
                                                    <i class="far fa-heart mt-1" ></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="d-flex body-card-icon">
                                        <div class="d-flex ml-4 align-items-center">
                                            <i class="far fa-user ml-2"></i>
                                            <a href="{{route('advertiser.profile.data', $change ->  Advertiser -> id)}}">

                                            <p>{{$change ->  Advertiser -> name }}</p>
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt ml-2"></i>
                                            <a href="#">
                                                <p>{{$change ->  cityAdvertising -> name }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="mt-3 content-card-text">
                                        {{ $change -> description}}
                                    </p>
                                    <h5> {{ $change -> price}} $</h5>


                                            <div class="footer-card d-flex justify-content-between my-3">

                                                <div class="d-flex">
                                                    @if(CategoryRating($change -> id)  == 5)
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                    <i class="fas fa-star ml-2 full-star star-icon"></i>

                                                    @elseif(CategoryRating($change -> id)  == 4)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @elseif(CategoryRating($change -> id)  == 3)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @elseif(CategoryRating($change -> id)  == 2)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @elseif(CategoryRating($change -> id)  == 1)
                                                        <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>


                                                    @else
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>
                                                        <i class="fas fa-star empty-star star-icon"></i>

                                                    @endif
                                                </div>


                                            </div>


                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset


        </div>
    </section>

    @push('js')
        <script>
            $(function () {
                $("#mai").slice(0, 10).show(); // select the first ten
                $("#load").click(function (e) { // click event for load more
                    e.preventDefault();
                    $("div.mai:hidden").slice(0, 5).show(); // select next 10 hidden divs and show them
                    if ($("div.mai:hidden").length == 0) { // check if any hidden divs still exist
                        $("#mai1").hide();
                    }
                });
            });


            $('#country').change(function () {
                var countryID = $(this).val();
                if (countryID) {
                    $.ajax({
                        type: "GET",
                        url: "{{url('get-state-list')}}?country_id=" + countryID,
                        success: function (res) {
                            if (res) {
                                $("#state").empty();
                                $("#state").append('');
                                $.each(res, function (key, value) {
                                    $("#state").append('<option value="' + key + '">' + value + '</option>');
                                });

                            } else {
                                $("#state").empty();
                            }
                        }
                    });
                } else {
                    $("#state").empty();
                }
            });

        </script>
    @endpush

@endsection
