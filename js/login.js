var validUser = false;
var validPass = false;

function checkInput(inp){
  var textbox  = document.getElementById(inp);
  var value = textbox.value;
  if (value.length > 0) {
    if (inp == "user") {
      validUser = true;
    } else {
      validPass = true;
    }
    textbox.style.borderBottom = "3px solid #80ff80";
  } else {
    if (inp == "user") {
      validUser = false;
    } else {
      validPass = false;
    }
    textbox.style.borderBottom = "3px solid #ff6699";
  }
}

function checkForm() {
  if (validUser && validPass) {
    document.getElementById("login-btn").disabled = false;
  } else {
    document.getElementById("login-btn").disabled = true;
  }
}

document.getElementById("user").addEventListener("keyup", function() {
  checkInput("user");
  checkForm();
} );

document.getElementById("pass").addEventListener("keyup", function() {
  checkInput("pass");
  checkForm();
} );
