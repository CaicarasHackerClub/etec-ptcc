<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Triagem</title>
  </head>
  <body>
    <?php
      // $id = isset($_POST['id']) ? $_POST['id'] : "";
    ?>
    <h1>Triagem</h1>
    <form action="resultado.php" method="post">
      <label>ID: </label><input type="text" name="id"><br>
      <label>Peso: </label><input type="text" name="peso"><br>
      <label>Altura: </label><input type="text" name="altura"><br>
      <label>Batimento cardíaco: </label><input type="text" name="batimento" required><br>
      <label>Respiração: </label><input type="text" name="resp" required><br>
      <label>Temperatura corporal: </label><input type="text" name="temp" required><br>
      <label>PAS: </label><input type="text" name="pas" required><br>
      <label>PAD: </label><input type="text" name="pad" required><br>
      <label>Nível de oxigenação do sangue: </label><input type="text" name="oxi"><br>
      <label>Dor: </label><input type="text" name="dor"><br>
      <label>Indicação de comprometimento dos orgãos vitais </label> <input type="checkbox" name="org"> <br>
      <input type="submit">
    </form>
  </body>
</html>
