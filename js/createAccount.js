var validUser = false;
var validPass = false;
var validConfPass = false;

function checkUser() {
  var textbox = document.getElementById("user");
  var username = textbox.value;
  if (username.length > 0 && username.length < 24) {
    validUser = true;
    textbox.style.borderBottom = "3px solid #80ff80";
  } else {
    validUser = false;
    textbox.style.borderBottom = "3px solid #ff6699";
  }
}

function checkPass() {
  var textbox = document.getElementById("pass");
  var password = textbox.value;
  if (password.length > 5 && password.length < 24) {
    validPass = true;
    textbox.style.borderBottom = "3px solid #80ff80";
  } else {
    validPass = false;
    textbox.style.borderBottom = "3px solid #ff6699";
  }
}

function checkPassMatch() {
  var pass = document.getElementById("pass").value;
  var confPassTextbox = document.getElementById("confPass");
  var confPass = confPassTextbox.value;

  if (confPass == pass) {
    validConfPass = true;
    confPassTextbox.style.borderBottom = "3px solid #80ff80";
  } else {
    validConfPass = false;
    confPassTextbox.style.borderBottom = "3px solid #ff6699";
  }
  console.log("checking pass match "  + validConfPass);
}

function checkForm() {
  if (validUser && validPass && validConfPass) {
    document.getElementById("login-btn").disabled = false;
  } else {
    document.getElementById("login-btn").disabled = true;
  }
}

document.getElementById("user").addEventListener("keyup", function() {
  checkUser();
  checkForm();
} );

document.getElementById("pass").addEventListener("keyup", function() {
  checkPass();
  checkPassMatch();
  checkForm();
} );

document.getElementById("confPass").addEventListener("keyup", function() {
  checkPass();
  checkPassMatch();
  checkForm();
} );
