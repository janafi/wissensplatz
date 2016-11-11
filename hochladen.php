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
                <a class="navbar-brand" href="index.html">WIP</a>
            </div>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="hochladen.php">Hochladen </a></li>
                    <li><a href="meinepublikationen.php">Meine Publikationen</a></li>
                    <li><a href="publisuchen.php">Nach Publikationen suchen</a></li>
                    <!--<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    <a href="#" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-user"></span> User
        </a>-->
                </ul>
            </div>
        </div>
    </nav>
<h2> Dokument hochladen</h2>
<div class="container-fluid">
       <div class="col-md-3 form-wrapper">
<div class="form-group">
      <label for="title">Titel</label>
      <input type="text" class="form-control" id="title" placeholder="Titel">
    </div>
    <div class="form-group">
      <label for="autor">Autor</label>
      <input type="text" class="form-control" id="autor" placeholder="Autor">
    </div>
    <div class="form-group">
      <label for="Veröffentlichungsdatum">Veröffentlichungsdatum</label>
      <input type="date" class="form-control" id="datum" placeholder="datum">
    </div>
    <label class="select">Themenbereich</label>
               <select class="form-control" name="themenbereich">
                   <option>Wirtschaft</option>
                   <option>Medien</option>
                   <option>Drogen</option>
                   <option>Finanzen</option>
                   <option>Soziales</option>
                   <option>Liebe</option>
                   <option>MakeAmericaGreatAgain</option>
             </select>
             <label class="custom-file">
  <input type="file" id="file" class="custom-file-input">
  <span class="custom-file-control"></span>
</label>
<button class="btn btn-default" type="submit">
                        <span>Hochladen</span>
                    </button>



    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!--Bootsrtap-->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
