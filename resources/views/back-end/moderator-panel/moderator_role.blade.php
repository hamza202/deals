<!DOCTYPE html>
<html lang="en">
<head>
    <title>صلاحيات المشرف</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('front-end/css/custome.css')}}">
    <link rel="stylesheet" href="{{ asset('back-end/css/main.css')}}" />
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


</head>
<body dir="rtl" class="text-right">

@include('back-end.layouts.includes.head')

<form action="{{route('moderator.update.role')}}" method="POST">

@csrf
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="content col-12 d-flex justify-content-between align-items-center my-5">
            <h5 class="title px-2"> صلاحيات المشرف : {{$data -> name}}</h5>

            <div class="d-flex flex-column px-2">
                <button type="submit" class="btn btn-secondary the-button my-1 px-4"
                       > حفظ الصلاحيات
                </button>
                <a type="button" href="{{route('moderator.add.all.role', ['id' => $data -> id])}}" class="btn btn-info blue-btn the-button my-1 px-4"
                > اضافة جميع الصلاحيات
                </a>
            </div>
        </div>
        <!-- table -->
<input type="hidden" value="{{$data -> id}}" name="moderator_id">

        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">

                <thead>
                <tr>
                    <th></th>
                    <th>
                        <input type="checkbox" onclick="toggle(this);"/>اختيار الكل <br/>
                    </th>
                </tr>
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
                                <div class="form-group form-check">
                                    <input type="checkbox" name="{{$row ->code}}" value="1" class="form-check-input" id="exampleCheck1"
                                    @foreach($role as $roles)
                                        @if($roles -> role_id == $row -> code)
                                            checked
                                            @endif
                                        @endforeach
                                        >
                                    <label class="form-check-label" for="exampleCheck1">  </label>
                                </div>

                        </tr>
                    @endforeach
                @endisset

                </tbody>
            </table>
        </div>
    </div>
</section>


</form>


@include('back-end.layouts.includes._footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('back-end/js/nav-footer.js')}}"></script>
<script src="{{ asset('front-end/js/main.js')}}"></script>

<script>
    $('.btn-toggle').click(function() {
        $(this).find('.btn').toggleClass('active');

        if ($(this).find('.btn-primary').length>0) {
            $(this).find('.btn').toggleClass('btn-primary');
        }
        if ($(this).find('.btn-danger').length>0) {
            $(this).find('.btn').toggleClass('btn-danger');
        }
        if ($(this).find('.btn-success').length>0) {
            $(this).find('.btn').toggleClass('btn-success');
        }
        if ($(this).find('.btn-info').length>0) {
            $(this).find('.btn').toggleClass('btn-info');
        }

        $(this).find('.btn').toggleClass('btn-default');

    });

    $('form').submit(function(){
        var radioValue = $("input[name='options']:checked").val();
        if(radioValue){
            alert("You selected - " + radioValue);
        };
        return false;
    });

    function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }
</script>
</body>

</html>
