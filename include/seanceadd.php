<form class="changement" action="seance.php" method="post">
  <legend class="modif">Veuillez remplir le formulaire pour ajouter une séance : </legend>
    <table class="modif">
      <tr class="modif">
        <td>Code Prestation : <input type="text" name="code" value="" maxlength="6"></td>
        <td>Date Séance : <input type="date" name="date" value=""></td>
      </tr>
      <tr class="modif">
        <td>Code Etat Séance : <input type="text" name="etat" value="" maxlength="2"></td>
        <td>Nom Etat Séance : <input type="text" name="nometat" value="" maxlength="15"></td>
      </tr>
      <tr class="modif">
        <td>Heure début de Séance : <input type="time" name="debut" value="" min="00:00" max="23:59"></td>
        <td>Heure fin de Séance : <input type="time" name="fin" value="" min="00:00" max="23:59"></td>
      </tr>
      <tr class="modif">
        <td>Numero de Terrain :  <input type="number" name="terrain" value="" max="99"></td>
        <td>Prix Séance<input type="number" name="prix" value="" step="0.01"></td>
      </tr>
    </table>
    <div class="center">
      <input class='bouton' type="submit" name="accept" value="Valider">
    </div>
  </form>
