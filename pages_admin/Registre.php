<?php
// Établir la connexion à MySQL
$servername = "localhost";
$username = "root"; // nom d'utilisateur XAMPP par défaut
$password = ""; // mot de passe XAMPP par défaut
$database = "rh_db";

$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Traitement du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hacher le mot de passe

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Affichage de l'alerte
        echo '<script type="text/javascript">';
        echo 'alert("Inscription réussie !")';
        echo '</script>';
        // Redirection vers la page de connexion après 2 secondes
        echo '<script type="text/javascript">';
        echo 'setTimeout(function() { window.location = "Registre.php"; }, 0);';
        echo '</script>';
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Style de l'icône de la flèche */
        .back-icon {
            position: fixed;
            top: 20px; /* Ajustez la position verticale selon votre besoin */
            left: 20px; /* Ajustez la position horizontale selon votre besoin */
            font-size: 24px; /* Ajustez la taille de l'icône selon votre besoin */
            color: #fff; /* Couleur de l'icône */
            z-index: 9999; /* Assure que l'icône reste au-dessus des autres éléments */
        }
    </style>
</head>
    <body>
        <div class="wrapper">
            
        <h1> Register</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
               
                <div class="input-box" >
                    
                <input type="text" name="username" placeholder="Username" required><br>
            

                </div>
                <div class="input-boox">
                <input type="email" name="email" placeholder="E-mail" required><br>
                    
                    
                </div>
                <div class="input-booox">
               <input type="password" name="password" placeholder="Password" required><br>
                   
                    
                    
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">I agree to thr terms & conditions</label>
                   
                </div>
                <button type="submit" class="btn"value="Register">Register</button>

                <div class="register-link">
                    <p>Already have an account?
                        <a href="Login.php">Login</a>
                    </p>
                </div>

            </form>
        </div>
        
<!-- Icône de flèche -->
<a href="Login.php" class="back-icon"><i class='bx bx-arrow-back'></i></a>
    </body>
</html>