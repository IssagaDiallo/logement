<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST["titre"];
    $description = $_POST["description"];

    $utilisateur_id = 1; 

    $mysqli = new mysqli("localhost", "root", "issaga2003", "diallo");

    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
    }

    $sql = "INSERT INTO annonces (titre, description, utilisateur_id) VALUES ('$titre', '$description', '$utilisateur_id')";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: authentifier.php");
        exit(); 
    } else {
        $message = "Erreur lors du dépôt de l'annonce: " . $mysqli->error;
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Déposer une annonce</title>
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
        textarea {
            width: 20%;
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

        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="titre">Titre de l'annonce :</label>
        <input type="text" id="titre" name="titre" required><br>
        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea><br>
        <input type="submit" value="Déposer">
    </form>
    <p><a href="connexion.php">Déjà un compte? Authentifiez-vous ici</a></p>
    <p><a href="creer_compte.php">Pas encore de compte? Créez-en un ici</a></p>
</body>
</html>
