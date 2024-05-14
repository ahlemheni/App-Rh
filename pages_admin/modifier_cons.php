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

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $cin = $_POST["cin"];
    $date_consultation = $_POST["date_consultation"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $id_unique = $_POST["id_unique"];
    $id_officier = $_POST["id_officier"];
    $tel = $_POST["tel"];
    $commentaire = $_POST["commentaire"];
    $id_consultation = $_POST["id_consultation"]; // Utilisation correcte de id_consultation

    // Préparation de la requête SQL pour mettre à jour la consultation
    $sql = "UPDATE service_medicale SET cin=?, date_consultation=?, nom=?, prenom=?, id_unique=?, id_officier=?, tel=?, commentaire=? WHERE id_consultation=?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Liaison des paramètres
    $stmt->bind_param("ssssiiisi", $cin, $date_consultation, $nom, $prenom, $id_unique, $id_officier, $tel, $commentaire, $id_consultation);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Redirection vers une autre page après la modification
        header("Location: liste_consultations.php");
        exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
    } else {
        echo "Erreur lors de la mise à jour de la consultation : " . $conn->error;
    }

    // Fermeture du statement
    $stmt->close();
}

// Récupération de l'identifiant de la consultation à modifier
$id_consultation = $_GET['id']; // Supposons que vous passez l'ID de la consultation par l'URL

// Récupération des données de la consultation à modifier
$sql = "SELECT * FROM service_medicale WHERE id_consultation=$id_consultation";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Aucune consultation trouvée avec cet identifiant.";
}

// Fermeture de la connexion
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
  <!-- End plugin css for this page -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/demo/style.css">
  <link rel="stylesheet" href="ajout.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>
<body>
<script src="../assets/js/preloader.js"></script>
  <?php include('header.html'); ?>
  <br>
  <h2>Modifier Consultation</h2>

  <form action="" method="post">

    <div class="form-group">
        <input type="hidden" name="id_consultation" value="<?php echo $row['id_consultation']; ?>">
        <label for="cin">CIN :</label>
        <input type="text" id="cin" name="cin" value="<?php echo $row['cin']; ?>">
    </div>
    <div class="form-group">
        <label for="nom">date_consultation :</label>
        <input type="text" id="date_consultation" name="date_consultation" value="<?php echo $row['date_consultation']; ?>">
    </div>
    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $row['nom']; ?>">
    </div>
    <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $row['prenom']; ?>">
    </div>
    <div class="form-group">
        <label for="grade">id_unique :</label>
        <input type="text" id="id_unique" name="id_unique" value="<?php echo $row['id_unique']; ?>">
    </div>
    <div class="form-group">
        <label for="id_officier">id_officier :</label>
        <input type="text" id="id_officier" name="id_officier" value="<?php echo $row['id_officier']; ?>">
    </div>
    <div class="form-group">
        <label for="duree">tel :</label>
        <input type="text" id="tel" name="tel" value="<?php echo $row['tel']; ?>">
    </div>
    <div class="form-group">
        <label for="commentaire">commentaire:</label>
        <input type="text" id="commentaire" name="commentaire" value="<?php echo $row['commentaire']; ?>">
    </div>
  

    <button type="submit" style="background: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; margin-bottom: 10%; margin-top: 0%; width: 20%; padding: 10px; margin-left: 40%; border: 1px solid #ccc; border-radius: 5px;">Modifier</button>
  </form>
 
  <!-- plugins:js -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="../assets/vendors/chartjs/Chart.min.js"></script>
  <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../assets/js/material.js"></script>
  <script src="../assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../assets/js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>
</html>
