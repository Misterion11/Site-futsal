<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/styyle.css">
  <title>Page</title>
</head>
<body>
  <header class='accueil'>
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
          echo '<h2 class="test">Mon profil : <a class="connecté" href="profil.php">', $_SESSION["username"]. '</a><br /><a class="connexion" href="include/deconnexion.php">Se déconnecter</a></h2>';
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
  <div class="snickers">
    <div class="twix">
      <h1 class='titre'>Notre concept</h1>
      <h3>
        Nous avons créé ce complexe de sport dans l'espoir de faire venir toutes les personnes plus ou moins interessées par le futsal et le football. Lors de la création, nous avons décidé de ne pas uniquement se consacrer au futsal et ainsi donner envie à tous de venir nous rencontrer. <br>
        Chez nous, vous pouvez retrouver des terrains de futsal, d'arcades, des baby-foot, un bar pour vous détendre après une bonne partie de foot, et divers autres activités. Chacune de nos activités sont comprises entre 10 et 150€, idéal pour tous les budgets. <br/>
        Nous avons crée des activités pour tout âge, dès 5 ans les enfants peuvent entrer dans notre école de futsal, s'entrainer avec des professionnels mais aussi simplement s'amuser avec leurs copains et copines lors d'un anniversaire ou sur le terrain pour une activité sympathique.<br/>
      </h3>
    </div>
    <div class="twix">
      <h1 class='titre'>Notre histoire</h1>
      <h3>
        A l'origine, nous sommes 3 amis qui se connaissaient depuis petit et qui déjà rêvaient de créer une entreprise ensemble. <br/>
        L'idée de créer notre propre complexe de futsal nous est venu sur un coup de tête, une idée en apparence folle pour nos proches.  Nous avons alors commencé à réellement en discuter pour approfondir nos idées sur le sujet. Suite à tout cela, nous avons commencé à chercher des locaux, différents partenarias pour nous aider financierement. <br/>
        Nous avons connu énormément de difficultés, pour trouver un lieu, pour s'entendre sur les différents sujet évoqués, pour la décoration, les activités, les problèmes au niveau des travaux etc... <br/>
        Maintenant que nous avons ouvert, tout va pour le mieux. Nous invitons donc tout ceux qui ne nous connaissent pas encore à venir nous rencontrer dès aujourd'hui au 105 bis Avenue Foch, 75016 Paris. <br/>
      </h3>
    </div>
    <div class="twix">
      <h1 class='titre'>Notre équipe</h1>
      <h3>
        Notre équipe est composé de 10 membres tous unis dans le même but, celui de vous satisfaire. Nous comptons dans notre équipe 6 professionnels du futsal afin d'encadrer vos enfants et vous pour le mieux, un barman pour vous servir les meilleurs cocktails et 3 gérants que vous pouvez contacter à tous moments.<br/>
      </h3>
    </div>
  </div>
  <footer>
    <h2>© 2020 - Fou De Foot - Futsal Club</h2>
  </footer>
