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
      <button type="button" onclick="show(main_body)" value='0' id="buttonValue" name="button"><b>Afficher l'emploi du temps</b></button>
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

    <div id="main_body">
      <div class="tab_edt">
        <table>
            <tr><th>Heure/Jour</th><th>Lundi</th><th>Mardi</th><th>Mercredi</th><th>Jeudi</th><th>Vendredi</th></tr>
            <tr><th>8H-9h</th><th class="white_tab"></th><th class="white_tab"> </th><th class="white_tab"> </th><th class="white_tab"></th><th class="white_tab"> </th></tr>
            <tr><th>9h-10h</th><th class="white_tab"></th><th class="white_tab"> </th><th class="white_tab"> </th><th class="white_tab"> </th><th class="white_tab"> </th></tr>
            <tr><th>11h-12h</th><th class="white_tab"></th><th class="white_tab"></th><th class="white_tab"> </th><th class="white_tab"></th><th class="white_tab"> </th></tr>
            <tr><th>Pause</th><th class="white_tab"> </th><th class="white_tab"></th><th class="white_tab"></th><th class="white_tab"> </th><th class="white_tab"></th></tr>
            <tr><th>13h30-14h30</th><th class="white_tab"> </th><th class="white_tab"></th><th class="white_tab"></th><th class="white_tab"> </th><th class="white_tab"> </th></tr>
            <tr><th>14h30-15h30</th><th class="white_tab"> </th><th class="white_tab"> </th><th class="white_tab"> </th><th class="white_tab"></th><th class="white_tab"> </th></tr>
            <tr><th>15h30-16h30</th><th class="white_tab"> </th><th class="white_tab"> </th><th class="white_tab"> </th><th class="white_tab"> </th><th class="white_tab"> </th></tr>
        </table>
      </div>

    </div>
  </body>
  <script type="text/javascript">

    function show(element){
      var Velement="\""+element+"\"";
      var value = document.getElementById("buttonValue").value;
      if(value==0){
        document.getElementById("main_body").style.display="block";
        document.getElementById("buttonValue").value="1";
        document.getElementById("buttonValue").innerHTML="<b>Cacher l'emploi du temps</b>";
    }
    else{
      document.getElementById("main_body").style.display="none";
      document.getElementById("buttonValue").value="0";
      document.getElementById("buttonValue").innerHTML="<b>Afficher l'emploi du temps</b>";


    }
    }
  </script>

</html>
