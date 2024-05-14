<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rh_db";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupération du CIN de l'employé depuis l'URL
$cin = isset($_GET['cin']) ? $_GET['cin'] : '';

// Requête SQL pour rechercher l'employé par CIN
$sql = "SELECT * FROM employees WHERE cin = '$cin'";
$result = $conn->query($sql);

// Affichage des résultats de la recherche
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<p>CIN: " . $row["cin"]. "</p>";
        // Affichez d'autres informations sur l'employé ici
    }
} else {
    echo "<p>Aucun employé trouvé avec ce CIN.</p>";
}

$conn->close();
?>
