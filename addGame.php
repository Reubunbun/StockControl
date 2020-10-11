<!DOCTYPE html>

<?php
  require("util/checkSession.php");
  require("util/setStatus.php");
?>

<html>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Reuben Price" />

    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css?version=51" />

    <title> Add Game </title>
  </head>

  <body class="add-EditGame">

    <header class="mainNav">
      <nav>
        <ul>
          <li><h1>Stock Control</h1></li>
          <li><a href="index.php"><div><p>View/Edit Stocks</p></div></a></li>
          <?php
            if ($userType === "admin") {
              echo "<li><a href='viewUsers.php'><div><p>View Users</p></div></a></li>";
            }
          ?>
          <li class="visiting"><a href="addGame.php"><div><p>Add New Game</p></div></a></li>
          <li><a href="accountSettings.php"><div><p>Account Settings</p></div></a></li>
          <li><a href="util/logout.php"><div><p>Log Out</p></div></a></li>
        </ul>
      </nav>
    </header>

    <main>
      <form class="form" action="util/addGameToDb.php" method="post">
        <h2>Add Game:</h2>
        <div class="inp">
          <label for="name">Game Name:</label>
          <input class="textInp" type="text" id="name" name="name" onclick="checkName();" />
        </div>
        <div class="inp">
          <label for="quantity">Stock Quantity:</label>
          <input class="textInp" type="text" id="quantity" name="quantity" onclick="checkQuantity();" />
        </div>
        <input id="add-btn" class="add-btn" type="submit" value="Add Game" disabled/>
      </form>
    </main>

    <script type="text/javascript" src="js/addGame.js"></script>

  </body>

</html>
