<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.0.2/firebase-app.js"></script>

<!-- include firebase database -->
<script src="https://www.gstatic.com/firebasejs/8.0.2/firebase-database.js"></script>


<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyDTNy8KpnJeP9RwtTJidK5dpR7SfelnqnQ",
    authDomain: "my-chat-app-f8311.firebaseapp.com",
    databaseURL: "https://my-chat-app-f8311.firebaseio.com",
    projectId: "my-chat-app-f8311",
    storageBucket: "my-chat-app-f8311.appspot.com",
    messagingSenderId: "865331337873",
    appId: "1:865331337873:web:3750a090391c3457097d30"
  };


  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

  var myName = prompt("Enter your name");

  function sendMessage() {
      //get message
      var message = document.getElementById("message").value;
      //save in database
      firebase.database().ref("message").push().set({
          "sender": myName,
          "message": message
      })
      //prevent form from submitting
      return false;
  }

  //listen for incoming messages
  firebase.database().ref("message").on("child_added", function(snapshot) {
    var html="";
    html +="<li>";
      html += snapshot.val().sender + ": " + snapshot.val().message;
    html +="</li>";

    document.getElementById("messages").innerHTML += html;

  });
</script>

<!--create a form to send message -->
<form onsubmit="return sendMessage();">
  <input id="message" placeholder = "Enter message" autocomplete="off">
  <input type="submit">
</form>


<!--create a list -->
<ul id="messages"></ul>