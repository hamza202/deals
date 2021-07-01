@extends('front-end.layouts.app')
@section('title' , ' اعداد الحساب')
@push('styles')
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/update-account.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front-end/css/responsive.css')}}" />

@endpush

@section('content')

    <section class="container text-right">
        <!-- update form -->
        <form class="mt-5 contain-form first-form pt-3"
              action="{{route('advertiser.update-account')}}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <input name="id" value="{{advertiser() -> id}}" type="hidden">

            <h3 class="mt-3 text-center">إعدادات الحساب</h3>

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
                            src="{{ advertiser() -> photo}}"
                        />
                        <div
                            style="
                  top: 0;
                  right: 0;
                  left: 0;
                  bottom: 0;
                  position: absolute;
                "
                        >
                            <label
                                id="upload-image"
                                class="align-items-end btn btn-default d-flex flex-1 h-100 justify-content-center mx-auto profile-edit rounded-circle shadow background-balck"
                                style="width: 130px;"
                            >
                                <input
                                    name="image_url"
                                    type="file"
                                    id="imageUpload"
                                    class="uploadFile img"
                                    value="Upload Photo"
                                    style="
                      padding: 0;
                      width: 0px;
                      height: 0px;
                      overflow: hidden;
                    "
                                />
                                <div id="icon-camera" style="display: none;">
                                    <i
                                        class="d-block fa-camera fas mt-3"
                                        style="color: #fff;"
                                    ></i>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <input id="noneImage" name="noneImage" value="0" hidden>
                <h5 class="my-4 text-center">تعديل الصورة الشخصية</h5>
                @error('photo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>


            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="user-name">إسم المستخدم</label>
                    <input
                        type="text"
                        class="form-control"
                        id="user-name"
                        name="username"
                        required
                        readonly
                        value="{{ advertiser() -> username}}"
                    />
                    @error('username')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-6">
                    <label for="name">الإسم </label>
                    <input
                        type="text"
                        class="form-control input"
                        id="name"
                        required
                        name="name"
                        value="{{ advertiser() -> name}}"
                    />
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="phone">الجوال</label>
                    <input
                        type="text"
                        class="form-control input"
                        id="phone"
                        required
                        name="phone"
                        value="{{ advertiser() -> phone}}"
                    />
                    @error('phone')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-6">
                    <label for="whatsapp">العنوان</label>
                    <input
                        type="text"
                        class="form-control input"
                        id="address"
                        name="address"
                        value="{{ advertiser() -> address}}"
                    />
                    @error('address')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="email">البريد الإلكتروني</label>
                    <input
                        type="email"
                        class="form-control input"
                        id="email"
                        required
                        name="email"
                        value="{{ advertiser() -> email}}"
                    />
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-6">
                    <label for="city">المدينة </label>
                    <select id="city" name="city_id" class="form-control">
                        <option value="" selected disabled>المدينة</option>
                        @foreach($rows as $city)
                            <option value="{{ $city -> id }}"
                                    @if(advertiser() -> city_id == $city -> id) selected

                                @endif >{{ $city -> name }}</option>
                        @endforeach
                    </select>
                    @error('city_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row mb-3">
                <button
                    id="sub-btn"
                    type="submit"
                    class="save-btn btn btn-primary mx-auto w-25 py-2 btn-create-ad rounded-pill mt-4"
                >
                    حفظ
                </button>
            </div>
        </form>

        <form class="mt-5 contain-form first-form pt-3" action="{{route('advertiser.update-password')}}" method="POST">
            @csrf
            <h3 class="mt-4 mb-5 text-center">تعديل كلمة المرور</h3>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="password">كلمه المرور القديمة</label>
                    <input
                        type="password"
                        name="old_password"
                        class="form-control input"
                        id="password"
                        required
                    />
                    @error('old_password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="new-password">كلمه المرور الجديده</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control input"
                        id="new-password"
                        required
                    />
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-6">
                    <label for="confirm-password">تأكيد كلمه المرور الجديده</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control input"
                        id="confirm-password"
                        required
                    />
                    @error('password_confirmation')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row mb-3">
                <button
                    id="sub-btn"
                    type="submit"
                    class="save-btn btn btn-primary mx-auto w-25 py-2 btn-create-ad rounded-pill mt-4"
                >
                    حفظ
                </button>
            </div>
        </form>
        <form class="mt-5 contain-form first-form pt-3" action="{{route('advertiser.update-messeges')}}" method="POST">
            @csrf
            <h3 class="mt-4 mb-5 text-center"> الرسائل الترويجية</h3>
            <div class="form-row">
                <div class="form-group col-lg-12">
                    @if(advertiser()->messages == 0)
                        <div class="new-massege-re row checkbox col-md-8 justify-content-center" style="margin:auto">
                            <input class="mx-2" type="checkbox" id="agree-messeges" name="messeges-agree" value="msg"
                                   checked>
                            <label class="checkbox-text2" for="agree-messeges"><small>اوافق على ارسال الرسائل
                                    الترويجية</small></label><br>
                        </div>
                    @else
                        <div class="new-massege-re row checkbox col-md-8 justify-content-center" style="margin:auto">
                            <input class="mx-2" type="checkbox" id="agree1-messeges" name="messeges-agree1" value="msg2"
                                   checked>
                            <label class="checkbox-text2" for="agree1-messeges"><small> إلغاء ارسال الرسائل
                                    الترويجية</small></label><br>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-row mb-3">
                <button
                    id="sub-btn"
                    type="submit"
                    class="save-btn btn btn-primary mx-auto w-25 py-2 btn-create-ad rounded-pill mt-4"
                >
                    حفظ
                </button>
            </div>
        </form>
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
