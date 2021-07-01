@extends('front-end.layouts.app')
@section('title' , ' بيانات  المعلن')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/update-account.css')}}" />
@endpush

@section('content')

    <section class="container text-right">
        <!-- update form -->


            <h3 class="mt-3 text-center">بيانات المعلن</h3>

            @include('front-end.layouts.includes.alerts.errors')
            @include('front-end.layouts.includes.alerts.success')


            <div class="form-group mt-5">
                <div class="text-center">
                    <div class="imgUp position-relative">
                        <img
                            style="width: 130px; height: 130px;"
                            id="imageUrl"
                            name="photo"
                            class="rounded-circle imagePreview img-circle"
                            src="{{ $row -> photo}}"
                        />
                    </div>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="user-name">إسم المستخدم</label>
                    <input
                        type="text"
                        class="form-control input"
                        readonly
                        value="{{ $row -> username}}"
                    />

                </div>
                <div class="form-group col-lg-6">
                    <label for="name">الإسم </label>
                    <input
                        type="text"
                        class="form-control input"
                        readonly
                        value="{{ $row -> name}}"
                    />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="phone">الجوال</label>
                    <input
                        type="text"
                        class="form-control input"
                      readonly
                        value="{{ $row -> phone}}"
                    />

                </div>
                <div class="form-group col-lg-6">
                    <label for="whatsapp">العنوان</label>
                    <input
                        type="text"
                        class="form-control input"
                       readonly
                        value="{{ $row-> address}}"
                    />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="email">البريد الإلكتروني</label>
                    <input
                        type="email"
                        class="form-control input"
                       readonly
                        value="{{ $row -> email}}"
                    />
                </div>
                <div class="form-group col-lg-6">
                    <label for="city">المدينة </label>
                    <input
                        class="form-control input"
                        readonly
                        value="{{ $row -> advertiserCity -> name}}"
                    />
                </div>
            </div>

        <br>
        <br>
        <br>
        <h4 class="same-Advertisement">أحدث اعلانات المعلن </h4>
        <br>
        <div class="row">

            @if($advertising == null)
                <div class="d-flex site-page px-5">
                    <p class="title">    لا يوجد اعلانات </p>
                </div>
            @else
                @foreach($advertising as $change)
                    <div class="columns col-12 col-xl-3 col-lg-4 col-sm-6">
                        <div class="card mb-4">
                            <div class="content-card">
                                <div
                                    style="
                                        background-image: url('{{ App\Models\Advertising::photoValue($change -> photos)}}');

                                        "
                                    class="head-card align-items-end d-flex head-card justify-content-end"
                                >
                                    <a
                                        href="{{route('advertising.card-details', $change -> id)}}"
                                        class="w-100 h-100 align-items-end d-flex justify-content-end"
                                    >

                                    </a>
                                </div>

                                <br><br>
                                <div class="body-card px-3">
                                    <div class="d-flex body-card-icon">
                                        <div class="d-flex ml-4 align-items-center">
                                            <i class="far fa-user ml-2"></i>
                                            <a href="{{route('advertiser.profile.data', $change ->  Advertiser -> id)}}">
                                                <p>{{$change ->  Advertiser -> name }}</p>
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt ml-2"></i>
                                            <a href="#">
                                                <p>{{$change ->  cityAdvertising -> name }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="mt-3 content-card-text">
                                        {{ $change -> description}}
                                    </p>
                                    <h5> {{ $change -> price}} $</h5>


                                    <div class="footer-card d-flex justify-content-between my-3">

                                        <div class="d-flex">
                                            @if(CategoryRating($change -> id)  == 5)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>

                                            @elseif(CategoryRating($change -> id)  == 4)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>


                                            @elseif(CategoryRating($change -> id)  == 3)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>


                                            @elseif(CategoryRating($change -> id)  == 2)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>


                                            @elseif(CategoryRating($change -> id)  == 1)
                                                <i class="fas fa-star ml-2 full-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>


                                            @else
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>
                                                <i class="fas fa-star empty-star star-icon"></i>

                                            @endif
                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
     @endif

        </div>

         </section>

    @push('js')


        <script>
            $(document).ready(function () {
                var readURL = function (input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("#imageUrl").attr("src", e.target.result);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                };

                $(".uploadFile").on("change", function () {
                    readURL(this);
                });
            });
            $("#imgUrlDel").click(function () {
                document.getElementById("imageUpload").value = "";
                document.getElementById("noneImage").value = "1";
                $("#imageUrl").attr("src", "nnn");
            });
        </script>
    @endpush

@endsection
