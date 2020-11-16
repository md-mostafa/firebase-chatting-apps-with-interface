 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

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
      firebase.database().ref("messages").push().set({
          "sender": myName,
          "message": message
      })
      //prevent form from submitting
      return false;
  }

  //listen for incoming messages
  firebase.database().ref("messages").on("child_added", function(snapshot) {
    var html="";
    //give each message a unique ID
    html +="<li id='message-" + snapshot.key + "'>";
    //show delete butto if message is sent by me
    if(snapshot.val().sender == myName) {
      html += "<button data-id='"+snapshot.key+"' onclick='deleteMessage(this);'>";
         html +="Delete";
      html += "</button>";
    }
      html += snapshot.val().sender + ": " + snapshot.val().message;
    html +="</li>";

    document.getElementById("messages").innerHTML += html;
  });

  function deleteMessage(self){
    //get message ID
    var messageId = self.getAttribute("data-id");

    //delete message
    firebase.database().ref('messages').child(messageId).remove();
  }

  //attach listener for delete message
  firebase.database().ref('messages').on('child_removed', function(snapshot){
    //remove message node
    document.getElementById("message-"+snapshot.key).innerHTML = "This message has been removed";
  });

</script>

<!--create a form to send message -->
<form onsubmit="return sendMessage();">
  <input id="message" placeholder = "Enter message" autocomplete="off">
  <input type="submit">
</form>


<!--create a list -->
<ul id="messages"></ul>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>