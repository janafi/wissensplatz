<?php
  session_start(); //Session starten, oder bereits laufende Session aufrecht halten
  if (!isset($_SESSION['id'])) {
    header('Location: index.php'); //Wenn die vorherige Session nicht läuft, also keine Anmeldedaten eingegeben wurde, wird zurück auf index.php geleitet. Durch eine solche Session kann Seite abgesichert werden!
  }else {
    $user_id = $_SESSION['id'];
  }

  require_once('system/data.php');
  require_once('system/security.php');


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

    <!--Tabelle "Meine Publikationen"-->
    <?php
    echo "<div class='container'>";
    echo "<h2>Meine Publikationen</h2>";
  echo "<table class='table'>";
    echo  "<thead>";
      echo  "<tr>";
      echo "<th>Titel</th>";
        echo "<th>Autor</th>";
      echo "<th>Themenbereich</th>";

      echo "<th> <p><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></p></th>";
      echo  "</tr>";
    echo "</thead>";
    echo  "<tbody>";
       while($post = mysqli_fetch_assoc($post_list)) {

      echo "<tr>";
        echo "<td>", $post['titel'], "</td>";
        echo "<td>", $post['autor'], "</td>";
        echo "<td>", $post['themenbereich'], "</td>";
      echo "</tr>";
    }
  echo  "</tbody>";
echo "</table>";
echo  "</div>";
    ?>

         <!-- Beitrag -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!--Bootsrtap-->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
