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
  <header class="accueil">
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
  <div class="slide">
    <div id="slide1">
      <ul id="imageslide"><!--
      --><li>
      <img src="../images/item1.jpg" alt="">
    </li><!--
    --><li><img src="../images/item2.png" alt="" /></li><!--
  --><li><img src="../images/item3.jpg" alt="" /></li>
</ul>
</div>
</div>
<div class="image">
  <div class="Imageuh">
    <figure>
      <img class="img" src="../images/tournoi.jpg" alt="">
    </figure>
    <div class="textimg">
      <h1 class="titre"> Tournoi : </h1>
      <h3> Notre complexe de sport organise des championnats  de tout niveau en collaboration avec tous les autres complexes de futsal de France, affilé à la Fédération Française de football que ce soit des tournois régionaux mais aussi des tournois départementaux. La meilleur équipe de chaque niveau en France gagne une place pour le championnat européen de futsal. Ainsi la compétiton est quelque chose d’important pour nous. </h3>
    </div>
  </div>
  <div class="Imageuh">
    <div>
      <h1 class="titre"> École de Futsal : </h1>
      <h3>FouDeFoot à ouvert son école spécial futsal cette année, dès l’âge de 5 ans les enfants peuvent venir dans notre école pour découvrir un sport encore peu développé souvent comparé au football joué lui en extérieur. Les enfants sont encadrés pas des éducateurs et anciens joueurs afin d’être dans les meilleures conditions pour réussir. L’école n’accueille que jusqu’à l’âge de 18 ans.</h3>
    </div>
    <figure class="droite">
      <img class="img2" src="../images/ecole.jpg" alt="">
    </figure>
  </div>
  <div class="Imageuh">
    <figure>
      <img class="img" src="../images/stade.jpg" alt="">
    </figure>
    <div class="textimg">
      <h1 class="titre"> Loisirs : </h1>
      <h3>Pour ceux qui veulent uniquement passer un bon moment entre amis tout en se défoulant et en pratiquant un sport d’équipe, FouDeFoot possède 6 terrains dont 4 consacrés au loisir de tous réservables via le site web ou directement en vous rendant à FouDeFoot. <br> Un bon compromis pour faire du sport et s’amuser.</h3>
      </div>
    </div>
    <div class="Imageuh">
      <div>
        <h1 class="titre"> Locaux : </h1>
        <h3>Dans notre complexe, vous pourrez retrouver différents divertissement. Un bar pour regarder des matchs de futsal ou de football, pour boire un verre, rencontrer des gens ou simplement vous reposer après un match. <br> Des douches sont mises à la disposition des membres. Vous pourrez aussi accéder à un parking sécurisé.
Tout y est pour vous faire plaisir.</h3>
      </div>
      <figure class="droite">
        <img class="img2" src="../images/bar.jpg" alt="">
      </figure>
    </div>
  </div>
  <footer>
    <h2>© 2020 - Fou De Foot - Futsal Club</h2>
  </footer>
</body>
</html>
