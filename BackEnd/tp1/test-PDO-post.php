<?php
	require_once("initPDO.php");    // cf. doc / cours

	$request = $pdo->prepare("select * from users");
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_OBJ);
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

    <form method="post" action="">
        <label for="login">Login : </label>
        <input type="text" name="login" placeholder="login"><br>
        <label for="email">Email : </label>
        <input type="text" name="email" placeholder="email"><br>
        <input type="submit" value="Ajouter">
    </form>

    <?php
        $login = $_POST['login'];
        $email = $_POST['email'];

        if (!empty($login) && !empty($email)) {
            $stmt = $pdo->prepare("INSERT INTO users (login, email) VALUES (:login, :email)");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':email', $email);

            $stmt->execute();
        }
        $pdo = null;
    ?>

</body>
