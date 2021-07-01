@extends('front-end.layouts.app')
@section('title' , 'معاهدة الموقع')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/Site-Treaty.css')}}" />

@endpush

@section('content')
    <section class="container site-page">
        <div class="row">
            <div class="col-12 col-md-6 order-2 order-md-1">
                <h2 class="title mx-3">معاهدة الموقع</h2>
                <div class="paragraphs">
                    @isset($site_treaty)
                        @foreach($site_treaty as $site)
                    <p class="paragraph mx-3">
                    {{$site -> content}}
                    </p>
                        @endforeach
                    @endisset
                </div>
            </div>
            <div class="col-12 col-md-6 order-1 order-md-2">
                <h2 class="second-title">معاهدة الموقع</h2>
                <img class="image" src="{{ asset('front-end/images/Site-Treaty.svg')}}" />
            </div>
        </div>
    </section>

@endsection
