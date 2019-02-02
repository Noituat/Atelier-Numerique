<?php
$user = "noituat";
$pass = "xebvekul1997";

session_start();

if (isset($_POST['logged_in']) && $_POST['logged_in']== true){
  header('Location: /index.php');
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
      <button class="return_btn" onclick="login();"><b>Retour</button>
        <div class="message">
          <h1 class="message" id="login_h1"></h1>

        </div>

      </div>
      <div class="main_login">
        <form action="" method="post" id="inscription" autocomplete="off">
          <input class="in" id="pseudo" type="text"  placeholder="Identifiant" name="pseudo" value="">
          <input class="in" id="password" type="password"  placeholder="Mot de passe" name="password" value="">
          <input class="in" id="password2" type="password"  placeholder="Retapez le mot de passe" name="password2" value="">
          <input class="in" id="prenom" type="text"  placeholder="Prénom" name="prenom" value="">
          <input class="in" id="nom" type="text"  placeholder="Nom" name="nom" value="">
          <input class="in" id="email" type="email"  placeholder="Email" name="email" value="">
        </form>
        <button id="registering_button" form="inscription">M'inscrire</button>


        <?php

        $tabForm = array("pseudo","password","password2", "prenom", "nom", "email");
        if(isset($_POST) && !empty($_POST)){
          for ($i=0;$i<count($tabForm);$i++){
            if(empty($_POST[$tabForm[$i]])){
              echo "<script>\n document.getElementById('".$tabForm[$i]."').style.border=\"solid 4px #E70739\";\n</script>\n";
              echo "<script>\n document.getElementById('login_h1').style.display=\"block\";\n</script>\n";
              echo "<script>\n document.getElementById('login_h1').innerHTML=\"Vous n'avez pas renseigné les champs suivants !\";\n</script>\n";
            }
            else{
              switch ($i) {
                case '0':
                  echo "<script>\n document.getElementById('".$tabForm[$i]."').value=\"".$_POST["pseudo"]."\";\n</script>\n";
                  break;
                case '1':
                  echo "<script>\n document.getElementById('".$tabForm[$i]."').value=\"".$_POST["password"]."\";\n</script>\n";
                  break;
                case '2':
                  echo "<script>\n document.getElementById('".$tabForm[$i]."').value=\"".$_POST["password2"]."\";\n</script>\n";
                  break;
                case '3':
                  echo "<script>\n document.getElementById('".$tabForm[$i]."').value=\"".$_POST["prenom"]."\";\n</script>\n";
                  break;
                case '4':
                  echo "<script>\n document.getElementById('".$tabForm[$i]."').value=\"".$_POST["nom"]."\";\n</script>\n";
                  break;
                case '5':
                  echo "<script>\n document.getElementById('".$tabForm[$i]."').value=\"".$_POST["email"]."\";\n</script>\n";
                  break;
              }
            }
          }
          if(isset($_POST["password"]) && isset($_POST["password2"]) && ($_POST["password"] != $_POST["password2"])){
            echo "<script>\n document.getElementById('login_h1').style.display=\"block\";\n</script>\n";
            echo "<script>\n document.getElementById('login_h1').innerHTML=\"Les deux mots de passe ne correspondent pas !\";\n</script>\n";
            echo "<script>\n document.getElementById('password').style.border=\"solid 4px #E70739\";\n</script>\n";
            echo "<script>\n document.getElementById('password2').style.border=\"solid 4px #E70739\";\n</script>\n";
          }
        }
        else{
          echo "<script>\n document.getElementById('login_h1').style.display=\"block\";\n</script>\n";
          echo "<script>\n document.getElementById('login_h1').innerHTML=\"Veuillez remplir les champs du formulaire d'inscription ci-dessous :\";\n</script>\n";
        }
        if(isset($_POST) && (!empty($_POST["pseudo"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && !empty($_POST["prenom"]) && !empty($_POST["nom"]) && !empty($_POST["email"])) && ($_POST["password"] == $_POST["password2"])){
          $request = "select max(id) from an_users";
          $requestPseudo = "select username from an_users where username='".$_POST['pseudo']."';";
          try{
            $pseudo = $dbh->query($requestPseudo, PDO::FETCH_ASSOC);
            $result=$pseudo->fetch();
            if(empty($result)){
              $id = $dbh->query($request, PDO::FETCH_ASSOC);
              $result=$id->fetch();
              $newID = 1 + $result['max(id)'];

              $password = md5($_POST["password"]);
              $insertRequest = "insert into `an_users` (`id`, `nom`, `prenom`, `email`, `username`, `hashedPassword`) VALUES ('".$newID."', '".$_POST["nom"]."', '".$_POST["prenom"]."', '".$_POST["email"]."', '".$_POST["pseudo"]."', '".$password."');";

              $request = $dbh->query($insertRequest);
              echo "<script> document.getElementById('login_h1').innerHTML=\"Le compte a été créé avec succès !\"</script>";
            }
            else{
              echo "<script> document.getElementById('login_h1').innerHTML=\"Le nom de compte est déjà utilisé !\"</script>";

            }
          }
          catch(Exception $e){
            echo "<script> document.getElementById('login_h1').innerHTML=\"".$e->GetMessage()."\"</script>";
          }
        }
        ?>
      </div>
      <div class="footer">
      </div>
      <script>
      function accueil(){
        document.location="index.php";
      }
      function login(){
        document.location="login.php";
      }
      </script>
    </body>
    </html>
