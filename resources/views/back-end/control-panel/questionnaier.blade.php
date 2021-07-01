@extends('back-end.layouts.app')
@section('title' , 'الاستبيان')
@push('style')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>
@endpush

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')
    @error('name')
    <div class="row mr-2 ml-2">
        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                id="type-error">{{$message}}
        </button>
    </div>
    @enderror

    <section id="department-content" class="container" style="padding-top:50px">

        <div class="modal-header">

            <h4 class="modal-title" style="margin-left: 40%">رابط الاستبيان:</h4>
        </div>

        <div class="modal-body">
            <form action="{{route('admin.questionnaire.store')}}" method="POST">
                @csrf
                <div class="px-5 py-3 rounded" style="background-color: #ebebeb;">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="department-name">الرابط:</label>
                            @if(isset($data))
                                <input type="text" name="url" class="form-control input" id="department-name"
                                       required value="{{$data -> url}}"/>
                            @else
                                <input type="text" name="url" class="form-control input" id="department-name"
                                       required/>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <button id="sub-btn" type="submit"
                            class="green-btn border-0 btn btn-primary mx-auto w-25 py-2 rounded-pill mt-4">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
