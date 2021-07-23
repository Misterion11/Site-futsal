<?php session_start(); ob_start(); ?>
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
        <h1 class='fdf'>FouDeFoot</h1>
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
        <a class="nav" href="prestation.php">Prestations</a>
      </div>
      <div class="nav">
        <a class="nav" href="quisommes-nous.php">Qui sommes-nous ?</a>
      </div>
      <div class="nav">
        <a class="nav" href="reserver.php">Réserver</a>
      </div>
    </nav>
  </header>

  <!-- Affichage du taleau séance -->

  <div class="presta">
    <?php
    echo "<table class='presta'><tr> <th class='presta'> Code prestation </th> <th class='presta'> Date seance </th> <th class='presta'> Code Etat Seance </th> <th class='presta'> Prix seance</th> <th class='presta'>Heure de debut</th> <th class='presta'>Heure de fin seance</th> <th class='presta'>Numéro du terrain</th><th class='presta'>Nombre de places restantes</th></tr>";
    $con = mysqli_connect("localhost", "root","", "fdf");
    mysqli_set_charset($con,"utf8");
    $req = "SELECT Codeprest, dateseance, codeetatseance, prixseance, heuredebseance, heurefinseance, noterrain, nbplace FROM Seance ORDER BY Codeprest, dateseance" ;
    $res = mysqli_query($con, $req);
    while (@$ligne = mysqli_fetch_array($res)) {
      $dateajd = date("y-m-d");
      $datesea = $ligne['dateseance'];
      $codesea = $ligne["Codeprest"];
      $time1 = strtotime($dateajd);
      $time2 = strtotime($datesea);
      if ($time1>$time2) {
        $req= "DELETE FROM seance WHERE Codeprest = '$codesea' AND dateseance = '$datesea'";
        $res= mysqli_query($con,$req);
        header('Refresh:0');
      }
      echo '<tr><td class="presta">', $ligne["Codeprest"], '</td> <td class="presta">', $ligne["dateseance"], '</td> <td class="presta">', $ligne["codeetatseance"], '</td> <td class="presta">', $ligne["prixseance"], '</td> <td class="presta">', $ligne["heuredebseance"], '</td> <td class="presta">', $ligne["heurefinseance"],'</td> <td class="presta">', $ligne["noterrain"],'</td><td class="presta">', $ligne["nbplace"],'</td></tr>';
    }
    mysqli_close($con);?>
  </table>

  <!-- Reservation -->
 <?php
  if(isset($_SESSION['username'])){
    echo   "<form class='bouton' action='reserver.php' method='post'>
    <input class='bouton marge' type='submit' name='inscription' value='Inscription'>
    <input class='bouton' type='submit' name='avoid' value='Annuler une inscription'>";
    $user = $_SESSION['username'];
    $con = mysqli_connect("localhost", "root", "", "fdf");
    mysqli_set_charset($con,"utf8");
    $req = "SELECT typecompte FROM Compte WHERE typecompte = 'res' AND user='$user'";
    $res = mysqli_query($con, $req);
    $rows= mysqli_num_rows($res);
    if ($rows==1) {
      echo "<input class='bouton' type='submit' name='reservations' value='Voir les reservations'></form>";
    }
    if (isset($_POST["inscription"])) {
      include('../include/reserver_inscription.php');
    }
    if (isset($_POST["valid"])) {
      $code = $_POST['codeprest'];
      $date = $_POST['datesea'];
      $nombre = $_POST['nbjoueur'];
      $user = $_SESSION['username'];
      $dateajd = date("y-m-d");
      if (isset($code)&&isset($date)&&isset($nombre)) {
        $con= mysqli_connect("localhost","root","","fdf");
        mysqli_set_charset($con,"utf8");
        $req = "SELECT noadh from adherant where user = '$user'";
        $res = mysqli_query($con,$req);
        $ligne = mysqli_fetch_array($res);
        $num = $ligne['noadh'];
        $req = "SELECT codeprest,dateseance FROM seance WHERE codeprest = '$code' AND dateseance = '$date'";
        $res = mysqli_query($con,$req);
        $rows = mysqli_num_rows($res);
        if ($rows==1) {
          $req = "SELECT CODEPREST from INSCRIPTION WHERE noadh = '$num' AND Codeprest = '$code'";
          $res = mysqli_query($con,$req);
          $rows = mysqli_num_rows($res);
        }
          else {
            echo "Séance inexistante !";
            exit();
          }
          if ($rows==1) {
            echo "Vous êtes déjà inscrit pour une séance de cette prestation";
            exit();
        }


        $req = "SELECT NBPLACE FROM Seance WHERE Codeprest = '$code'";
        $res = mysqli_query($con,$req);
        $ligne = mysqli_fetch_array($res);
        $nbre = $ligne["NBPLACE"];
        $newnbre = $nbre - $nombre;
        if ($newnbre<0) {
          echo "<br />Plus assez de places pour le nombre de joueurs que vous avez indiqué.";
          exit();
        }
        else {
            $req = "INSERT INTO INSCRIPTION (Codeprest,dateseance,nbrejoueur,noadh,dateinscrip) VALUES ('$code','$date','$nombre','$num','$dateajd')  ";
            $res= mysqli_query($con,$req);
            $req = "UPDATE Seance SET NBPLACE = '$newnbre' WHERE Codeprest = '$code' AND DATESEANCE = '$date'";
            $res = mysqli_query($con,$req);
            mysqli_close($con);
            header("Refresh:0");
          }
        }
      }
    if (isset($_POST['avoid'])) {
      $req = "SELECT noadh from adherant where user = '$user'";
      $res = mysqli_query($con,$req);
      $ligne = mysqli_fetch_array($res);
      $num = $ligne['noadh'];
      $req = "SELECT Codeprest, dateseance,noadh,dateinscrip,nbrejoueur FROM INSCRIPTION WHERE noadh = '$num'  ORDER BY CODEPREST, DATESEANCE ";
      $res = mysqli_query($con,$req);
      echo '<table class="mdp"><tr><th class="presta">Code Prestation</th><th class="presta">Date Seance</th><th class="presta">Nombre Joueur</th></tr>';
      while ($ligne = mysqli_fetch_array($res)) {
        echo '<tr><td class="presta">', $ligne["Codeprest"], '</td> <td class="presta">', $ligne["dateseance"],'</td> <td class="presta">', $ligne["nbrejoueur"],'</td></tr>';
      }
      echo '</table>';

      include('../include/annulseance.php');
    }
      if (isset($_POST['seanceavoid'])) {
        $req = "SELECT noadh from adherant where user = '$user'";
        $res = mysqli_query($con,$req);
        $ligne = mysqli_fetch_array($res);
        $num = $ligne['noadh'];
        $cdeann = $_POST['CodeAnn'];
        $datean = $_POST['datean'];
        $req = "SELECT nbrejoueur FROM Inscription WHERE codeprest ='$cdeann' AND dateseance='$datean' AND noadh='$num'";
        $res = mysqli_query($con,$req);
        $ligne = mysqli_fetch_array($res);
        $nbree = $ligne['nbrejoueur'];
        $req = "DELETE FROM INSCRIPTION WHERE codeprest ='$cdeann' AND dateseance='$datean' AND noadh='$num'";
        $res = mysqli_query($con,$req);
        $req = "SELECT NBPLACE FROM Seance WHERE Codeprest = '$cdeann' AND dateseance= '$datean'";
        $res = mysqli_query($con,$req);
        $ligne = mysqli_fetch_array($res);
        $nbre = $ligne["NBPLACE"];
        $newnumber = $nbree+ $nbre;
        $req = "UPDATE Seance SET NBPLACE = '$newnumber' WHERE codeprest ='$cdeann' AND dateseance='$datean'";
        $res = mysqli_query($con,$req);
        mysqli_close($con);
        header("refresh:0");
      }
  }
  else {
    echo "Veuillez vous connecter pour réserver ";
  }




  // Voir les réservations

  if (isset($_POST['reservations'])) {
    $con= mysqli_connect("localhost","root","","fdf");
    mysqli_set_charset($con,"utf8");
    $req = "SELECT Codeprest, dateseance,noadh,dateinscrip,nbrejoueur FROM INSCRIPTION ORDER BY CODEPREST, DATESEANCE, NOADH";
    $res = mysqli_query($con,$req);
    echo '<table class="presta"><tr><th class="presta">Code Prestation</th><th class="presta">Date Seance</th><th class="presta">Numéro Adhérant</th><th class="presta">Date Inscription</th><th class="presta">Nombre Joueur</th></tr>';
    while ($ligne = mysqli_fetch_array($res)) {
      echo '<tr><td class="presta">', $ligne["Codeprest"], '</td> <td class="presta">', $ligne["dateseance"], '</td> <td class="presta">', $ligne["noadh"], '</td> <td class="presta">', $ligne["dateinscrip"], '</td> <td class="presta">', $ligne["nbrejoueur"],'</td></tr>';
    }
    echo '</table>';
    mysqli_close($con);
  }?>
</div>
    <?php ob_end_flush(); ?>
