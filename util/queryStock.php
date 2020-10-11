<?php

  require("connection.php");
  require("checkSession.php");

  if ( isset( $_GET["queryType"] ) ) {
    header("Access-Control-Allow-Origin: *");
    $queryType = htmlentities( $_GET["queryType"] );

    if ($queryType == "loadAll") {
      getAll($conn);
    } elseif ($queryType == "delete") {
      if ( isset( $_GET["id"] ) ) {
        $delID = htmlentities( $_GET["id"] );
        if ( deleteGame($conn, $delID) ) {
          getAll($conn);
        } else {
          $_SESSION["status"] = "Something went wrong.¬B";
          header("Location: ../index.php");
        }
      } else {
        $_SESSION["status"] = "Something went wrong.¬B";
        header("Location: ../index.php");
      }
    } elseif ($queryType == "search") {
      if ( isset( $_GET["id"] ) ) {
        $id = htmlentities( $_GET["id"] );
        searchGame($conn, "", $id);
      } elseif ( isset( $_GET["name"] ) ) {
        $name = htmlentities( $_GET["name"] );
        searchGame($conn, $name, "");
      } else {
        $_SESSION["status"] = "Something went wrong.¬B";
        header("Location: ../index.php");
      }
    }
  } else {
    $_SESSION["status"] = "Something went wrong.¬B";
    header("Location: ../index.php");
  }

  function searchGame($conn, $name, $id) {
    if ($id == "") {
      $sql = "SELECT
                id,
                gameName,
                quantity
              FROM Stock
              WHERE gameName = ?;";
      $bindType = "s";
      $bindParam = $name;
    } else {
      $sql = "SELECT
                id,
                gameName,
                quantity
              FROM Stock
              WHERE id = ?;";
      $bindType = "i";
      $bindParam = $id;
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($bindType, $bindParam);
    $stmt->bind_result($dbID, $dbName, $dbQuant);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
      $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data/>');
      while ( $stmt->fetch() ) {
        $users = $xml->addChild("tableInfo");
        $users->addChild("id", $dbID);
        $users->addChild("GameName", $dbName);
        $users->addChild("Quantity", $dbQuant);
      }
      writeXML($xml);
    }
  }

  function deleteGame($conn, $id) {
    $sql = "DELETE
            FROM Stock
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
              gameName,
              Quantity
            FROM Stock;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_result($dbID, $dbName, $dbQuant);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data/>');
      while ( $stmt->fetch() ) {
        $users = $xml->addChild("tableInfo");
        $users->addChild("id", $dbID);
        $users->addChild("GameName", $dbName);
        $users->addChild("Quantity", $dbQuant);
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
