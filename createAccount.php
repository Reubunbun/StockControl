<!DOCTYPE html>

<?php
  session_start();
  require("util/setStatus.php");
  session_unset();
  session_destroy();
?>

<html>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Reuben Price" />

    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css?version=51" />

    <title>Account Creation</title>
  </head>

  <body class="login">

    <header>
      <h1>Stock Control</h1>
    </header>

    <main>
      <form name="createUser" action="util/addUserToDb.php" method="post" class="form">
        <div>
          <h2>Create Account:</h2>
          <?php
            if ($message !== "") {
              echo "<p style='color: ".$type."; margin-top: 5px;'>".$message."</p>";
            }
          ?>
        </div>
        <div class="inp">
          <label for="user">Username:</label>
          <div id="user-border"></div>
          <input class="textInp" type="text" id="user" name="user" value="" autocomplete="off" onclick="checkUser()" />
        </div>
        <div class="inp">
          <label for="pass">Password:</label>
          <div id="pass-border"></div>
          <input class="textInp" type="password" id="pass" name="pass" value="" autocomplete="off" onclick="checkPass()"/>
        </div>
        <div class="inp">
          <label for="confPass">Confirm Password:</label>
          <div id="pass-border"></div>
          <input class="textInp" type="password" id="confPass" name="confPass" value="" autocomplete="off" onclick="checkPassMatch()"/>
        </div>
        <input id="login-btn" class="login-btn" type="submit" value="Create" disabled/>
      </form>
      <h3>Go back to login <a href="login.php">here.</a></h3>
    </main>

    <script type="text/javascript" src="js/createAccount.js"></script>

  </body>

</html>
