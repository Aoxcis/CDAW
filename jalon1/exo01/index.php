<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Exo 01 - PHP</title>
</head>
<body>
  <p>
    <h1>Exo 01 - PHP</h1>
    <h2>Heure actuelle</h2>
    <?php
    date_default_timezone_set('Europe/Paris');
      echo date('H:i');
    ?>
  </p>
</body>