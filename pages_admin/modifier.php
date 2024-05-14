<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = ""; // Note: You should use a secure password in a production environment.
$dbname = "rh_db";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $cin = $_POST["cin"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $age = $_POST["age"];
    $adresse = $_POST["adresse"];
    $nom_mere = $_POST["nom_mere"];
    $date_naissance = $_POST["date_naissance"];
    $id_unique = $_POST["id_unique"];
    $id_afficier = $_POST["id_officier"];
    $grade = $_POST["grade"];
    $groupe_sanguin = $_POST["groupe_sanguin"];
    $etat_civil = $_POST["etat_civil"];
    $tel = $_POST["tel"];
    $id = $_POST["id"]; // Ajout de la récupération de l'ID

    // Préparation de la requête SQL pour mettre à jour l'employé
    $sql = "UPDATE employees SET cin=?, nom=?, prenom=?, age=?, adresse=?, nom_mere=?, date_naissance=?, id_unique=?, id_officier=?, grade=?, groupe_sanguin=?, etat_civil=?, tel=? WHERE id=?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Liaison des paramètres
    $stmt->bind_param("ssssssissssssi", $cin, $nom, $prenom, $age, $adresse, $nom_mere, $date_naissance, $id_unique, $id_afficier, $grade, $groupe_sanguin, $etat_civil, $tel, $id);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Rediriger vers une autre page après la modification
        header("Location: liste_Emp.php");
        exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
    } else {
        echo "Erreur lors de la mise à jour des informations de l'employé : " . $conn->error;
    }

    // Fermeture du statement
    $stmt->close();
}

// Récupération des données de l'employé à modifier
$id = $_GET['id']; // Supposons que vous passez l'ID de l'employé par l'URL
$sql = "SELECT * FROM employees WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Aucun employé trouvé avec cet identifiant.";
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
  <title>Modifier Employé</title>
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

   
      <h2>Modifier Employé</h2>
  <br>
  <form action="" method="post">
    <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="cin">CIN :</label>
        <input type="text" id="cin" name="cin" value="<?php echo $row['cin']; ?>">
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
        <label for="age">Age :</label>
        <input type="text" id="age" name="age" value="<?php echo $row['age']; ?>">
    </div>
    <div class="form-group">
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" value="<?php echo $row['adresse']; ?>">
    </div>
    <div class="form-group">
        <label for="nom_mere">Nom_mère :</label>
        <input type="text" id="nom_mere" name="nom_mere" value="<?php echo $row['nom_mere']; ?>">
    </div>
    <div class="form-group">
        <label for="date_naissance">Date_naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance" value="<?php echo $row['date_naissance']; ?>">
    </div>
    <div class="form-group">
        <label for="id_unique">id_unique :</label>
        <input type="text" id="id_unique" name="id_unique" value="<?php echo $row['id_unique']; ?>">
    </div>
    <div class="form-group">
        <label for="id_officier">id_officier :</label>
        <input type="text" id="id_officier" name="id_officier" value="<?php echo $row['id_officier']; ?>">
    </div>
    <div class="form-group">
        <label for="groupe_sanguin">Grade:</label>
        <input type="text" id="grade" name="grade" value="<?php echo $row['grade']; ?>">
    </div>
    <div class="form-group">
        <label for="groupe_sanguin">Groupe_sanguin :</label>
        <input type="text" id="groupe_sanguin" name="groupe_sanguin" value="<?php echo $row['groupe_sanguin']; ?>">
    </div>
    <div class="form-group">
        <label for="etat_civil">État_civil :</label>
        <input type="text" id="etat_civil" name="etat_civil" value="<?php echo $row['etat_civil']; ?>">
    </div>
    <div class="form-group">
        <label for="tel">Téléphone :</label>
        <input type="number" id="tel" name="tel" value="<?php echo $row['tel']; ?>">
    </div>
    
    <button type="submit" style="background: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; margin-bottom: 10%; margin-top: 0%; width: 20%; padding: 10px; margin-left: 40%; border: 1px solid #ccc; border-radius: 5px;">Modifier</button>
</form>

   
</div>
          </div>
        </main>
        <!-- partial:partials/_footer.html -->
        
        <!-- partial -->
      </div>
    </div>
  </div>
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
