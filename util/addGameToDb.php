<?php

  session_start();
  require("connection.php");
  require("checkSession.php");

  if ( isset( $_POST["name"] ) && isset( $_POST["quantity"] ) ) {
    $name = htmlentities( $_POST["name"] );
    $quant = htmlentities( $_POST["quantity"] );

    if ( addGame($conn, $name, $quant) ) {
      $_SESSION["status"] = "Game added¬G";
      header("Location: ../index.php");
    } else {
      $_SESSION["status"] = "Something went wrong.¬B";
      header("Location: ../addGame.php");
    }

  } else {
    $_SESSION["status"] = "Something went wrong.¬B";
    header("Location: ../addGame.php");
  }

  function addGame($conn, $name, $quant) {
    $name = $conn->real_escape_string($name);
    $sql = "INSERT INTO Stock
            VALUES (NULL, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $name, $quant);

    if ( $stmt->execute() ) {
      return TRUE;
    } else {
      return FALSE;
    }

  }

?>
