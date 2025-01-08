// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.2/firebase-app.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyDkigItOtYlI7-D_N3jhh-5RMILipztduw",
  authDomain: "ptrs-d34f8.firebaseapp.com",
  databaseURL: "https://ptrs-d34f8-default-rtdb.asia-southeast1.firebasedatabase.app",
  projectId: "ptrs-d34f8",
  storageBucket: "ptrs-d34f8.firebasestorage.app",
  messagingSenderId: "652005422950",
  appId: "1:652005422950:web:23cdd71ea44585ebd3baa7",
  measurementId: "G-F1P8L290ZY"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

export { app }