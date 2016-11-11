<?php
session_start();
  if(isset($_SESSION['id'])) unset($_SESSION['id']);
  session_destroy();

  require_once('system/data.php'); //Stellt Verbindung zu data.php her, worüber die Verbindung zur DB hergestellt wird.
  require_once('system/security.php');
  $error = false;
  $error_msg = "";
  $success = false;
  $success_msg = "";



// Code für Log-In
  if (isset($_POST['login-submit'])) { // Wenn login-submit ausgefüllt ist (teil von Formular), dann sollen folgende Bedingungen ausgeführt werden. Sonst würde Fehlermeldung bereits beim 1. Mal laden der Site auftauchen.
      if (!empty($_POST['email']) && !empty($_POST['password'])){
      $email = filter_data($_POST['email']);
      $password = filter_data($_POST['password']); //Wenn die Werte "email" und "password" nicht leer sind, werden sie in eine Variable ($email, $password) geschrieben

      $result = login($email, $password, $institut = "IMP"); //Resultat soll aus der Funktion login geholt werden (in data.php)

      $row_count = mysqli_num_rows($result); //Zählt Ergebnisse aus, wenn genau eines ist, dann soll Nutzer weitergeleitet werden können


      if($row_count == 1){ //-> Wenn Überprüfung der Eingaben email/pas}swort genau 1 Ergebnis/ein Treffer in der DB hat, dann kann sich User einloggen
        $user = mysqli_fetch_assoc ($result); //Aus Result wird ein Array gemacht und schreibt das in den User
        session_start(); //Session initalisiert, jeder, der sich anmeldet, bekommt eine Session-ID, die dann gespeichert und bei einer Rückker wieder abgefragt werden kann. SO hat jeder Nutzer eine eigene ID, und kann identifiziert werden.
        $_SESSION['id'] = $user['user_id']; //Zugriff auf user_id aus der DB
        header ("Location: index.php"); //Wenn "email" und "password" stimmen, wird weiter geleitet an home.php
      }else {
        $error = true;
        $error_msg .= "Leider konnten wir ihre Email Adresse oder ihr Passwort nicht finden <br/>";// Wenn etwas falsch ist, erscheint Fehlermeldung
    }
      }else{
      $error = true;
    $error_msg .= "Bitte füllen sie beide Felder aus. <br/>"; //Wenn gar nichts reingeschrieben, erscheint Fehlermeldung
  }
}
 ?>



<!DOCTYPE html>
<html lang="De">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile First-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wissensplatz Login</title>
    <!-- Bootstrap CSS-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Eigenes CSS -->
    <link href="css/main.css" rel="stylesheet">
    <!-- Google Schrift -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic,300italic' rel='stylesheet' type='text/css'>
</head>

<body class="body-index">
<!--http://bootsnipp.com/snippets/featured/google-style-login-extended-with-html5-localstorage -->

<!-- Login-Formular Code -->
<div class="container">
        <div class="card card-container">
            <p id="login-title" class="login-header"> WIP - Wissensplatz</p>
            <p id="login-text" class="login-text">Um sich anmelden zu können,<br>müssen Sie Mitarbeiter am Insititut für Multimedia Production sein.</p>
            <form class="form-signin" action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="HTW E-Mail" required autofocus>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Passwort" required>
                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="einloggen">
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
<!-- Ende Login Code -->










    <!-- jQuery -->
    <script  src="js/jquery.js"></script>
    <!--Bootstrap-->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/dropzone.js"></script>

    <script>
    $( document ).ready(function() {
    // DOM ready

    // Test data
    /*
     * To test the script you should discomment the function
     * testLocalStorageData and refresh the page. The function
     * will load some test data and the loadProfile
     * will do the changes in the UI
     */
    // testLocalStorageData();
    // Load profile if it exits
    loadProfile();
});

/**
 * Function that gets the data of the profile in case
 * thar it has already saved in localstorage. Only the
 * UI will be update in case that all data is available
 *
 * A not existing key in localstorage return null
 *
 */
function getLocalProfile(callback){
    var profileImgSrc      = localStorage.getItem("PROFILE_IMG_SRC");
    var profileName        = localStorage.getItem("PROFILE_NAME");
    var profileReAuthEmail = localStorage.getItem("PROFILE_REAUTH_EMAIL");

    if(profileName !== null
            && profileReAuthEmail !== null
            && profileImgSrc !== null) {
        callback(profileImgSrc, profileName, profileReAuthEmail);
    }
}

/**
 * Main function that load the profile if exists
 * in localstorage
 */
function loadProfile() {
    if(!supportsHTML5Storage()) { return false; }
    // we have to provide to the callback the basic
    // information to set the profile
    getLocalProfile(function(profileImgSrc, profileName, profileReAuthEmail) {
        //changes in the UI
        $("#profile-img").attr("src",profileImgSrc);
        $("#profile-name").html(profileName);
        $("#reauth-email").html(profileReAuthEmail);
        $("#inputEmail").hide();
        $("#remember").hide();
    });
}

/**
 * function that checks if the browser supports HTML5
 * local storage
 *
 * @returns {boolean}
 */
function supportsHTML5Storage() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}

/**
 * Test data. This data will be safe by the web app
 * in the first successful login of a auth user.
 * To Test the scripts, delete the localstorage data
 * and comment this call.
 *
 * @returns {boolean}
 */
function testLocalStorageData() {
    if(!supportsHTML5Storage()) { return false; }
    localStorage.setItem("PROFILE_IMG_SRC", "//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" );
    localStorage.setItem("PROFILE_NAME", "César Izquierdo Tello");
    localStorage.setItem("PROFILE_REAUTH_EMAIL", "oneaccount@gmail.com");
}
</script>



</body>

</html>
