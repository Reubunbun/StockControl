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

    <title>Login</title>
  </head>

  <body class="login">

    <header>
      <h1>Stock Control</h1>
    </header>

    <main>
      <form name="authUser" action="util/auth.php" method="post" class="form">
        <div>
          <h2>Login:</h2>
          <?php
            if ($message !== "") {
              echo "<p style='color: ".$type."; margin-top: 5px;'>".$message."</p>";
            }
          ?>
        </div>
        <div class="inp">
          <label for="user">Username:</label>
          <input class="textInp" type="text" id="user" name="user" value="" autocomplete="off" onclick="checkInput('user')" />
        </div>
        <div class="inp">
          <label for="pass">Password:</label>
          <input class="textInp" type="password" id="pass" name="pass" value="" autocomplete="off" onclick="checkInput('pass')"/>
        </div>
        <input id="login-btn" class="login-btn" type="submit" value="Login" disabled/>
      </form>
      <h3>Don't have an account? Create one <a href="createAccount.php">here.</a></h3>
    </main>

    <script type="text/javascript" src="js/login.js"></script>

  </body>

</html>
