<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];

    $mysqli = new mysqli("localhost", "root", "issaga2003", "diallo");

    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
    }

    $sql = "DELETE FROM utilisateurs WHERE email=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $message = "Compte supprimé avec succès";
    } else {
        $message = "Erreur lors de la suppression du compte: " . $mysqli->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supprimer un compte</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #dc3545;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #c82333;
}

    </style>
</head>
<body>
    <div class="container">
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <h1>Supprimer un compte</h1>
        <form action="supprimer.php" method="post">
            <label for="email">Email de l'utilisateur à supprimer :</label>
            <input type="email" id="email" name="email" required><br>
            <input type="submit" value="Supprimer">
        </form>
    </div>
</body>
</html>
