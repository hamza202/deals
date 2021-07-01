//////////////////////////////////////////////////////////////////////////////////
///// JUST For Make Sure Firebase configuration is done successfully ////////////
//////////////////////////////////////////////////////////////////////////////////
if(!window.firebaseConfig){
    window.firebaseConfig = {
        apiKey: "AIzaSyDxXasH_kj4-KbSvTBMFA9gmF3trebvgyQ",
        authDomain: "dealsa-6850d.firebaseapp.com",
        databaseURL: "https://dealsa-6850d.firebaseio.com",
        projectId: "dealsa-6850d",
        storageBucket: "dealsa-6850d.appspot.com",
        messagingSenderId: "906486549971",
        appId: "1:906486549971:web:2c6a365ec0e75f10d27326",
        measurementId: "G-SF54Y7CZ81",
    };
}
//////////////////////////////////////////////////////////////////////////////////


firebase.initializeApp(window.firebaseConfig);
const messaging = firebase.messaging();

messaging.requestPermission().then(function () {
    return messaging.getToken()
}).then(function (token) {
    $('#fcm_token').val(token);
    // console.log(token);
    if(window.firebaseTokenUrl != false){
        var user = JSON.parse($('#user').val());
        if(token !==  user?.uuid){
            $.ajax({
                type: "POST",
                url: window.firebaseTokenUrl,
                data: JSON.stringify({
                    uuid: token
                }),
                xhrFields: {
                    withCredentials: false
                },
                headers:{
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Content-Type': 'application/json'
                },
                dataType: 'json',
            }).then(response => {
                console.log(response);
            }).catch(e => {
                console.error(e);
            });
        }

    }

}).catch(function (err) {
    console.log(err);
});

messaging.onMessage((payload) => {
    console.log('Message received. ', payload);

});

