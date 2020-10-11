<?php

  require("connection.php");
  require("checkSession.php");

  if ( isset( $_POST["oldPass"] ) && isset( $_POST["newPass"] ) && isset( $_POST["confNewPass"] ) ) {
    $oldPass = htmlentities( $_POST["oldPass"] );
    $newPass = htmlentities( $_POST["newPass"] );
    $confNewPass = htmlentities( $_POST["confNewPass"] );
    if ($newPass === $confNewPass) {
      if ($conn->connect_error) {
        $_SESSION["status"] = "Connection failed: ".$conn->connect_error."¬B";
        header("Location: ../changePassword.php");
      } else {

        if ( authUser($conn, $id, $oldPass) ) {

          if ( changePassword($conn, $id, $newPass) ) {
            $_SESSION["status"] = "Password changed.¬G";
            $subPass = substr($pass, 0, 2);
            $pieces = explode( "¬", $_SESSION["user"] );
            $value = $pieces[0]."¬".$pieces[1]."¬".$pieces[2]."¬".$subPass;
            $_SESSION["user"] = $value;
            $_COOKIE["user"] = $value;
            header("Location: ../accountSettings");
          } else {
            $_SESSION["status"] = "Something went wrong.¬B";
            header("Location: ../changePassword.php");
          }

        } else {
          $_SESSION["status"] = "Old password incorrect.¬B";
          header("Location: ../changePassword.php");
        }

      }

    } else {
      $_SESSION["status"] = "Passwords do not match.¬B";
      header("Location: ../changePassword.php");
    }

  } else {
    $_SESSION["status"] = "One of the fields is not set.¬B";
    header("Location: ../changePassword.php");
  }

  function authUser($conn, $id, $pass) {
    $sql = "SELECT password
            FROM Users
            WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->bind_result($dbPass);
    $stmt->execute();

    while ( $stmt->fetch() ) {
      if ( password_verify($pass, $dbPass) ) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
  }

  function changePassword($conn, $id, $pass) {
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "UPDATE Users
            SET password = ?
            WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $hashedPass, $id);

    if ( $stmt->execute() ) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

?>
