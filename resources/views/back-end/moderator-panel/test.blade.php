@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'المدن')
@push('style')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}" />
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}" />
@endpush

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section id="department-content" class="container" style="padding-top: 100px">
        <div class="d-flex justify-content-between">
            <h5>المدن</h5>

        </div>

        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">المدينة</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                </thead>

            </table>
            <div class="text-center">
                {{ $rows->links() }}

            </div>

            <div class="justify-content-center d-flex">

            </div>
        </div>

    </section>

@endsection
