var validOldPass = false;
var validNewPass = false;
var validConfPass = false;

function checkOldPass() {
  textbox = document.getElementById("oldPass");
  oldPass = textbox.value;
  if (oldPass.length > 5 && oldPass.length < 24) {
    textbox.style.borderBottom = "3px solid #80ff80";
    validOldPass = true;
  } else {
    textbox.style.borderBottom = "3px solid #ff6699";
    validOldPass = false;
  }
}

function checkNewPass() {
  textbox = document.getElementById("newPass");
  newPass = textbox.value;
  if (newPass.length > 5 && newPass.length < 24) {
    textbox.style.borderBottom = "3px solid #80ff80";
    validNewPass = true;
  } else {
    textbox.style.borderBottom = "3px solid #ff6699";
    validNewPass = false;
  }
}

function checkPassMatch() {
  var pass = document.getElementById("newPass").value;
  var confPassTextbox = document.getElementById("confNewPass");
  var confPass = confPassTextbox.value;

  if (confPass == pass) {
    validConfPass = true;
    confPassTextbox.style.borderBottom = "3px solid #80ff80";
  } else {
    validConfPass = false;
    confPassTextbox.style.borderBottom = "3px solid #ff6699";
  }
}

function checkForm() {
  if (validOldPass && validNewPass && validConfPass) {
    document.getElementById("change-btn").disabled = false;
  } else {
    document.getElementById("change-btn").disabled = true;
  }
}

document.getElementById("oldPass").addEventListener("keyup", function() {
  checkOldPass();
  checkForm();
} );

document.getElementById("newPass").addEventListener("keyup", function() {
  checkNewPass();
  checkPassMatch();
  checkForm();
} );

document.getElementById("confNewPass").addEventListener("keyup", function() {
  checkPassMatch();
  checkForm();
} );
