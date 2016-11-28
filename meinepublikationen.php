<?php
  session_start(); //Session starten, oder bereits laufende Session aufrecht halten
  if (!isset($_SESSION['id'])) {
    header('Location: index.php'); //Wenn die vorherige Session nicht läuft, also keine Anmeldedaten eingegeben wurde, wird zurück auf index.php geleitet. Durch eine solche Session kann Seite abgesichert werden!
  }else {
    $user_id = $_SESSION['id'];
  }

  require_once('system/data.php');
  require_once('system/security.php');

  if(isset($_POST['loeschen'])){ /*Funktion um Zeile zu löschen*/
	$loesch_id = $_POST['pub_id']; /*Wert (Publikations_id) von entsprechender Zeile wird der Funktion loesch_publikation übergeben*/
  loesch_publikation ($loesch_id);
	}

// Meine Publikationen anzeigen

  $post_list = get_posts($user_id);

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
                </ul>
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

    <div class='container'>
    <h2>Meine Publikationen</h2>
    <table class='table'>
    <thead>
      <tr>
      <th>Titel</th>
        <th>Autor</th>
      <th>Themenbereich</th>
      <th class='publikations_id_spalte'>Publikations ID</th>
      <th>Bearbeiten</th>
      <th><span class='glyphicon glyphicon-trash'></span></th>
      </tr>
    </thead>
    <tbody>
    <!--Tabelle "Meine Publikationen"-->
    <?php
       while($post = mysqli_fetch_assoc($post_list)) {
    ?>
      <tr>
        <td><?php echo $post['titel'] ?></td>
        <td><?php echo $post['autor'] ?></td>
        <td><?php echo $post['themenbereich'] ?></td>
        <td class= 'publikations_id_spalte'><?php echo $post['publikations_id'] ?></td>
        <td>
          <button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModalBearbeiten'>
            <span class='glyphicon glyphicon-pencil'></span>
          </button>
            <div class='modal fade' id='myModalBearbeiten' role='dialog'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data='modal'>&times;</button>
                    <h4 class='modal-title'>Publikation Bearbeiten</h4>
                  </div>
                  <div class='modal-body-bearbeiten'>
                    <p>Bearbeiten</p>
                  </div>
                  <div class='modal-footer'>
                      <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> <!-- Formular, damit es möglich ist, die Seite nochmals zu laden nach dem Bearbeiten-->
                      <input type="hidden" name="pub_id" value="<?php echo $post['publikations_id'] ?>"> <!-- Die Publikations_id wird versteckt weitergegeben-->

                      <div class="container-fluid">
                       <div class="form-wrapper">
                         <form id="upload-form" action="hochladen.php" method="post" role="form">
                           <div class="form-group">
                            <label for="titel">Titel</label>
                            <input type="text" name="titel" id="titel" class="form-control" value="<?php echo $post['titel']?>">
                          </div>
                          <div class="form-group">
                            <label for="autor">Autor</label>
                            <input type="text" name="autor" id="autor" class="form-control" value="<?php echo $post['autor']?>">
                          </div>
                          <div class="form-group">
                            <label for="Veröffentlichungsdatum">Veröffentlichungsdatum</label>
                            <input type="date" name="datum" id="datum" class="form-control" value="<?php echo $post['datum']?>">
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

                      <button type='button' class='btn btn-default' data-dismiss='modal'>Abbrechen</button>
                      <button type='submit' name='speichern' class='btn btn-default'>Speichern</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td>
<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModalLoeschen'>
<span class='glyphicon glyphicon-remove'></span></button>
<div class='modal fade' id='myModalLoeschen' role='dialog'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
  <button type='button' class='close' data-dismiss='modal'>&times;</button>
  <h4 class='modal-title'>Halt Stopp!</h4>
</div>
<div class='modal-body-löschen'>
  <p>Sind Sie sicher, dass Sie diese Publikation für IMMER löschen möchten?</p>
</div>
<div class='modal-footer'>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> <!-- Formular, damit die Seite nochmals geladen wird beim Löschen-->
    <input type="hidden" name="pub_id" value="<?php echo $post['publikations_id'] ?>"> <!-- Die Publikations_id wird versteckt weitergegeben-->

    <button type='button' class='btn btn-default' data-dismiss='modal'>Abbrechen</button>
    <button type='submit' name='loeschen' class='btn btn-default'>Löschen</button>
  </form>
</div>
</div>
</div> </td>
      </tr>
<?php    } ?> <!-- Ende der While Schlaufe -->
  </tbody>
</table>
</div>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!--Bootsrtap-->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
