<?php
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  if ($username&&$password) {
    $con= mysqli_connect("localhost","root","","fdf");
    mysqli_set_charset($con,"utf8");
    $req= "SELECT * FROM compte WHERE user='$username' && mdp='$password'";
    $res = mysqli_query($con,$req);
    if (!$res) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }
    $rows= mysqli_num_rows($res);
    if ($rows==1) {
      session_start();
      $_SESSION['username']=$username;
      $_SESSION['password']=$password;
      $req = "SELECT dtfinadh FROM adherant WHERE user= '".$_SESSION['username']."'";
      $res = mysqli_query($con,$req);
      $ligne = mysqli_fetch_array($res);
      $datefin = $ligne['dtfinadh'];
        $dateajd = date("y-m-d");
        $timefin = strtotime($datefin);
        $timeajd = strtotime($dateajd);
      if ($timefin<$timeajd) {
        $req = "UPDATE compte SET TypeCompte = 'fdf' WHERE user= '".$_SESSION['username']."'";
        $res = mysqli_query($con,$req);
        $req = "DELETE FROM Adherant WHERE user= '".$_SESSION['username']."'";
        $res = mysqli_query($con, $req);
      }
      header('Location: ../Pages/Accueil.php');
    }
    else {
      header('Location: ../Pages/inscrixion.php?page=erreur');
    }
  }
}
?>
<form class="connexion" action="../include/connexion.php" method="post">
  <fieldset class="connexion">
    <legend>Connectez-vous</legend>
    <div class="centrage">
      <p>Votre pseudo:</p>
      <input type="text" name="username" value="" required>
      <p>Votre password</p>
      <input type="password" name="password" value="" required> <br>
      <input class="bouton" type="submit" name="submit" value="Se connecter">
    </div>
  </fieldset>
</form>
