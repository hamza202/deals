@extends('back-end.layouts.app')
@section('title' , 'الاعلان')

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section class="container my-5">
        <div id="accordion">


            <div>
                <div class="d-flex justify-content-between">
                    <h3 style="color: #a9ae00"> معلومات المعلن </h3>
                </div>
                <!-- table -->
                <div class="table-responsive mt-5">
                    <table class="table  table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col">اسم المعلن</th>
                            <th scope="col">رقم الجوال</th>
                            <th scope="col">البريد الإلكتروني</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>{{$rows->advertiser -> name}}</td>
                            <td> {{$rows->advertiser -> email}}</td>
                            <td> {{$rows -> advertiser -> phone}}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            <br>
            <div>
                <div class="d-flex justify-content-between">
                    <h3 style="color: #a9ae00"> باقات اشتراك المعلن </h3>
                </div>
                <!-- table -->
                <div class="table-responsive mt-5">
                    <table class="table  table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col">اسم الباقة</th>
                            <th scope="col"> تاريخ البداية</th>
                            <th scope="col"> تاريخ النهاية</th>
                            <th scope="col"> عدد الاعلانات المطلوب تثبيتها</th>
                            <th scope="col"> عدد الاعلانات تم تثبيتها</th>
                        </tr>
                        </thead>
                        <tbody>

                        @isset($packages)
                            @foreach($packages as $package)

                                <tr>
                                    <td>{{$package ->package -> name}}</td>
                                    <td> {{$rows->start_date}}</td>
                                    <td> {{$rows -> end_date}}</td>
                                    <td> {{$package ->package -> plan ->advertising}}</td>
                                    <td> {{ $subscription_count_fixed = App\Models\FixedAdvertising::where([
                                                   'subscriptions_id' => $package ->id,
                                                   'status' => 1
                                               ])->count()}}</td>
                                </tr>
                            @endforeach
                        @endisset
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <br>
            <div>
                <div class="d-flex justify-content-between">
                    <h3 style="color: #a9ae00"> معلومات الاعلان </h3>
                </div>
                <!-- table -->
                <div class="table-responsive mt-5">
                    <table class="table  table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col">اسم الاعلان</th>
                            <th scope="col"> الحالة</th>
                            <th scope="col"> القسم الرئيسي</th>
                            <th scope="col"> القسم الفرعي</th>
                            <th scope="col"> المدينة</th>
                            <th scope="col"> مبلغ التأمين</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>{{$rows-> title}}</td>
                            <td>{{$rows-> Status -> name}}</td>
                            <td>{{$rows -> advertiserCategory -> name  }}</td>
                            <td>{{$rows -> advertiserSubCategory -> name  }}</td>
                            <td>{{$rows -> cityAdvertising -> name  }}</td>
                            <td>{{$rows -> insurance_price }}</td>
                        </tr>

                        </tbody>
                    </table>
                    <table class="table  table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col"> السعر</th>
                            <th scope="col"> شروط</th>
                            <th scope="col"> وصف</th>
                            <th scope="col"> الهاتف</th>
                            <th scope="col"> العنوان</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>

                            <td>{{$rows -> price}}</td>
                            <td>{{$rows -> special_conditions}}</td>
                            <td>{{$rows -> description}}</td>
                            <td>{{$rows -> phone}}</td>
                            <td>{{$rows -> address  }}</td>
                        </tr>

                        </tbody>
                    </table>
                    <table class="table  table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col"> صور الاعلان</th>
                        </tr>
                        </thead>
                        <tbody>
                        <td>
                            <?php
                            foreach ((array)json_decode($rows->photos)as $picture) { ?>
                            <img src="{{ asset( 'front-end/'.$picture) }}" style="height:120px; width:200px"/>
                            <?php } ?>
                        </td>

                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <br>
            <div>
                <div class="d-flex justify-content-between">
                    <h3 style="color: #a9ae00"> حالة الاعلان </h3>
                </div>
                <!-- table -->
                <div class="table-responsive mt-5">
                    <table class="table  table-hover text-center">
                        <thead>
                        <tr>
                            <th scope="col"> الحالة</th>
                            <th scope="col"> تاريخ البداية</th>
                            <th scope="col"> تاريخ النهاية</th>
                            <th scope="col"> الباقة</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td> {{$rows -> Status -> name}}</td>
                            <td>
                                @if($rows->start_date != null)
                                    {{$rows->start_date}}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($rows->end_date != null)
                                    {{$rows->end_date }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($rows->package_id != null)
                                    {{$rows -> advertisingPackage -> package -> name}}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <br>
            <div>
                <div class="d-flex justify-content-between">
                    <h3 style="color: #a9ae00"> تحديث حالة الاعلان </h3>
                </div>
                <!-- table -->
                <div class="table-responsive mt-5">
                    <form class="form" action="{{route('admin.advertise.save_status')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{$rows -> id}}">
                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">الحالة :</label>
                                <br>
                                <select
                                    class="form-control select2"
                                    name="status"
                                    id="status"
                                    required
                                >
                                    @foreach(App\Models\AdvertisingStatus::all() as $row)
                                        <option
                                            value="{{ $row->id }}" {{ ( $row->id == $rows->status) ? 'selected' : '' }}> {{ $row->name }} </option>
                                    @endforeach

                                </select>


                            </div>


                        </div>


                        <br>

                        <div class="row modal-body mx-auto edit-modal-content">
                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">باقات المعلن :</label>
                                <br>
                                <select
                                    class="form-control select2"
                                    name="package_id"
                                    id="package_id"
                                >
                                    <option value="">اختر باقة الاعلان</option>

                                    @php
                                        $subscriptions = App\Models\Subscription::where('advertiser_id' , $rows->advertiser->id)->where('status' , 1)->get();
                                    @endphp
                                    @foreach($subscriptions as $subscription)
                                        <option
                                            value="{{$subscription -> id}}">{{$subscription->package -> name}}</option>
                                    @endforeach

                                </select>


                            </div>


                        </div>

                        <br>

                        <div class="row modal-body mx-auto edit-modal-content">


                            <div class="col">
                                <label for="input-add-city" class="text-right input-label"> تاريخ بدء عرض الاعلان
                                    على الموقع:</label>
                                <input id="input-add-city" name="start_date" value="{{$rows->start_date}}" type="date"
                                       class="form-control"/>
                            </div>

                            <div class="col">
                                <label for="input-add-city" class="text-right input-label">تاريخ نهاية عرض الاعلان
                                    على الموقع :</label>
                                <input id="input-add-city" name="end_date" value="{{$rows->end_date}}" type="date"
                                       class="form-control"/>
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

            @if(App\Models\FixedAdvertising::where(['advertising_id' =>$rows -> id ,
                                                    'status' => 0
                                                    ])
                                                    ->count()== 1
              )
                <div>
                    <div class="d-flex justify-content-between">
                        <h3 style="color: #a9ae00"> رفض تثبيت الاعلان </h3>
                    </div>
                    <!-- table -->
                    <div class="table-responsive mt-5">
                        <form class="form" action="{{route('admin.advertise.save_status_refuse')}}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$rows -> id}}">
                            <div class="row modal-body mx-auto edit-modal-content">
                                <div class="col">
                                    <label for="input-add-city" class="text-right input-label">سبب الرفض :</label>
                                    <br>
                                    <input type="hidden" value="{{$rows -> id}}" name="id">
                                    <textarea name="reason" style="width: 100%;height: 100px">
                                  </textarea>

                                </div>


                            </div>


                            <br>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" class="btn btn-warning rounded-pill border-0 px-5 py-2">
                                    حفظ
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection
