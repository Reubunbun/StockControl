<?php
  require("connection.php");
  require("checkSession.php");

  if ( isset( $_GET["ID"] ) ) {
    $deleteID = htmlentities( $_GET["ID"] );
    if ( $deleteID == $id ) {
      if ( deleteUser($conn, $deleteID) ) {
        header("Location: logout.php");
      } else {
        $_SESSION["status"] = "Something went wrong.¬B";
        header("Location: ../accountSettings.php");
      }
    } else {
      $_SESSION["status"] = "Something went wrong.¬B";
      header("Location: ../accountSettings.php");
    }

  } else {
    $_SESSION["status"] = "Something went wrong.¬B";
    header("Location: ../accountSettings.php");
  }

  function deleteUser($conn, $id) {
    $sql = "DELETE
            FROM Users
            WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ( $stmt->execute() ) {
      return TRUE;
    } else {
      return FALSE;
    }

  }

?>
