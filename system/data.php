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
  echo $sql; // Wenn was nicht funktioniert, wird der SQL String ausgegeben.
  $result = mysqli_query($db, $sql); // Allgemeingültige Funktion, mit der man an Datenbankverbindung einen beliebigen SQL-String senden kann
  mysqli_close($db);
  return $result;
}


/* **************************************************************************************************
/* Login index.php
/* *********************************************************************************************** */

function login($email, $password, $institut = "IMP") // Der Funktion wird die Variable email und password übergeben, zudem muss in der Spalte "institut" der Wert IMP stehen
{
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password' AND institut = '$institut';";//Datenbank abfragen, ob es in der und der Tabelle die du die Angaben hat. Mit doppelten Anführungszeichen kann man Variablen einsetzen! Um Variablen braucht es einfache Anführungszeichen, denn nach EIngabe des Users steht dort ja ein Wort/Zahl -> String
    return get_result($sql);
}

/* **************************************************************************************************
/* Publikationen anzeigen meinepublikationen.php
/* *********************************************************************************************** */

function get_posts($user_id)
{
    $sql = "SELECT autor, titel, themenbereich, publikations_id FROM publikationen /* , themenbereich */ WHERE user_id = $user_id /*
            AND publikationen.themenbereich_id = themenbereich.themenbereich_id*/;";
    return get_result($sql);
  }


  /* **************************************************************************************************
  /* Publikation hochladen auf hochladen.php
  /* *********************************************************************************************** */

  function upload($titel, $autor, $datum, $themenbereich)
  {
  $sql = "INSERT INTO publikationen (titel, autor, datum, themenbereich, user_id) VALUES ('$titel', '$autor', '$datum', '$themenbereich');";
  return get_result($sql);

}

/* **************************************************************************************************
/* Publikation löschen auf meinepublikationen.php
/* *********************************************************************************************** */


?>
