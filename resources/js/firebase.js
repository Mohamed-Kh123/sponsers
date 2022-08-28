// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getMessaging, getToken } from "firebase/messaging";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyCayUZMi6IZxBmPQLkiL7Yh3JrE0RteqOI",
  authDomain: "sponser-project.firebaseapp.com",
  projectId: "sponser-project",
  storageBucket: "sponser-project.appspot.com",
  messagingSenderId: "1059960509731",
  appId: "1:1059960509731:web:a36fe750903a322b22a896",
  measurementId: "G-YMPQWKBZ40"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Initialize Firebase Cloud Messaging and get a reference to the service
const messaging = getMessaging();

getToken(messaging, { vapidKey: 'BLSC1D5n12iaFebZA085eimuUBHYISBdtDoY4QhhBDilKktTLMgy4OZKB5pSkPU4nhmkxmKwoTK9kOlOFT89oR4' }).then((currentToken) => {
  if (currentToken) {
    // Send the token to your server and update the UI if necessary
    console.log(currentToken);
  } else {
    // Show permission request UI
    console.log('No registration token available. Request permission to generate one.');
    // ...
  }
}).catch((err) => {
  console.log('An error occurred while retrieving token. ', err);
  // ...
});