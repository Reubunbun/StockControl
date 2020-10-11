var validName = false;
var validQuant = false;

function checkName() {
  textbox = document.getElementById("name");
  name = textbox.value;
  if (name.length > 0) {
    validName = true;
    textbox.style.borderBottom = "3px solid #80ff80";
  } else {
    validName = false;
    textbox.style.borderBottom = "3px solid #ff6699";
  }
}

function checkQuantity() {
  textbox = document.getElementById("quantity");
  quantity = textbox.value;
  if ( quantity.length > 0 && !isNaN(quantity) ) {
    validQuant = true;
    textbox.style.borderBottom = "3px solid #80ff80";
  } else {
    validQuant = false;
    textbox.style.borderBottom = "3px solid #ff6699";
  }
}

function checkForm() {
  if (validName && validQuant) {
    document.getElementById("add-btn").disabled = false;
  } else {
    document.getElementById("add-btn").disabled = true;
  }
}

document.getElementById("name").addEventListener("keyup", function() {
  checkName();
  checkForm();
} );

document.getElementById("quantity").addEventListener("keyup", function() {
  checkQuantity();
  checkForm();
} );
