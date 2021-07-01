@extends('back-end.layouts.app')
@section('title' , 'امر تدلل')

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')


    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="content col-12 d-flex justify-content-between align-items-center my-5">
                <h5 class="title">برنامج امر تدلل</h5>
                <div class="d-flex flex-column">
                    <button type="button" class="btn btn-secondary the-button my-1 px-4" data-toggle="modal"
                            data-target="#AddModalCenter">إضافة برنامج امر تدلل
                    </button>
                    <button type="button" onclick="window.location.href='{{route('admin.amrtidall.pdf')}}'"
                            class="btn btn-info rounded-pill my-1 px-4">تصدير الجدول
                    </button>
                </div>
            </div>
            <!-- table -->
            <div class="table-responsive mt-5">
                <table class="table table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">النشاط</th>
                        <th scope="col">أقصى عدد للحصول عليها</th>
                        <th scope="col">عدد النقاط</th>
                        <th scope="col" class="text-center">الاعدادات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($points)
                        @foreach($points as $point)
                            <tr>
                                <td>{{$point -> activity}}</td>
                                <td>
                                    {{$point -> total_subscriptions}}
                                </td>
                                <td>
                                    {{$point -> num_points}}
                                </td>
                                <td>

                                    <div>
                                        <button type="button" class=" btn btn-warning rounded-pill px-2 px-sm-4"
                                                onclick="window.location.href='{{route('admin.points.active',$point -> id)}}'">
                                            {{$point -> getActive()}}

                                        </button>
                                    </div>
                                    <br>
                                    <div>
                                        <button type="button"
                                                class="editPoints btn btn-success rounded-pill px-2 px-sm-4"
                                                data-toggle="modal" data-target="#EditModalCenter"
                                                data-id="{{$point -> id}}"
                                                data-activity="{{$point -> activity}}"
                                                data-num_points="{{$point -> num_points}}"
                                                data-total_subscriptions="{{$point -> total_subscriptions}}"

                                        >تعديل
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>

                </table>
                {{ $points->links() }}
            </div>
        </div>

    </section>
    <!-- Modal -->
    <div class="modal fade" id="EditModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> تعديل البرنامج </h4>
                </div>


                <div class="modal-body">
                <form class=" modal-body mx-auto edit-modal-content" action="{{route('admin.amrtidall.update')}}"
                      method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="">
                    <div class="col-12 my-2">
                        <h6 class="text-right input-label">اسم النشاط</h6>
                        <input type="text" name="activity" id="activity" value="" class="form-control"
                               aria-label="Amount (to the nearest dollar)">
                    </div>
                    <div class="col-12 my-2">
                        <h6 class="text-right input-label">اقصى عدد للحصول عليها</h6>
                        <input type="number" name="total_subscriptions" id="total_subscriptions" value=""
                               class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                    <div class="col-12 my-2">
                        <h6 class="text-right input-label">عدد النقاط</h6>
                        <input type="number" name="num_points" id="num_points" value="" class="form-control"
                               aria-label="Amount (to the nearest dollar)">
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button style="display: flex;
                        align-items: center;" type="submit" class="btn btn-warning rounded-pill px-5 py-3"
                        >حفظ
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- Modal2 -->
    <div class="modal fade" id="AddModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">


                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>

                    <h4 class="modal-title" style="margin-left: 40%"> اضافة برنامج جديد</h4>
                </div>


                <div class="modal-body">

                    <form class=" modal-body mx-auto edit-modal-content" action="{{route('admin.amrtidall.store')}}"
                          method="POST">
                        @csrf
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">النشاط</h6>
                            <input type="text" name="activity" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">

                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">اقصى عدد للحصول عليه</h6>
                            <input type="number" name="total_subscriptions" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">

                        </div>
                        <div class="col-12 my-2">
                            <h6 class="text-right input-label">عدد النقاط</h6>
                            <input type="number" name="num_points" class="form-control"
                                   aria-label="Amount (to the nearest dollar)">

                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-warning rounded-pill px-5 py-3"
                                    style="display: flex;
                        align-items: center;"
                            >انشاء
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>

            $(document).on("click", ".editPoints", function () {
                var id = $(this).data('id');
                var activity = $(this).data('activity');
                var num_points = $(this).data('num_points');
                var total_subscriptions = $(this).data('total_subscriptions');

                $(".modal-content #id").val(id);
                $(".modal-content #activity").val(activity);
                $(".modal-content #num_points").val(num_points);
                $(".modal-content #total_subscriptions").val(total_subscriptions);
            });
        </script>
    @endpush

@endsection

