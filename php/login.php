<?php
$user = "noituat";
$pass = "xebvekul1997";

session_start();

if (isset($_POST['logged_in']) && $_POST['logged_in']== true){
  header('Location: /index.php');
  alert("Changement de page 1");
}

try {
    $dbh = new PDO('mysql:host=localhost;dbname=atelier_numerique', $user, $pass);
} catch (PDOException $e) {
    die();
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Atelier Numérique</title>
    <link rel="stylesheet" media="all and (min-device-width: 1080px) and (orientation: landscape)" href="css/main.css" />
    <link rel="stylesheet" media="all and (min-device-width: 424px) and (orientation: portrait)" href="css/handheld.css" />

  </head>
  <body>
    <div class="header">
      <div class="head">
        <h1 onclick="accueil();" id="titre">Atelier Numérique - Accueil</h1>
      </div>
      <div id="gauche" class="dropdown">
        <button class="dropbtn"><b>Navigation</button>
          <div class="dropdown-content">


            <?php
              if(isset($_SESSION) && !empty($_SESSION)){
                  echo "<a href=\"materiel.php\">Matériel disponible</a>";
                  echo "<a href=\"allocation.php\">Allouer du matériel</a>";
                  echo "<a href=\"signalement.php\">Consulter les signalements</a>";
                  echo "<a href=\"reglement.php\">Règlement de la salle</a>";
                  echo "<a href=\"tutoriels.php\">Tutoriels</a>";
              }
              else{
                  echo "<a href=\"signalement.php\">Signaler un problème</a>";
                  echo "<a href=\"reglement.php\">Règlement de la salle</a>";
                  echo "<a href=\"tutoriels.php\">Tutoriels</a>";

              }
             ?>
          </div>

      </div>
    </div>
    <div class="main_login">
      <form action="/login.php" method="post" id="login" autocomplete="off">
        <input id="in1" type="text"  placeholder="Identifiant" name="pseudo">
        <input id="in2" type="password"  placeholder="Mot de passe" name="password">
      </form>
      <button id="login_button" form="login">Connexion</button>

      <button  id="login_button" onclick="inscription();">Inscription</button>



      <h1 style="display:none;"id="connexion"></h1>

      <?php
        if(isset($_POST["pseudo"]) && isset($_POST["password"])){
          $request = "SELECT hashedPassword FROM an_users WHERE username=\"".$_POST["pseudo"]."\";";
          $hashedPassword = $dbh->query($request, PDO::FETCH_ASSOC);
          $result=$hashedPassword->fetch();

          if(md5($_POST["password"]) == $result["hashedPassword"]){
            $pseudo = $_POST["pseudo"];
            $password = $_POST["password"];
            $request = "SELECT nom, prenom, isAdmin FROM an_users WHERE username=\"".$_POST["pseudo"]."\";";
            $result = $dbh->query($request, PDO::FETCH_ASSOC);
            $result=$result->fetch();
            echo "<script>\ndocument.location.href=\"index.php\";\n</script>";
            $_SESSION["nom"]=$result["nom"];
            $_SESSION["prenom"]=$result["prenom"];
            $_SESSION["var"]=$result["isAdmin"];
            $_SESSION["logged_in"]= true;
          }
          else{
            echo "<script>\n document.getElementById('connexion').style.display=\"block\";\n</script>\n";
            echo "<script>\n document.getElementById('connexion').innerHTML=\"Mot de passe erroné !\";\n</script>\n";
          }
        }




      ?>
    </div>
    <script>
      function accueil(){
        document.location="index.php";
      }
      function inscription(){
        document.location="inscription.php";
      }
    </script>
    </body>
</html>
