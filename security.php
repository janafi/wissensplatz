<?php
  require_once('data.php');
  function filter_data($input)
{
  $db = get_db_connection(); // DB Verbindung wird erzeugt

  $input = strip_tags($input); // Zeichen wwie <> in den Inputfelder werden mit \ getrennt, so list das System z.B. ein <div> Tag nicht als Tag, sondern als einzelne Zeichen \<div\>
  $input = trim($input); // Am Anfang und am Ende der eingegebenen Zeichen werden die Leerzeichen zu Beginn und am Ende gelöscht (um SQL zu hacken, braucht es zu Beginn des Codes ein Leerzeichen)
  $input = mysqli_real_escape_string($db, $input); // Braucht Parameter DB Verbindung. DB filtert aus input String alle DB Befehle, denn diese Inputs sollten dies nicht enthalten.

mysqli_close($db);
  return $input;
}
 ?>
