@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'التقارير')
@push('style')
    <link rel="stylesheet" href="{{ asset('back-end/css/index.css')}}"/>
    <link rel="stylesheet" href="{{ asset('back-end/css/department.css')}}"/>
@endpush

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')


    <section id="department-content" class="container" style="padding-top:50px">
        <div class="d-flex justify-content-between">
            <h5>التقارير</h5>
        </div>

        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">التقرير</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td> احصائيات المسجلين فى الموقع</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city"
                                    data-id="1" data-name="pdf">
                                pdf
                            </button>

                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city1">
                                Excel
                            </button>

                        </div>
                    </td>
                </tr>

                <tr>
                    <td> احصائيات العملاء النشطين /غير نشطين فى الموقع</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button
                                class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                onclick="window.location.href='{{route('moderator.reports.AdvertiserActiveReport')}}'">
                                pdf
                            </button>

                            <button
                                class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                onclick="window.location.href='{{route('moderator.reports.AdvertiserActiveReportExcel')}}'">
                                Excel
                            </button>

                        </div>
                    </td>
                </tr>

                <tr>
                    <td>كيف عرفت ديل</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city2"
                                    data-id="1" data-name="pdf">
                                pdf
                            </button>

                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city3">
                                Excel
                            </button>

                        </div>
                    </td>
                </tr>

                <tr>
                    <td>طريقة تفعيل الحساب</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city4"
                                    data-id="1" data-name="pdf">
                                pdf
                            </button>

                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city5">
                                Excel
                            </button>

                        </div>
                    </td>
                </tr>

                <tr>
                    <td> الهدايا</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city8"
                                    data-id="1" data-name="pdf">
                                pdf
                            </button>

                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city9">
                                Excel
                            </button>

                        </div>
                    </td>
                </tr>

                <tr>
                    <td> العمولات</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city10"
                                    data-id="1" data-name="pdf">
                                pdf
                            </button>

                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city11">
                                Excel
                            </button>

                        </div>
                    </td>
                </tr>


                <tr>
                    <td> اكثر الاقسام زيارة من العملاء</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city14"
                                    data-id="1" data-name="pdf">
                                pdf
                            </button>

                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city15">
                                Excel
                            </button>

                        </div>
                    </td>
                </tr>


                <tr>
                    <td> احصائيات زوار الموقع / اعضاء الموقع</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city6"
                                    data-id="1" data-name="pdf">
                                pdf
                            </button>

                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city7">
                                Excel
                            </button>

                        </div>
                    </td>
                </tr>

                </tbody>
            </table>
            <div class="justify-content-center d-flex">

            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="edit-city" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">


                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.AdvertiserReport')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="edit-city1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.AdvertiserReportExcel')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>




    <div class="modal fade" id="edit-city2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">

                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.AdvertiserSocialReport')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="edit-city3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.AdvertiserSocialReportExcel')}}"
                          method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="edit-city4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.AdvertiserAccountReport')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="edit-city5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.AdvertiserAccountReportExcel')}}"
                          method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>



    <div class="modal fade" id="edit-city6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.VisitorReport')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="edit-city7" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.VisitorReportExcel')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="edit-city8" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.GiftReport')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="edit-city9" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.GiftReportExcel')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="edit-city10" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">

                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.MoneyReport')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="edit-city11" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.MoneyReportExcel')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="edit-city14" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.CategoryReport')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="edit-city15" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-75" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div class="modal-body">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 class="modal-title"> الفترة الزمنية :</h4>
                    </div>
                    <form class="form" action="{{route('moderator.reports.CategoryReportExcel')}}" method="POST">
                        @csrf
                        <input type="hidden" value="" id="id" name="id">
                        <input type="hidden" value="" id="name" name="name">

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> من:</label>
                                <input name="from" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> الى :</label>
                                <input name="to" type="date" class="form-control" required/>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                تنزيل
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>



    @push('js')
        <script>
            $(document).ready(function () {
                $(".select2").select2();

                $('b[role="presentation"]').hide();

                $(".select2-selection__arrow").append(
                    '<i class="fa fa-angle-down"></i>'
                );
            });

            $(document).ready(function () {
                $("#dtHorizontalExample").DataTable({
                    scrollX: true,
                });
                $(".dataTables_length").addClass("bs-select");
            });


            $(document).on("click", ".update-city", function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                $(".modal-content #id").val(id);
                $(".modal-content #name").val(name);
            });

        </script>
    @endpush

@endsection
