<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaires</title>
</head>
<body>
    <h2>Ajouter un commentaire</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="commentaire" placeholder="Saisissez votre commentaire" required>
        <button type="submit" name="submit">Envoyer</button>
    </form>

    <h2>Commentaires existants</h2>
    <div>
        <?php
        // Connexion à la base de données
        $servername = "";
        $username = "tsilavina";
        $password = "";
        $dbname = "";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insertion du commentaire dans la base de données
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            $commentaire = $_POST["commentaire"];
            $sql = "INSERT INTO commentaires (contenu) VALUES ('$commentaire')";
            if ($conn->query($sql) === TRUE) {
                echo "Commentaire ajouté avec succès";
            } else {
                echo "Erreur: " . $sql . "<br>" . $conn->error;
            }
        }

        // Récupération des commentaires depuis la base de données
        $sql = "SELECT contenu FROM commentaires";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row["contenu"] . "</p>";
            }
        } else {
            echo "Aucun commentaire trouvé";
        }

        // Fermeture de la connexion à la base de données
        $conn->close();
        ?>
    </div>
</body>
</html>
