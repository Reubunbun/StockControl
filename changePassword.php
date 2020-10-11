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

    <title> Change Password </title>
  </head>

  <body class="changeDet">

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
          <li><a href="addGame.php"><div><p>Add New Game</p></div></a></li>
          <li class="visiting"><a href="accountSettings.php"><div><p>Account Settings</p></div></a></li>
          <li><a href="util/logout.php"><div><p>Log Out</p></div></a></li>
        </ul>
      </nav>
    </header>

    <main>
      <form name="changePass" action="util/changePassInDb.php" method="post" class="form">
        <div>
          <h2>Change Password:</h2>
          <?php
            if ($message !== "") {
              echo "<p style='color: ".$type."; margin-top: 5px;'>".$message."</p>";
            }
          ?>
        </div>
        <div class="inp">
          <label for="oldPass">Old Password:</label>
          <input class="textInp" type="password" id="oldPass" name="oldPass" onclick="checkOldPass()"/>
        </div>
        <div class="inp">
          <label for="newPass">New Password:</label>
          <input class="textInp" type="password" id="newPass" name="newPass" onclick="checkNewPass()"/>
        </div>
        <div class="inp">
          <label for="confNewPass">Confirm New Password:</label>
          <input class="textInp" type="password" id="confNewPass" name="confNewPass" onclick="checkPassMatch()" />
        </div>
        <div class="btns">
          <input id="change-btn" class="change-btn" type="submit" value="Change" disabled/>
          <a href="accountSettings.php">
            <div><p>Go Back</p></div>
          </a>
        </div>
      </form>
    </main>

    <script type="text/javascript" src="js/changePassword.js"></script>

  </body>

</html>
