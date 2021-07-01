importScripts('https://www.gstatic.com/firebasejs/7.20.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.20.0/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
if(!firebaseConfig){
    var firebaseConfig = {
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
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    // const notificationTitle = 'Background Message Title';
    // const notificationOptions = {
    //     body: 'Background Message body.',
    //     icon: '/firebase-logo.png'
    // };
    //
    // return self.registration.showNotification(notificationTitle,
    //     notificationOptions);
    let options = {
        body: payload.data.body,
        icon: payload.data.icon
    }

    return self.registration.showNotification(payload.data.title, options);

});

