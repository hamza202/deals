@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'السوشيل')
@push('styles')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>
@endpush


@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section id="department-content" class="container" style="padding-top: 100px">
        <div class="d-flex justify-content-between">
            <h5>السوشيل ميديا</h5>

        </div>

        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">السوشيل</th>
                    <th scope="col">الرابط</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                </thead>
                <tbody>
                @isset($rows)
                    @foreach($rows as $row)
                        <tr>
                            <td> {{$row -> name}}</td>
                            <td>{{$row -> link}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                            class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                            data-toggle="modal" data-target="#edit-city"
                                            data-name="{{$row -> name}}" data-id="{{$row -> id}}"  data-linkRow="{{$row -> link}}">

                                        تعديل

                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset
                </tbody>
            </table>

        </div>
    </section>

    <div class="modal fade" id="edit-city" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h4 class="modal-title">تحديث الرابط  :</h4>
                </div>
                <form class="form" action="{{route('moderator.pages.socialUpdate')}}" method="POST">
                    @csrf
                    <input id="id" value=""  name="id" type="hidden" class="form-control"  />

                    <div class="row modal-body mx-auto edit-modal-content">
                        <div class="col">
                            <label for="input-add-city" class="text-right input-label">اسم السوشيل:</label>
                            <input id="name" value="" readonly name="name" type="text" class="form-control"  />
                        </div>
                    </div>

                    <div class="row modal-body mx-auto edit-modal-content">
                        <div class="col">
                            <label for="input-add-city" class="text-right input-label">الرابط :</label>
                            <input id="linkRow" value=""  name="linkRow" type="text" class="form-control"  />
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2" >
                            تحديث
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- Optional JavaScript -->

    @push('js')
        <script>
            $(document).on("click", ".update-city", function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var linkRow = $(this).data('linkRow');
                $(".modal-content #id").val( id );
                $(".modal-content #name").val( name );
                $(".modal-content #linkRow").val( linkRow );
            });

        </script>
    @endpush


@endsection
