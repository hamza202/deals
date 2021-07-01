@extends('back-end.layouts.app')
@section('title' , 'الاعلانات')

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section class="container my-5">

        <div class="row justify-content-center">
            <div class="content col-12 d-flex justify-content-between align-items-center my-5">
                <h5 class="title"> الاعلانات </h5>
                <div class="d-flex flex-column">
                    <button type="button" class="btn btn-secondary the-button my-1 px-4"
                            onclick="window.location.href='{{route('admin.advertising.new.update')}}'"> تحديث الاعلانات
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <form class="w-100 mx-auto mb-4 mb-md-0" action="{{route('admin.search.advertising')}}">
                @csrf
                <div
                    class="d-flex d-flex pl-4 rounded-pill search-container py-1 pr-2"
                >
                    <input
                        name="filter"
                        class="input-search form-control rounded-pill border-0"
                        type="search"
                        placeholder="ابحث عن ما تشاء، مثلا:(رقم جوال العميل او الاسم او اسم المسخدم او الايميل )"
                        aria-label="Search"
                    />
                    <button class="my-auto" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="row">

            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">القسم</th>
                        <th scope="col">اجمالى عدد الاعلانات المثبتة</th>
                        <th scope="col"> الاعلانات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($rows)
                        @foreach($rows as $row)
                            <tr>
                                <td>
                                    {{$row -> name}}
                                </td>
                                <td>
                                    {{CategoryActive($row -> id)}}
                                </td>
                                <td>

                                    <button
                                        onclick="window.location.href='{{route('admin.advertising.mainFixed', $row ->id)}}'"
                                        class="btn btn-outline-dark rounded-pill px-2 px-sm-4 border-0 ml-2">
                                        المثبتة
                                    </button>
                                    <button
                                        onclick="window.location.href='{{route('admin.advertising.accept', $row ->id)}}'"
                                        class="btn btn-outline-dark rounded-pill px-2 px-sm-4 border-0 ml-2">
                                        المفعلة
                                    </button>
                                    <button
                                        onclick="window.location.href='{{route('admin.advertising.finish', $row ->id)}}'"
                                        class="btn btn-outline-dark rounded-pill px-2 px-sm-4 border-0 ml-2">
                                        منتهية
                                    </button>
                                    <button
                                        onclick="window.location.href='{{route('admin.advertising.all', $row ->id)}}'"
                                        class="btn btn-outline-dark rounded-pill px-2 px-sm-4 border-0 ml-2">
                                        الكل
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Modal -->


@endsection
