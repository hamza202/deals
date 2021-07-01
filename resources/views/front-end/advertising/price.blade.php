<!DOCTYPE html>
<html lang="en">
<head>
    <title>دفع العمولة </title>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="stylesheet" href="{{ asset('front-end/css/all.min.css')}}">

    <!-- Bootstrap CSS -->
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ asset('front-end/css/custome.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front-end/css/create-ad.css')}}"/>

    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('front-end/css/responsive.css')}}"/>

</head>


<body class="text-right" dir="rtl">
@include('front-end.layouts.includes._header')

<section class="container pt-5 contain-form mt-5">
    <h3 class="text-center mb-5"> دفع العمولة :</h3>

    @include('front-end.layouts.includes.alerts.errors')
    @include('front-end.layouts.includes.alerts.success')

    <div>
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5
                    class="modal-title"
                    style="width: 100%; text-align: center;"
                    id="exampleModalLongTitle"
                >
                    بيانات مقدم الطلب
                </h5>
            </div>
            <div class="modal-body">
                <section class="container-fluid">

                    <form method="POST" action="{{route('advertising.update.price')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$row -> id}}" name="id">

                        <div style="margin-bottom: 20px" class="row justify-content-around">
                            <p class="modal-card-title my-1">
                                <strong>اسم المحول</strong>
                            </p>
                            <input
                                type="text"
                                class="form-control w-75 rounded-pill"
                                id="exampleInputEmail155"
                                aria-describedby="emailHelp"
                                placeholder="أضف هنا اسمك المدرج في الحوالة البنكية"
                                name="bank_name"
                                required
                            />
                        </div>

                        <div class="row justify-content-around" style="margin-bottom: 20px">
                            <p class="modal-card-title my-1">
                                <strong class="p-1">الاسم  </strong>
                            </p>
                            <input
                                type="text"
                                class="form-control w-75 rounded-pill"
                                id="exampleInputEmail155"
                                aria-describedby="emailHelp"
                                name="name"
                                readonly
                                value="{{advertiser()->username}}"
                            />
                        </div>
                        <div class="row justify-content-around" style="margin-bottom: 20px">
                            <p class="modal-card-title my-1">
                                <strong>الهاتف </strong>
                            </p>
                            <input
                                type="text"
                                class="form-control w-75 rounded-pill"
                                name="phone"
                                readonly
                                value="{{advertiser()->phone}}"
                                required
                            />
                        </div>
                        <div class="row justify-content-around" style="margin-bottom: 20px">
                            <p class="modal-card-title my-1">
                                <strong>الايميل </strong>
                            </p>
                            <input
                                type="email"
                                class="form-control w-75 rounded-pill"
                                id="exampleInputEmail155"
                                aria-describedby="emailHelp"
                                name="email"
                                required
                                readonly
                                value="{{advertiser()->email}}"
                            />
                        </div>
                        <div class="row px-2 my-1" style="margin-bottom: 20px">
                            <p class="px-2 modal-card-title">
                                <strong>قيمة العمولة : </strong>
                            </p>
                            <p class="w-50 modal-card-description">
                                {{$row -> commission}}
                            </p>
                            <input type="hidden" value="{{$row -> commission}}" name="money">
                        </div>
                        <div class="column mx-n2" style="margin-bottom: 20px">
                            <p class="modal-card-title my-1">
                                <strong>المرفقات</strong>
                            </p>
                            <input class="w-100" type="file" name="files" required/>
                        </div>
                        <p class="modal-card-description">
                            <small
                            >صيغة المرفقات يجب ان تكون jpeg,png,jpg,gif,svg,pdf
                            </small>
                        </p>
                        <div
                            class="modal-footer"
                            style="
                                      border-top: none;
                                      display: flex;
                                      justify-content: end;
                                    "
                        >
                            <button
                                type="submit"
                                class="btn btn-primary rounded-pill px-4"
                            >
                                إرسال
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</section>


@include('front-end.layouts.includes._footer')


<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $(".select2").select2();

        $('b[role="presentation"]').hide();

        $(".select2-selection__arrow").append(
            '<i class="fa fa-angle-down"></i>'
        );
    });
</script>
<script src="{{ asset('front-end/js/PlacePicker.js')}}"></script>
<script src="{{ asset('front-end/js/nav-footer.js.js')}}"></script>
<script src="{{ asset('front-end/js/map.js')}}"></script>


<script>
    $('#country').change(function () {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                type: "GET",
                url: "{{url('get-state-list')}}?country_id=" + countryID,
                success: function (res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('');
                        $.each(res, function (key, value) {
                            $("#state").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {
                        $("#state").empty();
                    }
                }
            });
        } else {
            $("#state").empty();
        }
    });

</script>
<script type="text/javascript">
    $('#category').change(function () {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                type: "GET",
                url: "{{url('/get-state-list')}}?category_id=" + countryID,
                success: function (res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('');
                        $.each(res, function (key, value) {
                            $("#state").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {
                        $("#state").empty();
                    }
                }
            });
        } else {
            $("#state").empty();
        }
    });
</script>
<script>
    $("#pac-input").focusin(function () {
        $(this).val('');
    });
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

</script>

</body>
</html>
