@extends('layouts.admin_master')

@section('title')
    Send FCM
@stop

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
                        </p>
                        <br>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header">Send FCM</div>

                            <div class="card-body">
                                <form action="{{ route('send_notification') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label>Body</label>
                                        <textarea class="form-control" name="body"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Notification</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
    <script>

        var firebaseConfig = {
            apiKey: "AIzaSyAS3HAMZjHwdH7_ZBuPtbBLidxyHu_PcO8",
            authDomain: "laravelpushnotifications-66f84.firebaseapp.com",
            projectId: "laravelpushnotifications-66f84",
            storageBucket: "laravelpushnotifications-66f84.appspot.com",
            messagingSenderId: "1052066039489",
            appId: "1:1052066039489:web:bbbc5c7dfdd9edc9433640",
            measurementId: "G-MH7PB2RE66"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();


        function initFirebaseMessagingRegistration() {
            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function(token) {
                    console.log(token);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });


                    $.ajax({
                        url: '{{ route("save-token") }}',
                        type: 'POST',
                        data: {
                            token: token
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            alert('Token saved successfully.');
                        },
                        error: function (err) {
                            console.log('User Chats Token Error'+ err);
                        },
                    });

                }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
        }

        messaging.onMessage(function(payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(noteTitle, noteOptions);
        });

    </script>
@endsection
