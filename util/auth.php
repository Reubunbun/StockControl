<?php

  session_start();
  require("connection.php");

  if ( isset( $_POST["user"] ) && isset( $_POST["pass"] ) ) {
    $user = htmlentities( $_POST["user"] );
    $pass = htmlentities( $_POST["pass"] );

    if ($conn->connect_error) {
      $_SESSION["status"] = "Connection failed: ".$conn->connect_error."¬B";
      header("Location: ../login.php");
    } else {
      authUser($conn, $user, $pass);
    }
  }

  function authUser($conn, $user, $pass) {
    $sql  = "SELECT *
             FROM Users;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_result($dbID, $dbUser, $dbPass, $dbType);
    $stmt->execute();
    $stmt->store_result();

    $userFound = FALSE; $passMatch = FALSE; $userPend  = FALSE;
    $finUser = ""; $finPass = ""; $finID = ""; $finType = "";

    if ($stmt->num_rows > 0) {
      while ( $stmt->fetch() ) {
        if ($user === $dbUser) {
          $userFound = TRUE;
          if ( password_verify($pass, $dbPass) ) {
            if ($dbType === "pending") {
              $userPend = TRUE;
            }
            if (!$passMatch) {
              $finUser = $dbUser;
              $finPass = $pass;
              $finID   = $dbID;
              $finType = $dbType;
            }
            $passMatch = TRUE;
          }
        }
      }
    }

    if ($userFound && $passMatch && !$userPend) {
      $subPass = substr($finPass, 0, 2);
      $cookie = $finUser."¬".$finID."¬".$finType."¬".$subPass;
      session_unset();
      session_destroy();
      setCookie("user", $cookie, time()+(10*365*24*60*60), "/");
      $_SESSION["user"] = $cookie;
      header("Location: ../index.php");
    } elseif ($userFound && $passMatch && $userPend) {
      $_SESSION["status"] = "Your account is pending approval by an admin.¬B";
      header("Location: ../login.php");
    } elseif ($userFound && !$passMatch) {
      $_SESSION["status"] = "Incorrect password.¬B";
      header("Location: ../login.php");
    } else {
      $_SESSION["status"] = "Username not found¬B";
      header("Location: ../login.php");
    }


  }

?>
