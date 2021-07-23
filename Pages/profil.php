<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/styyle.css">
  <title>Page</title>
</head>
<body>
  <header>
    <div class="header">
      <div class="logo">
        <img class="logo" src="../images/logo.png" alt="">
      </div>
      <div class="Titre">
        <h1>Fou De Foot</h1>
      </div>
      <div class="Connect">
        <?php
        if(isset($_SESSION['username'])){
          echo '<h2 class="test">Mon profil : <a class="connecté" href="profil.php">', $_SESSION["username"]. '</a><br /><a class="connexion" href="../include/deconnexion.php">Se déconnecter</a></h2>';
        }
        else {
          echo '<h2><a class="connexion" href="inscrixion.php">Se connecter</a></h2>';
        }
        ?>
      </div>
    </div>
    <nav>
      <div class="nav">
        <a href="Accueil.php"><img class="icone" src="../images/home.png" alt=""> </a>
      </div>
      <div class="nav">
        <a class="nav" href="Activités.php">Nos activités</a>
      </div>
      <div class="nav">
        <a class="nav" href="prestation.php">Prestation</a>
      </div>
      <div class="nav">
        <a class="nav" href="quisommes-nous.php">Qui sommes-nous ?</a>
      </div>
      <div class="nav">
        <a class="nav" href="reserver.php">Réserver</a>
      </div>
    </nav>
  </header>
  <?php
  $user=$_SESSION['username'];
  $con= mysqli_connect("localhost","root","","fdf");
  mysqli_set_charset($con,"utf8");
  $req = "SELECT TypeCompte FROM compte WHERE User = '$user' AND TypeCompte = 'fdf'";
  $res = mysqli_query($con,$req);
  $rows = mysqli_num_rows($res);
  if ($rows==1) {
    echo "<div class='presta'>";
    include("../include/adheration.php");
    echo "</div>";
  }
  else {
    $req = "SELECT user,nomadh,prenomadh, adrmailadh,dtfinadh FROM ADHERANT WHERE user = '$user'";
    $res = mysqli_query($con,$req);
    echo "<div class='infosprofil'> <table class='presta'> <tr><th colspan='9'><img class='anonyme' src='../images/anonyme.png'></tr>
    <tr><th class='presta'>Nom d'utilisateur </th> <th class='presta'> Nom </th><th class='presta'> Prénom </th><th class='presta'> Adresse Mail </th><th class='presta'> Date Fin adherant </th><th class='presta'> Type Compte </th></tr>";
    $ligne = mysqli_fetch_array($res);
    echo '<tr><td class="presta">', $ligne["user"], '</td><td class="presta">', $ligne['nomadh'], '</td><td class="presta">', $ligne["prenomadh"],'</td><td class="presta">', $ligne['adrmailadh'],'</td><td class="presta">',$ligne['dtfinadh'] ,'</td>';
    $req = "SELECT typecompte FROM Compte WHERE user = '$user'";
    $res = mysqli_query($con,$req);
    $ligne = mysqli_fetch_array($res);
    echo '<td class="presta">', $ligne["typecompte"],'</tr></div>';
    echo '</table>';
    $req = "SELECT TypeCompte FROM compte WHERE User = '$user' AND TypeCompte = 'admin'";
    $res = mysqli_query($con,$req);
    $rows = mysqli_num_rows($res);
    if ($rows==1) {
      echo  "<div class='presta'>
      <form action='profil.php' method='post'>
      <input class='bouton' type='submit' name='modif' value='Modifier pseudo'>
      <input class='bouton' type='submit' name='suppr' value='Suppression'>
      <input class='bouton' type='submit' name='idco' value='Afficher Identifiants'>
      </form>
      </div>";
    }
    else {
      echo "<div class='presta'>
      <form action='profil.php' method='post'>
      <input class='bouton' type='submit' name='modif' value='Modifier pseudo'>
      <input class='bouton' type='submit' name='suppr' value='Suppression'>
      </form>
      </div>";
    }

    if (isset($_POST['suppr'])) {
      include ('../include/DeleteCompte.php');
    }
    if (isset($_POST['deleted'])) {
      $con= mysqli_connect("localhost","root","","fdf");
      mysqli_set_charset($con,"utf8");
      $req = "DELETE FROM compte WHERE user = '".$_SESSION['username']."'";
      $res = mysqli_query($con,$req);
      $req = "DELETE FROM adherant WHERE user = '".$_SESSION['username']."'";
      $res = mysqli_query($con,$req);
      session_unset();
      header('Location:Accueil.php');
    }
      if (isset($_POST['keep'])) {
        header('Location:Pages/profil.php');
        }
    if (isset($_POST['modif'])) {
      include ('../include/modif.php');
    }
    if (isset($_POST{'idco'})) {
      $req = "SELECT user,mdp FROM compte";
      $res = mysqli_query($con,$req);
      echo "<table class='mdp'><tr><th class='presta'>Utilisateur</th><th class='presta'>Mot De Passe </th></tr>";
      while ($ligne = mysqli_fetch_array($res)) {
        echo '<tr><td class="presta">', $ligne["user"], '</td><td class="presta">', $ligne["mdp"], '</td></tr>';
      }
      echo "</table>";
    }
    ?>
    <?php /*Pseudo*/

    if (isset($_POST["submit"])) {
      $pseudo = $_POST['newpseudo'];
      $ancienps = $_POST['pseudo'];
      // if ($ancienps != $pseudo) {
      //   if ($ancienps == $_SESSION['username']) {
      $con= mysqli_connect("localhost","root","","fdf");
      mysqli_set_charset($con,"utf8");
      $req = "UPDATE compte  SET user = '$pseudo' WHERE user = '$ancienps'";
      $res= mysqli_query($con,$req);
      $req = "UPDATE adherant SET user = '$pseudo' WHERE user = '$ancienps'";
      $res= mysqli_query($con,$req);
      if ($res) {
        $_SESSION['username'] = $pseudo;
      }
      header("Refresh:0");

      //   } else {
      //     echo "Ancien pseudo faux";
      //   }
      // } else {
      //   echo "Même pseudo aucun changement nécessaire";
      // }
    }
  }
  ?>
