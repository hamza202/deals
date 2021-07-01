@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'القائمة السوداء')

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section class="container my-5">

        <div class="w-100 mx-auto d-flex align-items-center row specialize-result" style="margin-bottom: 5%">
            <form class="w-100 mx-auto d-flex align-items-center row specialize-result"
                  action="{{route('moderator.advertiser.blackList.search')}}">
                @csrf
                <input type="hidden" name="filter" value="0">
                <div class="w-100 d-flex col-9 col-lg-9">
                    <label
                        class="select-title d-flex justify-content-center align-items-center col-xl-3">الاسم</label>
                    <input type="text" id="name" class="form-control col-xl-6" name="name"
                           style="width: 100%;" PLACEHOLDER="ابحث عن المعلن ">
                </div>
                <div class="w-100 d-flex col-12 col-lg-3 my-3">
                    <button type="submit" class="rounded-pill btn btn-dark w-75 h-25 px-2">ابحث</button>
                </div>
            </form>
        </div>

        @if(count($data) > 0)
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <span style="color: #174de4;
    font-size: 20px;
}"> النتائج </span>
                        </h5>
                    </div>
                    <div class="card-body">
                        @if(isset($data))
                            <div class="table-responsive mt-5">
                                <table class="table table-striped table-hover text-center">
                                    <thead>
                                    <tr>
                                        <th scope="col">المعلن</th>
                                        <th scope="col">الايميل</th>
                                        <th scope="col" class="text-center">الاعدادات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($data)
                                        @foreach($data as $data1)
                                            <tr>
                                                <td> {{$data1 -> name}}</td>
                                                <td> {{$data1 -> email}}</td>
                                                <td>
                                                    @if($data1 -> is_active == 0)
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit"
                                                                    class="update btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                                    data-toggle="modal" data-target="#edit"
                                                                    data-id="{{$data1 -> id}}"
                                                                    data-name="{{$data1->name}}">
                                                                اضافة الى القائمة السوداء
                                                            </button>
                                                        </div>
                                                    @else
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit"
                                                                    class="update btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                                    onclick="window.location.href='{{route('moderator.black_list.delete', $data1 -> id)}}'">
                                                                ازالة من القائمة السوداء
                                                            </button>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    {{ $data->links() }}

                                </div>

                                <div class="justify-content-center d-flex">

                                </div>
                            </div>
                        @else
                            <span style="font-size: 20px;color: #0a0302">لا يوجد معلنين </span>
                        @endif

                    </div>

                </div>
            </div>
        @endif

        @if(count($advertisers) > 0 ||count($rows) > 0)
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                                           <span style="color: #174de4;
    font-size: 20px;
}">القائمة السوداء</span>

                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            @if(isset($rows))
                                <div class="table-responsive mt-5">
                                    <table class="table table-striped table-hover text-center">
                                        <thead>
                                        <tr>
                                            <th scope="col">المعلن</th>
                                            <th scope="col">سبب الاضافة</th>
                                            <th scope="col" class="text-center"> الاعدادات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @isset($rows)
                                            @foreach($rows as $row)
                                                <tr>
                                                    <td> {{$row -> advertiser -> name}}</td>
                                                    <td>{{$row -> reason}} </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit"
                                                                    class="update btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                                    onclick="window.location.href='{{route('moderator.black_list.delete', $row -> id)}}'">
                                                                ازالة من القائمة السوداء
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endforeach
                                        @endisset
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        {{ $rows->links() }}

                                    </div>

                                    <div class="justify-content-center d-flex">

                                    </div>
                                </div>
                            @else
                                <span
                                    style="font-size: 20px;color: #0a0302">لا يوجد معلنين مضافين بالقائمة السوداء </span>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <span style="color: #174de4;
    font-size: 20px;
}"> المعلنين</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        @if(isset($advertisers))
                            <div class="table-responsive mt-5">
                                <table class="table table-striped table-hover text-center">
                                    <thead>
                                    <tr>
                                        <th scope="col">المعلن</th>
                                        <th scope="col">الايميل</th>
                                        <th scope="col" class="text-center">الاعدادات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($advertisers)
                                        @foreach($advertisers as $advertiser)
                                            <tr>
                                                <td> {{$advertiser -> name}}</td>
                                                <td> {{$advertiser -> email}}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="submit"
                                                                class="update btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                                                data-toggle="modal" data-target="#edit"
                                                                data-id="{{$advertiser -> id}}"
                                                                data-name="{{$advertiser->name}}">
                                                            اضافة الى القائمة السوداء
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    {{ $advertisers->links() }}

                                </div>

                                <div class="justify-content-center d-flex">

                                </div>
                            </div>
                        @else
                            <span style="font-size: 20px;color: #0a0302">لا يوجد معلنين </span>
                        @endif

                    </div>

                </div>
            </div>
        @endif

        <!-- Optional JavaScript -->

    </section>

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 10%"> اضافة معلن الى القائمة السوداء:</h4>
                </div>


                <div class="modal-body">
                    <form class="form" action="{{route('moderator.black_list.store')}}" method="POST">
                        @csrf
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">اسم المعلن:</label>
                                <input id="name" value="" readonly name="name" type="text" class="form-control"/>
                                <input id="id" value="" name="id" type="hidden" class="form-control"/>
                            </div>

                            <div>
                                <label for="input-add-city" class="text-right input-label"> السبب:</label>
                                <textarea id="reason" name="reason" style="height: 200px;width: 100%"
                                          type="text" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                حفظ
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @push('js')
        <script>
            $(document).on("click", ".update", function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                $(".modal-content #id").val(id);
                $(".modal-content #name").val(name);
            });

        </script>
    @endpush

@endsection
