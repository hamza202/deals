@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'الصفحات')


@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section id="department-content" class="container" style="padding-top: 100px">
        <div class="d-flex justify-content-between">
            <h5>الصفحات</h5>
        </div>

        <!-- table -->
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">الصفحة</th>
                    <th scope="col" class="text-center">الاعدادات</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td> من نحن</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal"
                                    onclick="window.location.href='{{route('moderator.pages.about_us')}}'"
                            >
                                اعدادات الصفحة
                            </button>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td> معاهدة الموقع</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city"
                                    onclick="window.location.href='{{route('moderator.pages.site_treaty')}}'"
                            >
                                اعدادات الصفحة
                            </button>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td> الشروط و الأحكام</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city"
                                    onclick="window.location.href='{{route('moderator.pages.terms_conditions')}}'"
                            >
                                اعدادات الصفحة
                            </button>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td> امر تدلل</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city"
                                    onclick="window.location.href='{{route('moderator.pages.amrtidall')}}'"
                            >
                                اعدادات الصفحة
                            </button>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td> السوشيل ميديا</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city"
                                    onclick="window.location.href='{{route('moderator.pages.social')}}'"
                            >
                                اعدادات الصفحة
                            </button>
                        </div>
                    </td>


                </tr>

                <tr>
                    <td>  كيف عرفت ديل </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                    class="update-city btn btn-success rounded-pill px-2 px-sm-4 green-btn border-0 ml-2"
                                    data-toggle="modal" data-target="#edit-city"
                                    onclick="window.location.href='{{route('moderator.pages.knowUs')}}'"
                            >
                                اعدادات الصفحة
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
@endsection
