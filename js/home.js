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
	    var database = firebase.database();
	    var ref = database.ref('TARQ/ADMIN/'+user.uid);
		ref.on('value',gotData);

	    console.log("Login As "+user.uid);
	  } else {
	    // No user is signed in.
	    console.log("Belum Login");
	    window.location="login.php"
	  }
});
});
function gotData(data){
	var Uid = data.val();
	if (Uid['akses'] == "SUPER") {
	}
}
function logout(){
	// alert('Plis');
	firebase.auth().signOut().then(function() {
  		// Sign-out successful.
   		window.alert("Success");
   		// window.location="login.php"
	}).catch(function(error) {
		// An error happened.
		var errorCode = error.code;
		var errorMessage = error.message;

		window.alert("Failed to logout, " + errorMessage);
	});
}