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

	firebase.auth().onAuthStateChanged(user => {
	  if (user) {
	    // User is signed in.
	    console.log("Login As "+user.uid);
	  } else {
	    // No user is signed in.
	    console.log("Belum Login");
	    window.location="login.php";
	  }
	});
});
function logout(){
	firebase.auth().signOut().then(function() {
  		// Sign-out successful.
  		window.alert("Success");
	}).catch(function(error) {
		// An error happened.
		var errorCode = error.code;
		var errorMessage = error.message;

		window.alert("Failed to logout, " + errorMessage);
	});
}