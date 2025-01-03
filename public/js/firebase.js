// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.2/firebase-app.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyCPr_sD5XFZN6U-iwRv6qO_sCR_fJMNbCI",
  authDomain: "chdnm-pts-e91cf.firebaseapp.com",
  databaseURL: "https://chdnm-pts-e91cf-default-rtdb.asia-southeast1.firebasedatabase.app",
  projectId: "chdnm-pts-e91cf",
  storageBucket: "chdnm-pts-e91cf.firebasestorage.app",
  messagingSenderId: "813260053052",
  appId: "1:813260053052:web:3beb28b22de7e372e1c139"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

export { app }