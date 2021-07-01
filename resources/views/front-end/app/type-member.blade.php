@extends('front-end.layouts.app')
@section('title' , ' العضويات')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/type-member.css')}}" />
@endpush

@section('content')
    <section class="container px-5 mt-5">
        <h1 class="text-head">سياسة عضويات ديل:</h1>

        @isset($type_member)
            @foreach($type_member as $member)
                <div class="row card shadow">
                    <img
                        class="image-card"
                        src="{{$member -> photo }}"
                        alt="{{$member -> title }}"

                    />
                    <div class="row body-card">
                        <div class="col-12 col-md-7">
                            <h1>
                                مؤهلات الحصول على العضوية
                            </h1>
                            <ul>
                                <li>{{$member ->qualifications}}</li>

                            </ul>
                        </div>
                        <div class="col-12 col-md-5">
                            <h1>
                                مميزات العضوية
                            </h1>
                            <ul>
                                <li>{{$member ->features}}</li>

                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset

    </section>

@endsection
