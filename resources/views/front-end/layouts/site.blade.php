<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->


    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    />

    <!-- Bootstrap CSS -->
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">

    <link rel="stylesheet" href="{{ asset('front-end/css/custome.css')}}"/>
    @stack('styles')


    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css"
        rel="stylesheet"
    />
    {{--    <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-app.js"></script>--}}
    {{--    <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-messaging.js"></script>--}}

    <link rel="manifest" href="{{asset('manifest.json')}}">
    <script>
        window.firebaseConfig = {
            apiKey: "{{env('FCM_apiKey')}}",//"AIzaSyBBCIU0GGrYeXGqVVc3o9tRcHwttL9zQKE",
            authDomain: "{{env('FCM_authDomain')}}",//"ron-test-8259b.firebaseapp.com",
            databaseURL: "{{env('FCM_databaseURL')}}",// "https://ron-test-8259b.firebaseio.com",
            projectId: "{{env('FCM_projectId')}}",//"ron-test-8259b",
            storageBucket: "{{env('FCM_storageBucket')}}",//"ron-test-8259b.appspot.com",
            messagingSenderId: "{{env('FCM_messagingSenderId')}}",//"780107221889",
            appId: "{{env('FCM_appId')}}",//"1:780107221889:web:d6917449f4d14e85603680"
        };

        window.firebaseTokenUrl = "{{ auth('advertiser')->check()? url('/addUUID') : false }}";
        window.csrfToken = "{{ csrf_token() }}";

        {{--window.user = "{{ auth('advertiser')->user() }}";--}}
    </script>
    <input type="hidden" value="{{ auth('advertiser')->user() }}" id='user'>
    <link rel="stylesheet" href="{{ asset('front-end/css/responsive.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front-end/css/responsive.css')}}"/>

</head>
<body dir="rtl" class="text-right">


@yield('content')


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
    src="https://code.jquery.com/jquery-3.3.1.js"
    crossorigin="anonymous"
></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $(".select2").select2();

        $('b[role="presentation"]').hide();

        $(".select2-selection__arrow").append(
            '<i class="fa fa-angle-down"></i>'
        );

        $("#list-items").click(function () {
            $(".columns").removeClass("col-xl-3 col-lg-4");
            $(".head-card").addClass("h-auto rounded-img-card");
            $(".content-card").addClass("d-flex");
            $(".fixed-label").addClass("m-0 w-100 label-fixed-grid");
            $(".fixed-ad").addClass("mt-4");
            $(".order-icon").removeClass("active");
            $(this).addClass("active");
        });

        $("#grid-items").click(function () {
            $(".columns").addClass("col-xl-3 col-lg-4");
            $(".head-card").removeClass("h-auto rounded-img-card");
            $(".content-card").removeClass("d-flex");
            $(".fixed-label").removeClass("m-0 w-100 label-fixed-grid");
            $(".fixed-ad").removeClass("mt-4");
            $(".order-icon").removeClass("active");
            $(this).addClass("active");
        });
    });
</script>

<script src="{{ asset('front-end/js/PlacePicker.js')}}"></script>
<script src="{{ asset('front-end/js/map.js')}}"></script>


<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
{{--<script type="text/javascript">--}}
{{--    var configFontAwesome = {--}}
{{--        custom: {--}}
{{--            families: ['fontawesome'],--}}
{{--            urls: ['https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css']--}}
{{--        },--}}
{{--        fontactive: function () {--}}
{{--            $('.rateit-fa').rateit();--}}
{{--        }--}}
{{--    };--}}
{{--    WebFont.load(configFontAwesome);--}}
{{--</script>--}}

<script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-messaging.js"></script>
<script src="{{ asset('front-end/js/main.js')}}"></script>
<script src="{{ asset('js/firebase.js')}}"></script>

<script>
    $(document).ready(function () {


        messaging.onMessage((payload) => {
            let x = document.getElementById('notificatio-no').textContent;
            x = parseInt(x);
            // console.log(x);
            x = x + 1;
            // console.log(x.toString());
            document.getElementById('notificatio-no').innerText = '';
            document.getElementById('notificatio-no').innerText = x.toString();
            console.log(payload.notification);
            var chattest = document.getElementById('testchat');
            var title = payload.notification.title;
            var chaturl = payload.notification.click_action;
            var notphoto = payload.notification.photo;
            chattest.insertAdjacentHTML('afterend', `
                <a href="${chaturl}" style="padding:15px" class="dropdown-item">${title}</a>

                <hr>`);
            console.log('Message received. ', payload);


        });
    })

</script>


<input type="hidden" name="fcm_token" id='fcm_token'>


@stack('js')

</body>
</html>
