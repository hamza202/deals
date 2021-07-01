
@extends('layouts.app')
@section('content')
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif
                <div class="card">

                    @if ($user_id == 1)
                        <div class="card-header">Send push to Users</div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <form action="{{ route('send-push') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$user->id}}" />

                                                <input class="btn btn-primary" type="submit" value="Send Push">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="card-header">User Panel</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

{{--    <script src="https://www.gstatic.com/firebasejs/6.3.4/firebase.js"></script>--}}
    <script>
        {{--const firebaseConfig = {--}}
        {{--    apiKey: {{env('FCM_apiKey')}},//"AIzaSyBBCIU0GGrYeXGqVVc3o9tRcHwttL9zQKE",--}}
        {{--    authDomain: {{env('FCM_authDomain')}},//"ron-test-8259b.firebaseapp.com",--}}
        {{--    databaseURL: {{env('FCM_databaseURL')}},// "https://ron-test-8259b.firebaseio.com",--}}
        {{--    projectId: {{env('FCM_projectId')}},//"ron-test-8259b",--}}
        {{--    storageBucket: {{env('FCM_storageBucket')}},//"ron-test-8259b.appspot.com",--}}
        {{--    messagingSenderId: {{env('FCM_messagingSenderId')}},//"780107221889",--}}
        {{--    appId: {{env('FCM_appId')}},//"1:780107221889:web:d6917449f4d14e85603680"--}}
        {{--};--}}

        {{--$(document).ready(function(){--}}
        {{--    const config = firebaseConfig;--}}
        {{--    firebase.initializeApp(config);--}}
        {{--    const messaging = firebase.messaging();--}}

        {{--    messaging--}}
        {{--        .requestPermission()--}}
        {{--        .then(function () {--}}
        {{--            return messaging.getToken()--}}
        {{--        })--}}
        {{--        .then(function(token) {--}}
        {{--            $.ajaxSetup({--}}
        {{--                headers: {--}}
        {{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--                }--}}
        {{--            });--}}
        {{--            $.ajax({--}}
        {{--                url: '{{ URL::to('/save-device-token') }}',--}}
        {{--                type: 'POST',--}}
        {{--                data: {--}}
        {{--                    user_id: {!! json_encode($user_id ?? '') !!},--}}
        {{--                    fcm_token: token--}}
        {{--                },--}}
        {{--                dataType: 'JSON',--}}
        {{--                success: function (response) {--}}
        {{--                    console.log(response)--}}
        {{--                },--}}
        {{--                error: function (err) {--}}
        {{--                    console.log(" Can't do because: " + err);--}}
        {{--                },--}}
        {{--            });--}}
        {{--        })--}}
        {{--        .catch(function (err) {--}}
        {{--            console.log("Unable to get permission to notify.", err);--}}
        {{--        });--}}

        {{--    messaging.onMessage(function(payload) {--}}
        {{--        const noteTitle = payload.notification.title;--}}
        {{--        const noteOptions = {--}}
        {{--            body: payload.notification.body,--}}
        {{--            icon: payload.notification.icon,--}}
        {{--        };--}}
        {{--        new Notification(noteTitle, noteOptions);--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endsection
