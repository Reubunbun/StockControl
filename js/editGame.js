var startName = document.getElementById("name").value;
var startStock = document.getElementById("quantity").value;

var validName = false;
var validStock = false;

function checkName() {
  textbox = document.getElementById("name");
  newName = textbox.value;
  if (newName.length > 0 && newName != startName) {
    textbox.style.borderBottom = "3px solid #80ff80";
    validName = true
  } else {
    textbox.style.borderBottom = "3px solid #ff6699";
    validName = false;
  }
}

function checkStock() {
  textbox = document.getElementById("quantity");
  newStock = textbox.value;
  if (newStock.length > 0 && newStock != startStock && !isNaN(newStock) ) {
    textbox.style.borderBottom = "3px solid #80ff80";
    validStock = true;
  } else {
    textbox.style.borderBottom = "3px solid #ff6699";
    validStock = false;
  }
}

function checkForm(){
  if (validName || validStock) {
    document.getElementById("add-btn").disabled = false;
  } else {
    document.getElementById("add-btn").disabled = true;
  }
}

function makeChange() {
  if (!document.getElementById("add-btn").disabled) {
    var php = "util/changeGameInDb.php?id="+document.querySelector("body").id;
    if (validName) {
      php += "&name="+document.getElementById("name").value;
    }
    if (validStock) {
      php += "&stock="+document.getElementById("quantity").value;
    }
    window.location.href = "/StockControl/"+php;
  }
}

document.getElementById("name").addEventListener("keyup", function() {
  checkName();
  checkForm();
} );

document.getElementById("quantity").addEventListener("keyup", function() {
  checkStock();
  checkForm();
} );
