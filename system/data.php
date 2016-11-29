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
$sql = "SELECT * FROM publikationen /* , themenbereich / */ WHERE user_id = $user_id;";
return get_result($sql);
}


/* **************************************************************************************************
/* Publikationen anzeigen publisuchen.php - Alle Publikationen
/* *********************************************************************************************** */

function get_all_posts($user_id)
{
    $sql = "SELECT * FROM publikationen;";
    return get_result($sql);
  }


  /* **************************************************************************************************
  /* Publikation hochladen auf hochladen.php
  /* *********************************************************************************************** */

  /*
  * Create a random string
  * @author	XEWeb <>
  * @param $length the length of the string to create
  * @return $str the string
  * https://www.xeweb.net/2011/02/11/generate-a-random-string-a-z-0-9-in-php/
  */
  function randomString($length = 8) {
    $str = "";
    $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
    	$rand = mt_rand(0, $max);
    	$str .= $characters[$rand];
    }
    return $str;
  }

  function upload($titel, $autor, $datum, $themenbereich, $user_id, $pdf)
  {
  $sql = "INSERT INTO publikationen (titel, autor, datum, themenbereich, user_id, pdf) VALUES ('$titel', '$autor', '$datum', '$themenbereich', '$user_id', '$pdf');";
  return get_result($sql);
}

  function upload_file($pdf_file){

     $uploadOk = true;
   	$upload_path = "pdf/";   // Zielverzeichnis für hochzuladene Datei
     $max_file_size = 5000000;      // max. Dateigrösse in KB

     // Filetype kontrollieren
   	if ( ($pdf_file['name']  != "")){
   		$filetype = $pdf_file['type'];
   		switch($filetype){
   			case "application/pdf":
   				$file_extension = "pdf";
   		}
   		// Dateigrösse kontrollieren
   		$upload_filesize = $pdf_file["size"];
       if ( $upload_filesize > $max_file_size) {
         echo "Leider ist die Datei mit $upload_filesize KB zu gross. <br> Sie darf nicht grösser als $max_file_size sein. ";
         $uploadOk = 0;
       }

       if ($uploadOk == 0) {
         echo "Leider konnte die Datei nicht hochgeladen werden.";
       } else {
         $pdf_name = time() . randomString() . "." . $file_extension;
         move_uploaded_file ( $pdf_file['tmp_name'] , $upload_path . $pdf_name );
   	  }
   	}

   	return $pdf_name;

}

/* **************************************************************************************************
/* Publikation löschen auf meinepublikationen.php
/* *********************************************************************************************** */

 function loesch_publikation($publikations_id){ /*Publikations_id der angeklickten Zeile wird der Funktion übergeben*/
   $sql = "DELETE FROM publikationen WHERE publikations_id = $publikations_id ;"; /*jener Zeile mit der entsprechenden Zahl in Publikations_id wird gelöscht*/
  return get_result($sql);
 }

 /* **************************************************************************************************
 /* Publikationen anzeigen meinepublikationen.php
 /* *********************************************************************************************** */

 function edit($titel, $autor, $datum, $themenbereich)
 {
$sql = "UPDATE publikationen SET titel = '$titel', autor = '$autor', datum = '$datum', themenbereich = '$themenbereich';";
return get_result($sql);
 }


/*   function upload($titel, $autor, $datum, $themenbereich, $user_id, $pdf)
   {
   $sql = "INSERT INTO publikationen (titel, autor, datum, themenbereich, user_id, pdf) VALUES ('$titel', '$autor', '$datum', '$themenbereich', '$user_id', '$pdf');";
   return get_result($sql);
 }
*/




?>
