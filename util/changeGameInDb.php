<?php

  require("connection.php");
  require("checkSession.php");

  $gameID = htmlentities( $_GET["id"] );

  if ( isset( $_GET["name"] ) ) {
    $name = htmlentities( $_GET["name"] );

    $sql = "UPDATE Stock
            SET gameName = ?
            WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $name, $gameID);

    if ( !( $stmt->execute() ) ) {
      $_SESSION["status"] = "Something went wrong.¬";
      header("Location: ../index.php");
    }
  }
  if ( isset( $_GET["stock"] ) ) {
    $stock = htmlentities( $_GET["stock"] );

    $sql = "UPDATE Stock
            SET quantity = ?
            WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $stock, $gameID);

    if ( !( $stmt->execute() ) ) {
      $_SESSION["status"] = "Something went wrong.¬";
      header("Location: ../index.php");
    }
  }

  $_SESSION["status"] = "Game has been changed.¬G";
  header("Location: ../index.php");

?>
