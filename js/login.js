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
	    console.log("Sudah Login");
	    // window.location= "index.php";
	  } else {
	    // No user is signed in.
	    console.log("Belum Login");
	  }
	});
});	

function login(){
	var userEmail = document.getElementById("inputEmail").value;
	var userPass = document.getElementById("inputPassword").value;

	document.getElementById("load").style.display="block";
	firebase.auth().signInWithEmailAndPassword(userEmail, userPass).then(function(user)
	{
		var user = firebase.auth().currentUser;
		var usr = user.uid;
		var database = firebase.database();
		var ref = database.ref('TARQ/ADMIN/'+usr);
		ref.on('value',gotData);
		console.log(usr);

		document.getElementById("load").style.display="none";
	}).catch(function(error) {

		var errorCode = error.code;
		var errorMessage = error.message;

		window.alert("Failed to login, " + errorMessage);
		document.getElementById("load").style.display="none";
	});
}

function gotData(data){
	var Uid = data.val();
	if (Uid == null) {
		firebase.auth().signOut().then(function() {
			document.getElementById("load").style.display="none";
			window.alert("Only Admin Account Allowed");
			location.reload();
		}).catch(function(error) {
			window.alert("ERROR!!");
		});
	}else{
		console.log(Uid['akses'])
		window.alert("Welcome Admin");
		window.location="load.php?id="+Uid['id']+"&akses="+Uid['akses'];
	}
}