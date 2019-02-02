<?php
  session_start();
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
        <h1 onclick="accueil();" id="titre">Atelier Numérique - Accueil</h1>
      </div>
      <div class="dropdown">
        <button class="dropbtn"><b>Navigation</b></button>
        <div class="dropdown-content">
          <?php
            if(isset($_SESSION) && !empty($_SESSION)){
                echo "<a href=\"signalement.php\"><b>Consulter les signalements</b></a>";
                echo "<a href=\"reglement.php\"><b>Règlement de la salle</b></a>";
                echo "<a href=\"tutoriels.php\"><b>Tutoriels</b></a>";
                echo "<a href=\"materiel.php\"><b>Matériel disponible</b></a>";
                echo "<a href=\"allocation.php\"><b>Allouer du matériel</b></a>";
                echo "<a href=\"compte.php\"><b>Modifier votre compte</b></a>";
            }
            else{
                echo "<a href=\"signalement.php\"><b>Signaler un problème</b></a>";
                echo "<a href=\"reglement.php\"><b>Règlement de la salle</b></a>";
                echo "<a href=\"tutoriels.php\"><b>Tutoriels</b></a>";
            }
           ?>
        </div>
      </div>
      <div class="login_area">
        <?php
          if(!isset($_SESSION['logged_in'])){
            echo "<a class=\"login_a\" href=\"login.php\"><b>Connexion / Inscription</a>";
          }
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']== true){
          echo "<script>\n\t\t\tdocument.getElementById(\"titre\").innerHTML=\"".$_SESSION["prenom"]." ".$_SESSION["nom"]." - Accueil"."\";\n\t\t</script>\n";
            echo "\t\t<a class=\"login_a\" href=\"deconnecter.php\"><b>Me déconnecter</a>\n";
          }
         ?>
    </div>
  </body>
  <script>
    function accueil(){
      document.location="index.php";
    }
  </script>
</html>
