@extends('front-end.layouts.app')
@section('title' , ' من نحن')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/about-us.css')}}" />
@endpush

@section('content')

    <section class="container site-page">
        <div class="row   ">
            <div class="col-12 col-md-6 order-2 order-md-1">
                <h2 class="title mx-3">من نحن</h2>
                <div class="paragraphs">
                    @isset($about_us)
                        @foreach($about_us as $about)
                    <p class="paragraph mx-3">
                       {{$about-> content}}
                    </p>
                        @endforeach
                  @endisset
                </div>
            </div>
            <div class="col-12 col-md-6 order-1 order-md-2">
                <h2 class="second-title">من نحن</h2>
                <img class="image" src="{{ asset('front-end/images/about-us.svg')}}" />
            </div>
        </div>
    </section>

@endsection
