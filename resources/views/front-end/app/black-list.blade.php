@extends('front-end.layouts.app')
@section('title' , ' القائمة السوداء ')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/black-list.css')}}" />
    <link rel="stylesheet" href="{{ asset('front-end/css/responsive.css')}}" />
@endpush
@section('content')
    <section class="container site-page">
        <div>
            <div>
                <h2 class="search-title p-1 mb-2 m-1 ">البحث في القائمة السوداء</h2>
                <h6 class="m-2 ">
                    القائمة السوداء هي قائمة بإرقام حسابات وأرقام جوالات من يقومون
                    بإساءة إستخدام الموقع لأغراض ممنوعه مثل الغش أو الأحتيال أو مخالفة
                    قوانين الموقع
                </h6>
                <div class="col-md-12 ">


                    <form class="w-100 mx-auto mb-4 mb-md-0" action="{{route('black-list')}}" method="POST">
                       @csrf
                        <div
                            class="d-flex d-flex pl-4 rounded-pill search-container py-1 pr-2"
                        >
                            <input
                                name="filter"
                                class="input-search form-control rounded-pill border-0"
                                type="search"
                                placeholder="ابحث عن القائمة السوداء "
                                aria-label="Search"
                            />
                            <button class="my-auto">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row real-result">
                @if(isset($black_list))
                    @foreach($black_list as $list)
                <div class="row card-row my-3 col-lg-12">
                    <div class="card shadow">
                        <img src="{{$list -> advertiser -> photo}}" />
                        <div>
                            <p class="name">{{$list -> advertiser -> name}}</p>
                            <p class="email">{{$list -> advertiser -> email}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                        @elseif(isset($rows))
                            @foreach($rows as $list)
                                <div class="row card-row my-3 col-lg-12">
                                    <div class="card shadow">
                                        <img src="{{$list ->  photo}}" />
                                        <div>
                                            <p class="name">{{$list ->  name}}</p>
                                            <p class="email">{{$list -> email}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                @else
                    <h2 class="result">لا يوجد مخالفين</h2>
                @endif
            </div>
        </div>
    </section>

    <div style="
    margin-top: 100px;
">

    </div>

@endsection
