<?php
  session_start(); //Session starten, oder bereits laufende Session aufrecht halten
  if (!isset($_SESSION['id'])) {
    header('Location: index.php'); //Wenn die vorherige Session nicht läuft, also keine Anmeldedaten eingegeben wurde, wird zurück auf index.php geleitet. Durch eine solche Session kann Seite abgesichert werden!
  }else {
    $user_id = $_SESSION['id'];
  }

  require_once('system/data.php');
  require_once('system/security.php');
  $error = false;
  $error_msg = "";
  $success = false;
  $success_msg = "";


//Code für Hochladen
   if (isset($_POST['upload-submit'])) {
   if (!empty($_POST['titel']) && !empty($_POST['autor']) && !empty($_POST['datum']) && !empty($_POST['themenbereich'])){ // Kontrolliert, ob alle Felder ausgefüllt sind
       $titel = $_POST['titel'];
       $autor = $_POST['autor'];
       $datum = $_POST['datum'];
       $themenbereich = $_POST['themenbereich'];

    if(upload($titel, $autor, $datum, $themenbereich)){ // In einer Zeile Daten an DB schicken und gleichzeitig abfrage starten, ob es kelappt hat
          $success = true;
          $success_msg .= "Sie haben die Publikation erfolgreich hochgeladen <br/>";
      }else {
      $error = true;
        $error_msg .= "Es gibt ein Problem mit der Datenbank. <br/>";
      }
    } /* else {
    $error = true;
    $error_msg .= "Bitte überprüfen Sie ihre Eingaben. <br/>";
  } */
  }

?>

<!DOCTYPE html>
<html lang="De">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile First-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wissensplatz</title>
    <!-- Bootstrap CSS-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Eigenes CSS -->
    <link href="css/main.css" rel="stylesheet">
    <!-- Google Schrift -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic,300italic' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header navbar-static">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">WIP</a>
            </div>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="hochladen.php">Hochladen </a></li>
                    <li><a href="meinepublikationen.php">Meine Publikationen</a></li>
                    <li><a href="publisuchen.php">Nach Publikationen suchen</a></li>
                <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php">Logout</a></li>
                    <!--<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    <a href="#" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-user"></span> User
        </a>-->
                </ul>
            </div>
        </div>
    </nav>

<!-- Hochlade-Formular -->
<h2> Dokument hochladen</h2>
<div class="container-fluid">
       <div class="col-md-3 form-wrapper">
         <form id="upload-form" action="hochladen.php" method="post" role="form">
<div class="form-group">
      <label for="titel">Titel</label>
      <input type="text" name="titel" id="titel" class="form-control" placeholder="Titel">
    </div>
    <div class="form-group">
      <label for="autor">Autor</label>
      <input type="text" name="autor" id="autor" class="form-control" placeholder="Autor">
    </div>
    <div class="form-group">
      <label for="Veröffentlichungsdatum">Veröffentlichungsdatum</label>
      <input type="date" name="datum" id="datum" class="form-control" placeholder="datum">
    </div>
    <label class="select">Themenbereich</label>
               <select class="form-control" name="themenbereich" id="themenbereich">
                   <option>Wirtschaft</option>
                   <option>Medien</option>
                   <option>Drogen</option>
                   <option>Finanzen</option>
                   <option>Soziales</option>
                   <option>Liebe</option>
                   <option>MakeAmericaGreatAgain</option>
             </select>
             <label class="custom-file">
  <input type="file" name="file" id="file" class="custom-file-input">
  <span class="custom-file-control"></span>
</label>
<input type="submit" name="upload-submit" id="upload-submit" class="form-control btn btn-register" value="Hochladen" tabindex="4">
<!-- <button type="submit" name="upload-submit" id="upload-submit" class="btn btn-default">
                        <span>Hochladen</span>
                    </button> -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!--Bootsrtap-->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
