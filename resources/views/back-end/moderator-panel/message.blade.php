@extends('back-end.moderator-panel.layouts.app')
@section('title' , 'الرسائل الترويجية')

@section('content')
    <!-- Cities section -->
    @include('back-end.layouts.includes.alerts.errors')
    @include('back-end.layouts.includes.alerts.success')

    <section class="container pt-5 contain-form mt-5">
        <h3 class="text-center mb-5">  الرسائل الترويجية :</h3>

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
                        محتوى الرسالة
                    </h5>
                </div>
                <div class="modal-body">
                    <section class="container-fluid">

                        <form method="POST" action="{{route('moderator.messages.store')}}" enctype="multipart/form-data">
                            @csrf
                                                     <div class="row justify-content-around ">
                                <p class="modal-card-title my-1">
                                    <strong> عنوان الرسالة</strong>
                                </p>
                                <input
                                    type="text"
                                    class="form-control w-75 rounded-pill"
                                    id="exampleInputEmail155"
                                    aria-describedby="emailHelp"
                                    placeholder="أضف هنا عنوان الرسالة"
                                    name="title"
                                    required
                                />
                            </div>
                            <br>
                            <br>
                            <div class="row justify-content-around " >
                                <p class="modal-card-title my-1">
                                    <strong> محتوى الرسالة</strong>
                                </p>
                                <textarea style="background-color: aliceblue"
                                    type="text"
                                    class="form-control w-75 rounded-pill"
                                    id="exampleInputEmail155"
                                    aria-describedby="emailHelp"
                                    name="contents"
                                    required
                                ></textarea>
                            </div>


                            <div
                                class="row justify-content-around "

                                style="
                                      border-top: none;
                                      display: flex;
                                      justify-content: end;
                                    "
                            >
                                <button

                                    type="submit"
                                    class="btn btn-primary btn-outline-primary rounded-pill px-4"
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




@endsection
