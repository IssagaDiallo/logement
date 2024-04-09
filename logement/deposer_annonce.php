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
        $message = "Annonce déposée avec succès";
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
        <h1>Déposer une annonce</h1>
        <form action="deposer_annonce.php" method="post">
            <label for="titre">Titre de l'annonce :</label>
            <input type="text" id="titre" name="titre" required><br>
            <label for="description">Description :</label>
            <textarea id="description" name="description" required></textarea><br>
            <input type="submit" value="Déposer">
        </form>
    </div>
</body>
</html>
