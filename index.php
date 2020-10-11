<?php
  require("util/checkSession.php");
  require("util/setStatus.php");
?>

<!DOCTYPE html>

<html>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Reuben Price" />

    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css?version=51" />

    <title> Home </title>
  </head>

  <body class="tableView">

    <header class="mainNav">
      <nav>
        <ul>
          <li><h1>Stock Control</h1></li>
          <li class="visiting"><a href="index.php"><div><p>View/Edit Stocks</p></div></a></li>
          <?php
            if ($userType === "admin") {
              echo "<li><a href='viewUsers.php'><div><p>View Users</p></div></a></li>";
            }
          ?>
          <li><a href="addGame.php"><div><p>Add New Game</p></div></a></li>
          <li><a href="accountSettings.php"><div><p>Account Settings</p></div></a></li>
          <li><a href="util/logout.php"><div><p>Log Out</p></div></a></li>
        </ul>
      </nav>
    </header>

    <main>
      <section class="editContainer">
        <div>
          <h1>Current Stock</h1>
        </div>
        <div class="search">
          <label for="query">Search by: </label>
          <input type="radio" name="queryType" checked="checked" id="nameCheck" /><span> Name</span>
          <input type="radio" name="queryType" id="IDCheck" /><span> ID</span>
        </div>
        <div>
          <input class="textInp" type="text" name="query" id="searchInp" />
        </div>
        <div>
          <input type="submit" value="Change Selected" disabled="disabled" id="btn1" onclick="editGame()" />
          <input type="submit" value="Delete Selected"  disabled="disabled" id="btn2" onclick="deleteRow()" />
        </div>
      </section>
      <section class="tableContainer">
        <h2 id="tableMessage"></h2>
        <div>
          <table id="table">
          </table>
        </div>
      </section>
    </main>

    <script type="text/javascript" src="js/table.js"></script>
  </body>

</html>
