<?php

  $red = "#ff3333";
  $green = "#4dff4d";

  if ( isset( $_SESSION["status"] ) ) {
    $pieces  = explode( "¬", $_SESSION["status"] );
    $message = $pieces[0];
    $type    = ( $pieces[1] === 'B' ) ? $red : $green;
  } else {
    $message = "";
    $type    = "";
  }

?>
