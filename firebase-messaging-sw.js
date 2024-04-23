importScripts('https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.6.8/firebase-messaging.js');

// Initialize Firebase
var config = {
    // скопировать данные из firebase
    // apiKey: "AIzaSyCX60VsXgVLPl_s6TMwtPNrdxW6ru_zLm8",
    // authDomain: "datingpro-fd736.firebaseapp.com",
    // databaseURL: "https://datingpro-fd736-default-rtdb.firebaseio.com",
    // projectId: "datingpro-fd736",
    // storageBucket: "datingpro-fd736.appspot.com",
    // messagingSenderId: "153188596194",
    // appId: "1:153188596194:web:fa44f6ae5031ab562aa1bb"
};

firebase.initializeApp(config);
const messaging = firebase.messaging();

self.addEventListener('notificationclick', function(event) {
  console.log('SW: Push received event', event)
  event.notification.close();
  if (event.notification.data.data.link) {
      event.waitUntil(self.clients.openWindow(event.notification.data.data.link));
  }
});

self.addEventListener('push', event => {
    let data = {}

    if (event.data) {
      data = event.data.json();
    }

    console.log('SW: Push received', data)

    if (data.notification && data.notification.title) {
      console.log('showNotification Push');
      self.registration.showNotification(data.notification.title, {
        body: data.notification.body,
        icon: '/application/views/flatty/img/favicon/favicon-32x32.png',
        data: data
      })
    } else {
      console.log('SW: No notification payload, not showing notification')
    }
  })