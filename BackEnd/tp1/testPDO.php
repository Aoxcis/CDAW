<?php
	require_once("initPDO.php");    // cf. doc / cours

	$request = $pdo->prepare("select * from users");
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_OBJ);
    $pdo = null;
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Test PDO</title>
</head>
<body>
    <h1>Test PDO</h1>
    <hr>
    <table>
        <tr>
            <th>id</th>
            <th>login</th>
            <th>email</th>
        </tr>
        <?php
            foreach($result as $row) {
                echo "<tr>";
                echo "<td>".$row->id."</td>";
                echo "<td>".$row->login."</td>";
                echo "<td>".$row->email."</td>";
                echo "</tr>";
            }
        ?>
    </table>
    <hr>
</body>
