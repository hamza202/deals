<!DOCTYPE html>
<html lang="en">
<head>
    <title>تسجيل الدخول</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />


    <!-- Bootstrap CSS -->
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ asset('front-end/css/custome.css')}}" />
    <link rel="stylesheet" href="{{ asset('front-end/css/form-sign-in.css')}}" />

</head>

<body dir="rtl">

<form class="form-horizontal form-simple" action="{{route('moderator.login')}}" method="post"
      novalidate>
    @csrf
<section class="container-fluid">
    <div class="row full-page">
        <div class="col-12 col-sm-6 order-2 order-sm-1 right-section">
            <div class="data-input w-75">
                @include('back-end.layouts.includes.alerts.errors')
                @include('back-end.layouts.includes.alerts.success')
                <div class="input w-100">
                    <label>البريد الإلكتروني </label>
                    <input
                        type="email"
                        name="email"
                        class="form-control input py-4 px-0"
                        id="activation-type"
                        placeholder="moh.ah@gmail.com"
                    />
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="input w-100 my-4">
                    <label>كلمة المرور</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control input py-4 px-0"
                        id="activation-type"
                        placeholder="*******"
                    />
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="remmember-pass-forget">
                    <div class="remmember-me">
                        <input
                            type="checkbox"
                            id="remmeber-me"
                            name="remmember-me"
                            value="remmember-me"
                        />
                        <label for="remmember-me" class="remmember-me-text px-2">تذكرني دائما</label>
                    </div>

                </div>
            </div>
            <div class="submit-buttons mt-4">
                <button type="submit" class="btn btn-secondary login w-25 mx-2 py-3">تسجيل</button>
            </div>
        </div>
        <div class="col-12 col-sm-6 order-1 order-sm-2 left-section">
            <a href="{{route('index')}}">   <img class="back" src="{{ asset('front-end/images/back.png')}}" /></a>
            <img class="sign-up" src="{{ asset('front-end/images/sign-up.png')}}" />
            <h2 class="did-you-forget-password">تسجيل الدخول</h2>
        </div>
    </div>
</section>
</form>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
    src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"
></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"
></script>
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"
></script>
</body>
</html>
