<?php
  require("connection.php");
  require("checkSession.php");

  if ( isset( $_POST["name"] ) ) {
    $name = htmlentities( $_POST["name"] );

    $sql = "UPDATE Users
            SET username = ?
            WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $name, $id);

    if ( $stmt->execute() ) {
      $pieces = explode( "¬", $_SESSION["user"] );
      $value = $name."¬".$pieces[1]."¬".$pieces[2]."¬".$pieces[3];
      $_SESSION["user"] = $value;
      $_COOKIE["user"] = $value;
      $_SESSION["status"] = "Username has been changed.¬G";
      header("Location: ../accountSettings.php");
    } else {
      $_SESSION["status"] = "Something went wrong.¬B";
      header("Location: ../changeUsername.php");
    }
  } else {
    $_SESSION["status"] = "Something went wrong.¬B";
    header("Location: ../changeUsername.php");
  }

?>
