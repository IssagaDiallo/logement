<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    $mysqli = new mysqli("localhost", "root", "issaga2003", "diallo");

    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
    }

    $sql = "UPDATE utilisateurs SET nom=?, email=?, mot_de_passe=? WHERE id=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssi", $nom, $email, $mot_de_passe, $id);

    if ($stmt->execute()) {
        $message = "Compte mis à jour avec succès";
    } else {
        $message = "Erreur lors de la mise à jour du compte: " . $mysqli->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un compte</title>
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

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
    
    
    
</head>

<body>
    <div class="container">
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <h1>Modifier un compte</h1>
        <form action="modifier.php" method="post">
            <label for="id">ID de l'utilisateur à modifier :</label>
            <input type="text" id="id" name="id" required><br>
            <label for="nom">Nouveau nom :</label>
            <input type="text" id="nom" name="nom" required><br>
            <label for="email">Nouvel email :</label>
            <input type="email" id="email" name="email" required><br>
            <label for="mot_de_passe">Nouveau mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>
            <input type="submit" value="Modifier">
        </form>
    </div>
</body>
</html>
