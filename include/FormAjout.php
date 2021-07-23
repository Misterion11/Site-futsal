<form class="changement" action="prestation.php" method="post">
  <legend class="modif">Veuillez remplir le formualaire suivant pour ajouter une prestation : </legend>
  <table>
    <tr class="modif">
      <td>Code Prestation : <br> <input type="text" name="code" maxlength="6"></td>
      <td>Code Type Prestation :  <br><input type="text" name="type" value="" maxlength="5"></td>
      <td>Nom Prestation :  <br><input type="text" name="nom" value="" maxlength="40"></td>
    </tr>
    <tr class="modif">
      <td>Nombre de Place : <br> <input type="number" name="nbre" value="" max="99"></td>
      <td>Tarif : <br> <input type="number" name="tarif" value="" max="99" step='0.01'></td>
      <td>Date de Validité : <br> <input type="date" name="date" value=""></td>
    </tr>
    <tr class="modif">
      <td>Age Limite : <br> <input type="number" name="age" value="" max="99"></td>
      <td>Description : <br> <textarea name="descri" rows="3" cols="35" maxlength="200"></textarea></td>
      <td>Commentaire : <br> <textarea name="com" rows="3" cols="35" maxlength="255"></textarea> </td>
    </tr>
  </table>
  <div class="center"><input class="bouton" type="submit" name="valid" value="Ajouter">
  </div>
</form>
