<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
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
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front-end/css/custome.css')}}" />
    @stack('styles')

    <script src="https://use.fontawesome.com/3d7f67fd97.js"></script>

    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css"
        rel="stylesheet"
    />
    <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-messaging.js"></script>

    <link rel="manifest" href="{{asset('manifest.json')}}">
    {{-- e:firebase fcm --}}
    <link rel="stylesheet" href="{{ asset('front-end/css/responsive.css')}}"/>

</head>
<body dir="rtl" class="text-right">

@yield('content')


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->


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

<script src="{{ asset('front-end/js/nav-footer.js')}}"></script>
<script src="{{ asset('front-end/js/main.js')}}"></script>

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


<script src="{{ asset('js/firebase.js')}}"></script>

@stack('js')

</body>
</html>
