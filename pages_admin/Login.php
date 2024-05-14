<?php
session_start();

// Establish MySQL connection
$servername = "localhost";
$username = "root"; // default XAMPP username
$password = ""; // default XAMPP password
$database = "rh_db";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variable to hold error message
$error_message = "";

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["email"] = $email;
            // Redirect to a logged-in page
            header("Location: ../demo/index.php");
            exit; // Make sure to exit after redirection
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "User not found!";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html>
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
<?php
    // Affichage du message d'erreur avec une marge à droite de 100px si le message n'est pas vide
    if (!empty($error_message)) {
        echo "<div style='color: red'>" . $error_message . "</div>";
    }
?>


    <h1> Login</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="input-box">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-boox">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="remember-forgot">
            <label><input type="checkbox">Remember me</label>
            <a href="#">Forgot password?</a>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="register-link">
            <p>Don't have an account?
                <a href="Registre.php">Register</a>
            </p>
        </div>
    </form>
   
</div>

<!-- Icône de flèche -->
<a href="../index.html" class="back-icon"><i class='bx bx-arrow-back'></i></a>

</body>
</html>
