<?php session_start(); ob_start();?>
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
        <h1 class="fdf">FouDeFoot</h1>
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
  <!-- Form Pour rechercher -->
  <div class="recherche">
    <form class="" action="prestation.php" method="post">
      <input type="text" name="info" value="">
      <input class="bouton" type="submit" name="recherche" value="Rechercher">
    </form>
  </div>

  <!-- Affichage du tableau -->

  <div class="presta">
    <table class="presta">
      <tr> <th class='presta' class='presta'> Code prestation </th> <th class='presta'> Type Prestation </th> <th class='presta'> Nom Prestation </th> <th class='presta'>Nombre de places</th> <th class='presta'>Tarif</th> <th class='presta'>Date de Validité</th> <th class='presta'>Age Limite</th> <th class='presta'>Description</th> <th class='presta'>Commentaire</th> </tr>
      <?php  $con = mysqli_connect("localhost", "root", "", "fdf");
      mysqli_set_charset($con,"utf8");
      $req = "SELECT Codeprest, Codetypepresta, nomprest, nbreplace,tarifprest,datevalidite,agelimite,descriprest,commenprest  FROM Prestation ORDER BY Codeprest" ;
      $res = mysqli_query($con, $req);
      while ($ligne = mysqli_fetch_array($res)) {
        echo '<tr> <td class="presta">', $ligne["Codeprest"], '</td> <td class="presta">', $ligne["Codetypepresta"], '</td> <td class="presta">', $ligne["nomprest"], '</td> <td class="presta">', $ligne["nbreplace"], '</td> <td class="presta">', $ligne["tarifprest"], '</td> <td class="presta">', $ligne["datevalidite"],'</td> <td class="presta">', $ligne["agelimite"],'</td> <td class="presta">', $ligne["descriprest"],'</td> <td class="presta">', $ligne["commenprest"],
        '</td>';}
        mysqli_close($con); ?>
      </table>
      <?php
      if(isset($_SESSION['username'])){
        $user=$_SESSION['username'];
        $con = mysqli_connect("localhost", "root", "", "fdf");
        mysqli_set_charset($con,"utf8");
        $req = "SELECT typecompte FROM Compte WHERE typecompte = 'res' AND user='$user'";
        $res = mysqli_query($con, $req);
        $rows= mysqli_num_rows($res);
        if ($rows==1) {
          echo   "<form class='bouton' action='prestation.php' method='post'>
          <input class='bouton marge' type='submit' name='modif' value='Modification Prestation'>
          <input class='bouton marge' type='submit' name='ajout' value='Ajout Prestation'>
          <input class='bouton marge' type='submit' name='supp' value='Suppression Prestation'>
          <input class='bouton marge' type='submit' name='seanceCo' value='Voir les Séances'>
          </form>";
        }
        else {
          echo "<form class='bouton' action='prestation.php' method='post'>
          <input class='bouton' type='submit' name='seance' value='Voir les Séances'>
          </form>";
        }
}

        // <!-- Pour faire une modification -->
        if (isset($_POST["modif"])) {
          include('../include/FormModif.php');
        }

        if (isset($_POST["submit"])) {
          $code = $_POST['newcode'];
          $anciencode = $_POST['code'];
          $type = $_POST['newtype'];
          $nom = $_POST['newnom'];
          $nbre = $_POST['newnbre'];
          $tarif = $_POST['newtarif'];
          $date = $_POST['newdate'];
          $age = $_POST['newage'];
          $descri = $_POST['newdescri'];
          $descri = addslashes($descri);
          $com = $_POST['newcom'];
          $com = addslashes($com);
          $con= mysqli_connect("localhost","root","","fdf");
          mysqli_set_charset($con,"utf8");
          $req = "SELECT CODETYPEPRESTA FROM Prestation WHERE Codeprest = '$anciencode'";
          $res = mysqli_query ($con,$req);
          $ligne = mysqli_fetch_array($res);
          $codechang = $ligne['CODETYPEPRESTA'];
          $req = "UPDATE prestation SET Codeprest = '$code', CODETYPEPRESTA = '$type', NOMPREST = '$nom', NBREPLACE = '$nbre', TARIFPREST = '$tarif', datevalidite = '$date', agelimite = '$age', descriprest = '$descri', commenprest = '$com' WHERE codeprest = '$anciencode'";
          $res= mysqli_query($con,$req);
          $req = "UPDATE type_presta SET CODETYPEPRESTA = '$type', NOMTYPEPRESTA = '$nom' WHERE CODETYPEPRESTA = '$codechang' ";
          $res = mysqli_query($con,$req);
          if (!$res) {
            printf(mysqli_error($con));
          }
          mysqli_close($con);
          header('Refresh:0');
        }


        //Ajouter une ligne
        if (isset($_POST["ajout"])) {
          include('../include/FormAjout.php');
        }

        if (isset($_POST["valid"])) {
          $code2 = $_POST['code'];
          $type2 = $_POST['type'];
          $nom2 = $_POST['nom'];
          $nbre2 = $_POST['nbre'];
          $tarif2 = $_POST['tarif'];
          $date2 = $_POST['date'];
          $age2 = $_POST['age'];
          $descri2 = $_POST['descri'];
          $descri2 = addslashes($descri2);
          $com2 = $_POST['com'];
          $com2 = addslashes($com2);
          $con= mysqli_connect("localhost","root","","fdf");
          $datejour = date("y-m-d");
          mysqli_set_charset($con,"utf8");
          if (isset($code2)&&isset($type2)&&isset($nom2)&&isset($nbre2)&&isset($tarif2)&&isset($date2)&&isset($age2)&&isset($descri2)&&isset($com2)) {
            $req = "INSERT INTO prestation (Codeprest,CODETYPEPRESTA,NOMPREST,NBREPLACE,TARIFPREST,datecreation,datevalidite,agelimite,descriprest,commenprest) VALUES ('$code2','$type2','$nom2','$nbre2','$tarif2','$datejour','$date2','$age2','$descri2','$com2')";
            $res= mysqli_query($con,$req);
            $req = "INSERT INTO type_presta (CODETYPEPRESTA, NOMTYPEPRESTA) VALUES ('$type2','$nom2')";
            $res = mysqli_query($con,$req);
            mysqli_close($con);
            header("Refresh:0");
          }  /*Impossible de faire un required à cause du switch entre le bouton modif et ajout :(*/
        }

        if (isset($_POST["supp"])) {
          include('../include/FormSuppr.php');
        }

        // La suppression
        if (isset($_POST['suppr'])) {
          $supr = $_POST['truc'];
          $con= mysqli_connect("localhost","root","","fdf");
          mysqli_set_charset($con,"utf8");
          $req = "DELETE FROM prestation WHERE CODETYPEPRESTA = '$supr'";
          $res = mysqli_query($con,$req);
          $req = "DELETE FROM type_presta WHERE CODETYPEPRESTA = '$supr'";
          $res = mysqli_query($con,$req);
          mysqli_close($con);
          header("Refresh:0");
        }

        //  Rechercher une ligne
        if (isset($_POST["recherche"]) && $_POST['info']!="") {
          $info = $_POST['info'];
          $info = addslashes($info);
          $con= mysqli_connect("localhost","root","","fdf");
          mysqli_set_charset($con,"utf8");
          $req = "SELECT * FROM prestation WHERE DESCRIPREST LIKE '%$info%' OR CODEPREST LIKE '%$info%' OR CODETYPEPRESTA LIKE '%$info%' OR NOMPREST LIKE '%$info%' OR NBREPLACE LIKE '%$info%' OR TARIFPREST LIKE '%$info%' OR DATEVALIDITE LIKE '%$info%' OR AGELIMITE LIKE '%$info%' OR COMMENPREST LIKE '%$info%'";
          $res = mysqli_query($con,$req);
          echo "<table class='presta'>";
          while ($ligne = mysqli_fetch_array($res)) {
            echo '<tr> <td class="presta">', $ligne["CODEPREST"], '</td> <td class="presta">', $ligne["CODETYPEPRESTA"], '</td> <td class="presta">', $ligne["NOMPREST"], '</td> <td class="presta">', $ligne["NBREPLACE"], '</td> <td class="presta">', $ligne["TARIFPREST"], '</td> <td class="presta">', $ligne["DATEVALIDITE"],'</td> <td class="presta">', $ligne["AGELIMITE"],'</td> <td class="presta">', $ligne["DESCRIPREST"],'</td> <td class="presta">', $ligne["COMMENPREST"],'</td></tr>';
          }
          echo "</table>";
        }



        // Les séances
        if (isset($_POST['seance'])) {
          include('../include/seance.html');
        }
        if (isset($_POST['codeseance'])) {
          $codeseance = $_POST['codeseance'];
          echo "<table class='presta'><tr> <th class='presta'> Code prestation </th> <th class='presta'> Date seance </th> <th class='presta'> Code Etat Seance </th> <th class='presta'> Prix seance</th> <th class='presta'>Heure de debut</th> <th class='presta'>Heure de fin seance</th> <th class='presta'>Numero du terrain</th><th class='presta'>Nombre de places restantes</th></tr>";
          $con = mysqli_connect("localhost", "root", "", "fdf");
          mysqli_set_charset($con,"utf8");
          $req = "SELECT Codeprest, dateseance, codeetatseance, prixseance, heuredebseance, heurefinseance, noterrain, nbplace FROM Seance WHERE CODEPREST = '$codeseance' ORDER BY dateseance" ;
          $res = mysqli_query($con, $req);
          while ($ligne = mysqli_fetch_array($res)) {
            echo '<tr><td class="presta">', $ligne["Codeprest"], '</td> <td class="presta">', $ligne["dateseance"], '</td> <td class="presta">', $ligne["codeetatseance"], '</td> <td class="presta">', $ligne["prixseance"], '</td> <td class="presta">', $ligne["heuredebseance"], '</td> <td class="presta">', $ligne["heurefinseance"],'</td> <td class="presta">', $ligne["noterrain"],'</td><td class="presta">',$ligne["nbplace"],'</td></tr>';
          }
          echo "</table>";
          mysqli_close($con);
        }


        if (isset($_POST['seanceCo'])) {
          header ("Location: seance.php");
        }

        ?>
      </div>
    </body>
    <?php if (empty($_POST['suppr'])) {
      // code...
    } ?>
    <br><br><br><br><br><br><br><br>
    <footer>
      <h2>© 2020 - Fou De Foot - Futsal Club</h2>
    </footer>
    </html>
    <?php ob_end_flush(); ?>
    <!-- corrige une erreur header -->
