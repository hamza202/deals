@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'صلاحيات')
@push('styles')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}" />
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}" />

@endpush

@section('content')


    <section id="department-content" class="container" style="padding-top: 100px">
        <div class="row mr-2 ml-2" >
            <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                    id="type-error">لا يوجد لديك صلاحية
            </button>
        </div>
    </section>

@endsection
