<form class="changement" action="prestation.php" method="post">
  <legend class="modif">Veuillez retaper les anciens champs s'il n'y a pas de changement à appliquer : </legend>
    <table class="modif">
      <tr class="modif">
        <td>Ancien Code : <br> <input type="text" name="code" maxlength="8"></td>
        <td>Nouveau Code : <br> <input type="text" name="newcode" maxlength="8"></td>
      </tr>
      <tr class="modif">
        <td>TypePrestation :  <br><input type="text" name="newtype" value="" maxlength="5"></td>
        <td>Nom Prestation :  <br><input type="text" name="newnom" value="" maxlength="40"></td>
      </tr>
      <tr class="modif">
        <td>Nombre de Place : <br> <input type="number" name="newnbre" value=""></td>
        <td>Tarif : <br> <input type="number" name="newtarif" value="" step="0.01"></td>
      </tr>
      <tr class="modif">
        <td>Date de Validité : <br> <input type="date" name="newdate" value=""></td>
        <td>Age Limite : <br> <input type="number" name="newage" value="" max="99"></td>
      </tr>
      <tr class="modif">
        <td>Description : <br> <textarea name="newdescri" rows="3" cols="35" maxlength="200"></textarea></td>
        <td>Commentaire : <br> <textarea name="newcom" rows="3" cols="35" maxlength="255"></textarea> </td>
      </tr>
    </table>
    <div class="center">
      <input class="bouton" type="submit" name="submit" value="Modifier">
    </div>
  </form>
