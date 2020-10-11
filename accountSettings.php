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

  <body class="accSett">

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
      <?php
        echo "<p style='color: ".$type.";'>".$message."</p>";
      ?>
      <div>
        <h2>Username: <?php echo $user; ?></h2>
        <a href="changeUsername.php">Change Username</a>
      </div>
      <div>
        <h2>Password: <?php echo $subPass."..."; ?></h2>
        <a href="changePassword.php">Change Password</a>
      </div>
      <div>
        <?php echo "<a href='util/deleteUser?ID=".$id."'>Delete Account</a>" ?>
      </div>
    </main>

    <script type="text/javascript" src="js/login.js"></script>

  </body>

</html>
