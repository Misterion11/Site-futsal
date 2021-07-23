<?php session_start();
?>
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
  <div class="Activite">
    <h2>Nous proposons diverses activités :</h2>
    <table class="tableauacti">
      <tr>
        <td class="tabacti">
          <h1 class='titre'>Le football salle </h1>
          <p>Le futsal est un excellent moyen de se défouler entre amis, collègues ou en famille, cette activité permet d'entretenir la forme et une excellente condition physique lorsque le temps ne permet pas la pratique de ce sport en extérieur. Nous vous mettons à disposition chasubles, gants et ballon.
            Des terrains de foot en salle sont disponibles pour un 5 contre 5 dans une ambiance conviviale.</p>
          </td>
          <td colspan="2" class="tabacti">
            <img class="actiphoto" src="../images/FOOTSAL.jpg" alt="">
          </td>
        </tr>
        <tr>
          <td colspan="2" class="tabacti">
            <img class="actiphoto" src="../images/stages_kids.jpg" alt="">
          </td>
          <td class="tabacti">
            <h1 class='titre'>Stages pour toutes les  générations </h1>
            <p>Venez participer aux différents stages que proposent notre société. Au programme : initiation et perfectionnement au football et futsal, découvertes des bases techniques et tactiques, etc.
              Mais aussi des activités et des jeux variés ; les stagiaires s’amuseront et participeront à des activités fun et variées. Nous aurons ainsi le plaisir de vous accueillir lors de nos stages de perfectionnement technique au sein de la société Fou de Foot.
            </p>
          </td>
        </tr>
        <tr>
          <td class="tabacti">
            <h1 class='titre'>Championnats inter-entreprises de foot en salle </h1>
            <p>
              Venez renforcer la cohésion et l'esprit d'équipe de vos collaborateurs en participant à nos différents événements inter-entreprise de foot en salle.  </p>
            </td>
            <td colspan="2" class="tabacti">
              <img class="actiphoto" src="../images/Inter_entreprise.jpg" alt="">
            </td>
          </tr>
          <tr>
            <td colspan="2" class="tabacti">
              <img class="actiphoto" src="../images/Bubble_foot.jpg" alt="">
            </td>
            <td class="tabacti">
              <h1 class='titre'>Bubble Foot </h1>
              <p>Pour encore plus de fun en matière de sport indoor, n’hésitez pas à vous tourner vers le bubble foot. Cette pratique originale consiste à enfermer les joueurs dans une bulle.
                Ouvert à tous, sans restriction d’âge ou de capacités physiques et sportives, nous vous promettons beaucoup d’amusement lors des contacts et des déplacements.  </p>
              </td>
            </tr>
          </table>
        </div>
