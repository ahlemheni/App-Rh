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
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $grade = $_POST["grade"];
    $id_officier = $_POST["id_officier"];
    $date_sanction = $_POST["date_sanction"];
    $commentaire = $_POST["commentaire"];

    // Requête SQL pour insérer une nouvelle sanction dans la base de données
    $sql = "INSERT INTO sanctions (nom, prenom, grade, id_officier, date_sanction, commentaire) VALUES ('$nom', '$prenom', '$grade', '$id_officier', '$date_sanction', '$commentaire')";
    
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Consultation ajoutée avec succès"); window.location.href = "sanction.php";</script>';
        exit(); // Ensure no further PHP code execution after redirect
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}


// Fermeture de la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter une sanction</title>
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
    <link rel="stylesheet" href="cons.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
    <!-- Your custom styles -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <script src="../assets/js/preloader.js"></script>
    <?php include('header.html'); ?>
    <br>
    <h2>Ajouter une nouvelle sanction</h2>
    <br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div class="form-group">
            <label for="grade">Grade :</label>
            <input type="text" id="grade" name="grade">
        </div>
        <div class="form-group">
            <label for="id_aff">id_officier :</label>
            <input type="text" id="id_officier" name="id_officier">
        </div>
        <div class="form-group">
            <label for="date_sanction">Date_sanction :</label>
            <input type="date" id="date_sanction" name="date_sanction" required>
        </div>
        <div class="form-group">
            <label for="commentaire">Commentaire :</label>
            <textarea id="commentaire" name="commentaire"></textarea>
        </div>
        <button type="submit" style="background: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; margin-bottom: 10%; margin-top: 0%; width: 20%; padding: 10px; margin-left: 40%; border: 1px solid #ccc; border-radius: 5px;">Ajouter</button>
    </form>
    <!-- plugins:js -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <script>

</script>

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
