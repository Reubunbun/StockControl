<?php
  session_start();

  if ( !isset( $_COOKIE["user"] ) && !isset( $_SESSION["user"] ) ) {
    header("Location: login.php");
  } elseif ( !isset( $_SESSION["user"] ) && isset( $_COOKIE["user"] ) ) {
    $_SESSION["user"] = $_COOKIE["user"];
  }

  $pieces   = explode( "¬", $_SESSION["user"] );
  $user     = $pieces[0];
  $id       = $pieces[1];
  $userType = $pieces[2];
  $subPass  = $pieces[3];
?>
