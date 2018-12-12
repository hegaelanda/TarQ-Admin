$(document).ready(function(){
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyAEqS1Wm6_ttYeRVrlLHiAwO8St9makmDM",
    authDomain: "lkptarq93.firebaseapp.com",
    databaseURL: "https://lkptarq93.firebaseio.com",
    projectId: "lkptarq93",
    storageBucket: "lkptarq93.appspot.com",
    messagingSenderId: "480378806643"
  };
  firebase.initializeApp(config);

	firebase.auth().onAuthStateChanged(user=>{
	  if (user) {
	    // User is signed in.
	    console.log("Sudah Login");
	    /*window.location= "index.php";*/
	  } else {
	    // No user is signed in.
	    console.log("Belum Login");
	  }
	});
});	

function login(){

	var userEmail = document.getElementById("inputEmail").value;
	var userPass = document.getElementById("inputPassword").value;

	firebase.auth().signInWithEmailAndPassword(userEmail, userPass).then(function(user)
	{
		var user = firebase.auth().currentUser;
		var usr = user.uid;
		var database = firebase.database();
		var ref = database.ref('SHAFOOD/USER/ADMIN/'+usr);
		ref.on('value',gotData);
		console.log(usr);

	}).catch(function(error) {

	  var errorCode = error.code;
	  var errorMessage = error.message;

	  window.alert("Failed to login, " + errorMessage);
	});
}

function gotData(data){
	var Uid = data.val();
	if (Uid == null) {
		firebase.auth().signOut().then(function() {
			window.alert("Only Admin Account Allowed");
			location.reload();
		}).catch(function(error) {
			window.alert("ERROR!!");
		});
	}else{
		window.alert("Welcome Admin");
		window.location="index.php";
	}
}