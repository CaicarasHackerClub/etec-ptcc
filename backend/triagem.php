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
      <label>ID: </label><input type="text" name="id" value="0"><br>
      <label>Peso: </label><input type="text" name="peso" value="0"><br>
      <label>Altura: </label><input type="text" name="altura" value="0"><br>
      <label>Batimento cardíaco: </label><input type="text" name="batimento" value="0" required><br>
      <label>Respiração: </label><input type="text" name="resp" value="0" required><br>
      <label>Temperatura corporal: </label><input type="text" name="temp" value="0" required><br>
      <label>PAS: </label><input type="text" name="pas" value="0" required><br>
      <label>PAD: </label><input type="text" name="pad" value="0" required><br>
      <label>Nível de oxigenação do sangue: </label><input type="text" name="oxi" value="0"><br>
      <label>Indicação de comprometimento dos orgãos vitais </label> <input type="checkbox" name="org"> <br>
      <input type="submit">
    </form>
  </body>
</html>
