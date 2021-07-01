@extends('front-end.layouts.app')
@section('title' , ' كشف النقاط ')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/Detection-points.css')}}"/>
@endpush

@section('content')
    <section class="container-fluid site-page mb-4">
        <div class="column">
            <div class="head">
                <p>كشف النقاط</p>
                <button class="btn btn-outline-secondary">المجموع: {{advertiserPoints(advertiser()->id)}} نقطة</button>
            </div>
            <div>

                @isset($rows)
                    @foreach($rows as $row)
                        <div class="card shadow-sm">
                            <i class="fas fa-star"></i>
                            <p class="discription my-2">لقد حصلت على {{$row -> num_points}} نقطة مقابل {{$row -> activity}}</p>
                        </div>
                    @endforeach
                @endisset

            </div>
        </div>
    </section>

@endsection
