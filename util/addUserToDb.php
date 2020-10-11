<?php
  session_start();

  require('connection.php');

  if ( isset( $_POST["user"] ) && isset( $_POST["pass"] ) && isset( $_POST["confPass"] ) ) {
    $user     = htmlentities( $_POST["user"] );
    $pass     = htmlentities( $_POST["pass"] );
    $confPass = htmlentities( $_POST["confPass"] );

    if ($pass === $confPass) {

      if($conn->connect_error) {
        $_SESSION["status"] = "Connection failed: " . $conn->connect_error."¬B";
        header("Location: ../createAccount.php");
      } else {
        if ( checkUsername($conn, $user) ) {
          addUser($conn, $user, $pass);
        } else {
          $_SESSION["status"] = "Username already exists.¬B";
          header("Location: ../createAccount.php");
        }
      }

    } else {
      $_SESSION["status"] = "Passwords do not match.¬B";
      header("Location: ../createAccount.php");
    }

  } else {
    $_SESSION["status"] = "One of the fields is not set.¬B";
    header("Location: ../createAccount.php");
  }

  function checkUsername($conn, $user) {
    $user = $conn->real_escape_string($user);
    $sql  = "SELECT *
             FROM Users
             WHERE username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
      $stmt->close();
      return TRUE;
    } else {
      return FALSE;
    }
  }

  function addUser($conn, $user, $pass) {
    $user = $conn->real_escape_string($user);
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Users
            VALUES (NULL, ?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $type = "pending";
    $stmt->bind_param("sss", $user, $hashedPassword, $type);

    if ( $stmt->execute() ) {
      $_SESSION["status"] = "Account created.¬G";
      header("Location: ../login.php");
    } else {
      $_SESSION["status"] = "Error: ".$conn->error."¬B";
      header("Location ../createAccount");
    }

  }

?>
