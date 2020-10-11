var totalRows = 0;
var selectedRow = null;

if (window.location.pathname == "/StockControl/viewUsers.php") {
  loadTable('util/queryUsers.php?queryType=loadAll');
} else {
  loadTable("util/queryStock.php?queryType=loadAll");
}

function rowHover(row, column1, column2, column3) {
  document.getElementById("btn1").disabled = false;
  document.getElementById("btn2").disabled = false;
  selectedRow = [column1, column2, column3];

  for (let i=0; i<totalRows; i++){
    if (i%2 == 0) {
      document.getElementById( "row" + i.toString() ).style.background = "rgb(138, 138, 255)";
    } else {
      document.getElementById( "row" + i.toString() ).style.background = "rgb(168, 168, 255)";
    }
    document.getElementById( "row" + i.toString() ).style.color = "black";
  }
  document.getElementById("row" + row).style.background = "#004de6";
  document.getElementById("row" + row).style.color = "white";
}

function editGame() {
  window.location.href = "/StockControl/editGame.php?name="+selectedRow[1]+"&quant="+selectedRow[2]+"&id="+selectedRow[0];
}

function deleteRow() {
  if (window.location.pathname == "/StockControl/viewUsers.php") {
    var php = "util/queryUsers.php?queryType=delete&id=" + selectedRow[0];
    console.log(php);
  } else {
    var php = "util/queryStock.php?queryType=delete&id=" + selectedRow[0];
  }
  console.log(php);
  loadTable(php);
}

function changeType() {
  if (document.getElementById("pendingCheck").checked) {
    var type = "pending";
  } else if (document.getElementById("userCheck").checked) {
    var type = "user";
  } else {
    var type = "admin"
  }
  var php = "util/queryUsers.php?queryType=changeType&id=" + selectedRow[0] + "&type=" + type;

  loadTable(php);
}

function searchTable() {
  if (document.getElementById("nameCheck").checked) {
    var searchType = "name";
  } else {
    var searchType = "id";
  }
  var searchVal = document.getElementById("searchInp").value;
  if (window.location.pathname == "/StockControl/viewUsers.php") {
    var table = "Users";
  } else {
    var table = "Stock";
  }

  if (searchVal == "") {
    var php = 'util/query' + table + '.php?queryType=loadAll';
  } else {
    var php = "util/query" + table + ".php?queryType=search&" + searchType + "=" + searchVal;
  }
  loadTable(php);
}

document.getElementById("searchInp").addEventListener("keyup", function() {
  searchTable();
} );

function loadTable(php) {
  console.log(php);
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4) {
      switch (this.status) {
        case 200:
          renderXML(this);
          break;
        case 404:
          var error = this.status + " " + this.statusText;
          document.getElementById("tableMessage").innerHTML = error;
          document.getElementById("table").innerHTML = "";
          break;
        case 500:
          document.getElementById("tableMessage").innerHTML = "Table is empty";
          document.getElementById("table").innerHTML = "";
          break;
      }
    }
  };

  xhttp.open("GET", php, true);
  xhttp.send();
}

function renderXML(data) {
  totalRows = 0;
  selectedRow = null;

  document.getElementById("table").innerHTML = "";
  document.getElementById("tableMessage").innerHTML = "";
  document.getElementById("btn1").disabled = true;
  document.getElementById("btn2").disabled = true;

  if (window.location.pathname == "/StockControl/viewUsers.php") {
    var colName1 = "Username";
    var colName2 = "Type";
  } else {
    var colName1 = "GameName";
    var colName2 = "Quantity";
  }

  var xmlDoc = data.responseXML;

  var output = `
    <tr>
      <th>ID</th>
      <th>` + colName1 + `</th>
      <th>` + colName2 + `</th>
    </tr>
  `;

  var tableInfo = xmlDoc.getElementsByTagName("tableInfo");
  for (let i=0; i<tableInfo.length; i++) {
    var column1 = tableInfo[i].getElementsByTagName("id")[0].childNodes[0].nodeValue;
    var column2 = tableInfo[i].getElementsByTagName(colName1)[0].childNodes[0].nodeValue;
    var column3 = tableInfo[i].getElementsByTagName(colName2)[0].childNodes[0].nodeValue;

    var columnData = `
      <td>` + column1 + `</td>
      <td>` + column2 + `</td>
      <td>` + column3 + `</td>
    `;
    var rowData = `
      <tr onclick='rowHover(` + i.toString() + `,` + column1 + `,"` + column2 + `","` + column3 + `")' id='row` + i.toString() + `'>
        ` + columnData + `
      </tr>
    `;
    totalRows += 1
    output += rowData;
  }

  document.getElementById("table").innerHTML = output;
}
