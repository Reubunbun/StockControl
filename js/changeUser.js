var startUsername = document.getElementById("name").value;

function checkUser() {
  textbox = document.getElementById("name");
  newUsername = textbox.value;
  if ( newUsername.length > 0 && newUsername != startUsername ) {
    textbox.style.borderBottom = "3px solid #80ff80";
    document.getElementById("change-btn").disabled = false;
  } else {
    textbox.style.borderBottom = "3px solid #ff6699";
    document.getElementById("change-btn").disabled = true;
  }
}

document.getElementById("name").addEventListener("keyup", function(){
  checkUser();
});
