@extends('front-end.layouts.app')
@section('title' , ' الشروط و الأحكام')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/Terms-and-Conditions.css')}}" />
@endpush

@section('content')
    <section class="container site-page">
        <div class="row">
            <div class="col-12 col-md-6 order-2 order-md-1">
                <h2 class="title mx-3">الشروط و الأحكام</h2>
                <div class="paragraphs">

                    @isset($terms_conditions)
                        @foreach($terms_conditions as $terms_condition)
                            <p class="paragraph mx-3">
                             {{$terms_condition -> content}}
                            </p>
                        @endforeach
                    @endisset

                </div>
            </div>
            <div class="col-12 col-md-6 order-1 order-md-2">
                <h2 class="second-title mx-3">الشروط و الأحكام</h2>
                <img class="image" src="{{asset('front-end/images/Terms-and-Conditions.svg')}}" />
            </div>
        </div>
    </section>

@endsection
