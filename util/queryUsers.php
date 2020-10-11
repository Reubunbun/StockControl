<?php

  require("connection.php");
  require("checkSession.php");

  if ($userType != "admin") {
    header("Location: ../index.php");
  } else {
    if ( isset( $_GET["queryType"] ) ) {
      header("Access-Control-Allow-Origin: *");
      $queryType = htmlentities( $_GET["queryType"] );
      if ($queryType == "loadAll") {
        getAll($conn);
      } elseif ($queryType == "delete") {

        if ( isset( $_GET["id"] ) ) {
          $delID = htmlentities( $_GET["id"] );
          if ( deleteUser($conn, $delID) ) {
            getAll($conn);
          } else {
            $_SESSION["status"] = "Something went wrong.¬B";
            header("Location: ../viewUsers.php");
          }
        } else {
          $_SESSION["status"] = "Something went wrong.¬B";
          header("Location: ../viewUsers.php");
        }

      } elseif ($queryType == "changeType") {
          if ( isset( $_GET["id"] ) && isset( $_GET["type"] ) ) {
            $changeID = htmlentities( $_GET["id"] );
            $changeType = htmlentities( $_GET["type"] );
            if ( changeType($conn, $changeID, $changeType) ){
              getAll($conn);
            } else {
              $_SESSION["status"] = "Something went wrong.¬B";
              header("Location: ../viewUsers.php");
            }
          } else {
            $_SESSION["status"] = "Something went wrong.¬B";
            header("Location: ../viewUsers.php");
          }

      } elseif ($queryType == "search") {
        if ( isset( $_GET["id"] ) ) {
          $id = htmlentities( $_GET["id"] );
          searchUser($conn, "", $id);
        } elseif ( isset( $_GET["name"] ) ) {
          $user = htmlentities( $_GET["name"] );
          searchUser($conn, $user, "");
        } else {
          $_SESSION["status"] = "Something went wrong.¬B";
          header("Location: ../viewUsers.php");
        }
      }

    }
  }

  function searchUser($conn, $user, $id){
    if ($id == "") {
      $sql = "SELECT
                id,
                username,
                type
              FROM Users
              WHERE username = ?
              ORDER BY type ASC;";
      $bindType = "s";
      $bindParam = $user;
    } else {
      $sql = "SELECT
                id,
                username,
                type
              FROM Users
              WHERE id = ?
              ORDER BY type ASC;";
      $bindType = "i";
      $bindParam = $id;
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($bindType, $bindParam);
    $stmt->bind_result($dbID, $dbUser, $dbType);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
      $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data/>');
      while ( $stmt->fetch() ) {
        $users = $xml->addChild("tableInfo");
        $users->addChild("id", $dbID);
        $users->addChild("Username", $dbUser);
        $users->addChild("Type", $dbType);
      }
      writeXML($xml);
    }
  }

  function changeType($conn, $id, $type) {
    $sql = "UPDATE Users
            SET type = ?
            WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $type, $id);
    if ( $stmt->execute() ) {
      return TRUE;
    } else {
      return FALSE;
    }
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

  function getAll($conn) {
    $sql = "SELECT
              id,
              username,
              type
            FROM Users
            ORDER BY type ASC;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_result($dbID, $dbUser, $dbType);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data/>');
      while ( $stmt->fetch() ) {
        $users = $xml->addChild("tableInfo");
        $users->addChild("id", $dbID);
        $users->addChild("Username", $dbUser);
        $users->addChild("Type", $dbType);
      }
      writeXML($xml);
    }
  }

  function writeXML($xml) {
    Header("Content-type: text/xml");
    $dom = new DOMDocument();
    $dom->loadXML( $xml->asXML() );
    $dom->formatOutput = true;
    $formattedXML = $dom->saveXML();
    print $formattedXML;
  }


?>
