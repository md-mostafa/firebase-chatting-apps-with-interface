 <!--custom css -->
 <link rel='stylesheet' href='mystyle.css';
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
 <!--font awesome-->
 <script src="https://kit.fontawesome.com/b25eb8afbf.js" crossorigin="anonymous"></script>

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
      var message1 = document.getElementById("message1").value;
      //save in database
      firebase.database().ref("messages").push().set({
          "sender": myName,
          "message": message1
      })
      //prevent form from submitting
      return false;
  }

  //listen for incoming messages
  firebase.database().ref("messages").on("child_added", function(snapshot) {
    var html="";
    var htmll = "";
    //give each message a unique ID
    html +="<li id='message-" + snapshot.key + "'>";
      html += snapshot.val().sender + ": " + snapshot.val().message;
    html +="</li>";

    if(snapshot.val().sender==myName){
      htmll +="<div class='d-flex justify-content-end mb-4'>";
        htmll +="<div class='img_cont_msg'>";
        htmll +="</div>";
        htmll +="<div class='msg_cotainer_send'>";
        htmll += snapshot.val().message;
        htmll += "<span class='msg_time'>"+snapshot.val().sender+"</span>";
        htmll += "</div>";
        htmll +="</div>";
    }else{
      htmll +="<div class='d-flex justify-content-start mb-4'>";
        htmll +="<div class='img_cont_msg'>";
        htmll +="</div>";
        htmll +="<div class='msg_cotainer'>";
        htmll += snapshot.val().message;
        htmll += "<span class='msg_time'>"+snapshot.val().sender+"</span>";
        htmll += "</div>";
        htmll +="</div>";
    }
    document.getElementById("messages").innerHTML += html;
    document.getElementById("msg_card_body").innerHTML += htmll;
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
<ul id="messages"></ul>



<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Happy Chatting</span>
								</div>
								<div class="video_cam">
									<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
								</div>
							</div>
						</div>
						<div class="card-body msg_card_body" id="msg_card_body">
							
						</div>
						<div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
								</div>
								<textarea name="" class="form-control type_msg" id="message1" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
									<span class="input-group-text send_btn" onclick="sendMessage();"><i class="fas fa-location-arrow"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>




