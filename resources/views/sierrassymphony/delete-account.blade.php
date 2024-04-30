<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sierra's Symphony | Delete Account</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
  <style media="screen">
    body {
      background: #ab959a;
      color: rgba(0,0,0,0.87);
      font-family: Roboto, Helvetica, Arial, sans-serif;
      margin: 0;
      padding: 0;
      text-align: center;
    }

    input {
      border: 1px solid #000;
      border-radius: 5px;
      padding: 8px;
      margin: 8px;
    }

    button {
      border: none;
      border-radius: 5px;
      padding: 8px;
      margin: 8px;
      background-color: #d71f2f;
      color: #fff;
      font-weight: 500;
    }

    button:hover {
      background-color: #e22020;
      cursor: pointer;
    }

    button:active {
      background-color: #b71c27;
    }
  </style>
</head>
<body>
  <img src="{{ asset('storage/images/sierra-logo.png') }}" alt="Sierra's Symphony" width="400px">
  <h1>Sierra's Symphony</h1>
  <h3>Delete Account</h3>
  <p>By deleting your account, you lose access to all content in the<br>Sierra's Symphony app, and all personal data is removed.</p>
  <p>Enter your Email and Password to delete your account</p>
  <input id="email" type="email" placeholder="Email" />
  <input id="password" type="password" placeholder="Password" />
  <br>
  <button onclick="deleteAccount()">Delete Account</button>

  <!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->
  <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
  <script src="/__/firebase/8.10.1/firebase-app.js"></script>

  <!-- Load the Firebase SDKs before loading this file -->
  <script src="/__/firebase/init.js"></script>

  <!-- Add Firebase products that you want to use -->
  <script src="/__/firebase/8.10.1/firebase-auth.js"></script>
  <script src="/__/firebase/8.10.1/firebase-firestore.js"></script>

  <script>
    const auth = firebase.auth();
    const db = firebase.firestore();

    async function deleteAccount() {
      let email = document.getElementById('email').value;
      let password = document.getElementById('password').value;
      if (!email) {
        alert('Please enter your email.');
        return;
      }

      if (!email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      )) {
        alert('Please enter a valid email.');
        return;
      }

      if (!password) {
        alert('Please enter your password.');
        return;
      }

      try {
        await auth.signInWithEmailAndPassword(email, password);
      } catch (err) {
        console.error(err);
        alert('Incorrect email or password.');
        return;
      }

      if (!confirm('Are you sure you want to delete your account? This cannot be undone!')) {
        auth.signOut();
        return;
      }

      try {
        await db.collection("users").doc(auth.currentUser.uid).delete();
        await auth.currentUser.delete();

        alert('Your account has been deleted.');

      } catch (err) {
        console.error(err);
        alert('An error occurred. Please try again.');
        return;
      }
    }
  </script>
</body>
</html>
