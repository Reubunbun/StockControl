<!DOCTYPE html>

<?php
  require("util/checkSession.php");
  require("util/setStatus.php");

  $gameName = htmlentities( $_GET["name"] );
  $gameQuant = htmlentities( $_GET["quant"] );
  $gameID = htmlentities( $_GET["id"] );
?>

<html>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Reuben Price" />

    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css?version=51" />

    <title>Edit Game</title>
  </head>

  <body class="add-EditGame" <?php echo "id='".$gameID."'"; ?> >

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
      <div class="form">
        <h2>Edit Game:</h2>
        <div class="inp">
          <label for="name">New Name:</label>
          <input class="textInp" type="text" id="name" name="name" <?php echo "value='$gameName'"; ?> />
        </div>
        <div class="inp">
          <label for="quantity" >New Stock:</label>
          <input class="textInp" type="text" id="quantity" name="quantity" <?php echo "value='$gameQuant'"; ?>/>
        </div>
        <input id="add-btn" class="add-btn" type="submit" value="Make Changes" disabled onclick="makeChange()"/>
      </div>
    </main>

    <script type="text/javascript" src="js/editGame.js"></script>

  </body>

</html>
