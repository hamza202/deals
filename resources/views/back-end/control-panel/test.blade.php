@extends('back-end.layouts.app')
@section('title' , ' صلاحيات المشرف')
@push('style')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
@endpush

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="content col-12 d-flex justify-content-between align-items-center my-5">
                <h5 class="title px-2"> صلاحيات المشرف </h5>
            </div>
            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">الاكشن</th>
                        <th scope="col">اضافة</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($rows)
                        @foreach($rows as $row)
                            <tr>
                                <td>{{$row -> name}} </td>
                                <td>
                                    <div class="switch">
                                        <label>
                                            Off
                                            <input type="checkbox" checked>
                                            <span class="lever"></span> On
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endisset

                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection

