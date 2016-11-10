<?php

function get_db_connection() //Funktion zur Verbindungsherstellung zur DB, zentral (damit schneller was ändern kann wenn Server wechsel etc.)
{
      $db = mysqli_connect('localhost', '874405_3_1', 'jJnDah3HeIW=', '874405_3_1') //Verbindung zu Datenbank wird hergestellt. 4 Wert benötigt: Host, Benutzername, Passwort und Name der DB
      or die('Fehler beim Verbinden mit dem Datenbankserver.'); //Wenn Verbindung nicht hergestellt werden kann, soll es kontrolliert abgebrochen werden.
    mysqli_set_charset($db, "utf8"); //Schaut, dass auch Umlaute genutzt werden lönnen.
    return $db; // Da $db jetzt in Funktion, nur lokal, ausserhalb der Funktion unbekannt! Deshalb möglich, $db nochmals zu nutze
}

function get_result($sql)
{
  $db = get_db_connection();
  //echo $sql; // Wenn was nicht funktioniert, wird der SQL String ausgegeben.
  $result = mysqli_query($db, $sql); // Allgemeingültige Funktion, mit der man an Datenbankverbindung einen beliebigen SQL-String senden kann
  mysqli_close($db);
  return $result;
}


/* **************************************************************************************************
/* Login index.php
/* *********************************************************************************************** */

function login($email, $password) // Der Funktion wird die Variable email und password übergeben,
{
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password';";//Datenbank abfragen, ob es in der und der Tabelle die du die Angaben hat. Mit doppelten Anführungszeichen kann man Variablen einsetzen! Um Variablen braucht es einfache Anführungszeichen, denn nach EIngabe des Users steht dort ja ein Wort/Zahl -> String
    return get_result($sql);
}
// Funktion "login" sendet $sql array an funciton get_result, die holt aus der function get_db_connection die DB Verbindung. dann gibt get_result die Resultate wieder an login.
function register($email, $password)
{
$sql = "INSERT INTO user (email, password) VALUES ('$email', '$password');";
return get_result($sql);
}

?>