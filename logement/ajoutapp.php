<?php
function addAppartement($titre, $description) {
    $mysqli = connect();

    $sql = "INSERT INTO appartements (titre, description) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $titre, $description);
    if ($stmt->execute()) {
        echo "Appartement ajouté avec succès";
    } else {
        echo "Erreur lors de l'ajout de l'appartement: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}

function editAppartement($appartement_id, $titre, $description) {
    $mysqli = connect();

    $sql = "UPDATE appartements SET titre=?, description=? WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssi", $titre, $description, $appartement_id);

    if ($stmt->execute()) {
        echo "Appartement modifié avec succès";
    } else {
        echo "Erreur lors de la modification de l'appartement: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}

function deleteAppartement($appartement_id) {
    $mysqli = connect();

    $sql = "DELETE FROM appartements WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $appartement_id);

    if ($stmt->execute()) {
        echo "Appartement supprimé avec succès";
    } else {
        echo "Erreur lors de la suppression de l'appartement: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>
<?php
include_once 'fonctions.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'add':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $titre = $_POST["titre"];
                $description = $_POST["description"];
                addAppartement($titre, $description);
            }
            break;
        case 'edit':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $appartement_id = $_POST["appartement_id"];
                $titre = $_POST["titre"];
                $description = $_POST["description"];
                editAppartement($appartement_id, $titre, $description);
            }
            break;
        case 'delete':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $appartement_id = $_POST["appartement_id"];
                deleteAppartement($appartement_id);
            }
            break;
        default:
            echo "Action non reconnue";
            break;
    }
}
?>

<form action="?action=add" method="post">
    <label for="titre">Titre de l'appartement :</label>
    <input type="text" id="titre" name="titre" required><br>
    <label for="description">Description :</label>
    <textarea id="description" name="description" required></textarea><br>
    <input type="submit" value="Ajouter">
</form>
<form action="?action=edit" method="post">
    <input type="hidden" name="appartement_id" value="ID de l'appartement à modifier">
    <label for="titre">Nouveau titre de l'appartement :</label>
    <input type="text" id="titre" name="titre" required><br>
    <label for="description">Nouvelle description :</label>
    <textarea id="description" name="description" required></textarea><br>
    <input type="submit" value="Modifier">
</form>
<form action="?action=delete" method="post">
    <input type="hidden" name="appartement_id" value="ID de l'appartement à supprimer">
    <input type="submit" value="Supprimer">
</form>

