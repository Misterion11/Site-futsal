<?php session_start();?>
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

<!-- Affichage du tableau séance -->

  <div class="presta">
    <?php
    echo "<table class='presta'><tr> <th class='presta'> Code prestation </th> <th class='presta'> Date seance </th> <th class='presta'> Code Etat Seance </th> <th class='presta'> Prix seance</th> <th class='presta'>Heure de debut</th> <th class='presta'>Heure de fin seance</th> <th class='presta'>Numero du terrain</th><th class='presta'>Nombre de places restantes</th></tr>";
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
      echo '<tr><td class="presta">', $ligne["Codeprest"], '</td> <td class="presta">', $ligne["dateseance"], '</td> <td class="presta">', $ligne["codeetatseance"], '</td> <td class="presta">', $ligne["prixseance"], '</td> <td class="presta">', $ligne["heuredebseance"], '</td> <td class="presta">', $ligne["heurefinseance"],'</td> <td class="presta">', $ligne["noterrain"],'</td><td class="presta">', $ligne["nbplace"], '</td></td>';
    }
    mysqli_close($con);?>
  </table>
  <form class="bouton" action="seance.php" method="post">
    <input class="bouton marge" type="submit" name="modifier" value="Modifier">
    <input class="bouton marge" type="submit" name="ajouter" value="Ajouter">
    <input class="bouton marge" type="submit" name="suppr" value="Supprimer">
  </form>

<!-- Ajout de séance -->

  <?php
  if (isset($_POST["accept"])) {
    $code3 = $_POST['code'];
    $date3 = $_POST['date'];
    $etat = $_POST['etat'];
    $nometat = $_POST['nometat'];
    $prix = $_POST['prix'];
    $debut = $_POST['debut'];
    $fin = $_POST['fin'];
    $terrain = $_POST['terrain'];
    $con= mysqli_connect("localhost","root","","fdf");
    mysqli_set_charset($con,"utf8");
    if (isset($code3)&&isset($date3)&&isset($etat)&&isset($prix)&&isset($debut)&&isset($fin)&&isset($terrain)) {
      $req = "SELECT NBREPLACE FROM Prestation WHERE CODEPREST = '$code3'";
      $res = mysqli_query($con,$req);
      $ligne = mysqli_fetch_array($res);
      $Nombre = $ligne['NBREPLACE'];
      $req = "INSERT INTO Seance (Codeprest, dateseance, codeetatseance,prixseance,heuredebseance,heurefinseance, noterrain, nbplace) VALUES ('$code3','$date3','$etat','$prix','$debut','$fin','$terrain','$Nombre')";
      $res= mysqli_query($con,$req);
      if (!$res) {
        echo "Erreur dans la saisie, Veuillez rééssayer";
        exit();
      }
      $req = "INSERT INTO etat_seance (CODEETATSEANCE, NOMETATSEANCE) VALUES ('$etat','$nometat')";
      $res= mysqli_query($con,$req);
      mysqli_close($con);
      header("Refresh:0");
    }
  }

// Modification de séances

  if (isset($_POST["change"])) {
    $code = $_POST['newcode2'];
    $anciencode = $_POST['oldcode'];
    $date4 = $_POST['nouvelledate'];
    $etat2 = $_POST['newetat'];
    $prix2 = $_POST['newprix'];
    $debut2 = $_POST['newdebut'];
    $fin2 = $_POST['newfin'];
    $terrain2 = $_POST['newterrain'];
    $con= mysqli_connect("localhost","root","","fdf");
    mysqli_set_charset($con,"utf8");
    $req = "SELECT NBREPLACE FROM prestation WHERE CODEPREST = '$code'";
    $res = mysqli_query($con,$req);
    $ligne = mysqli_fetch_array($res);
    $number = $ligne['NBREPLACE'];
    $req = "UPDATE SEANCE SET Codeprest = '$code', DATESEANCE = '$date4', CODEETATSEANCE = '$etat2', PRIXSEANCE = '$prix2', HEUREDEBSEANCE = '$debut2', HEUREFINSEANCE = '$fin2', NOTERRAIN = '$terrain2', NBPLACE = '$number' WHERE codeprest = '$anciencode'";
    $res= mysqli_query($con,$req);
    mysqli_close($con);
    header("Refresh:0");
  }


// Suppression de séances


  if (isset($_POST["suppseance"])) {
    $delseance = $_POST["Supppp"];
    $datedel = $_POST["datee"];
    $codeetatseance = $_POST['codeetat'];
    $con= mysqli_connect("localhost","root","","fdf");
    mysqli_set_charset($con,"utf8");
    $req = "DELETE FROM seance WHERE CODEPREST = '$delseance' AND DATESEANCE ='$datedel'";
    $res = mysqli_query($con,$req);
    $req = "DELETE FROM etat_seance WHERE CODEETATSEANCE = '$codeetatseance'";
    $res = mysqli_query($con,$req);
    $req = "DELETE FROM inscription WHERE CODEPREST = '$delseance' AND DATESEANCE ='$datedel'";
    $res = mysqli_query($con,$req);
    mysqli_close($con);
    Header("refresh:0");
  }

// Boutons d'include
  if (isset($_POST["modifier"])){
    include("../include/seancealter.html");
  }
  if (isset($_POST['ajouter'])){
    include("../include/seanceadd.php");
  }
  if (isset($_POST['suppr'])){
    include("../include/seancedel.html");
  }
  ?>
</div>
</body>
</html>
