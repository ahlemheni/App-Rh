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
  $nom = $_POST["nom"];
  $prenom = $_POST["prenom"];
  $age = $_POST["age"]; 
  $adresse = $_POST["adresse"];
  $nom_mere = $_POST["nom_mere"]; 
  $date_naissance = $_POST["date_naissance"];
  $id_unique = $_POST["id_unique"]; 
  $id_officier = $_POST["id_officier"]; 
  $grade = $_POST["grade"]; 
  $groupe_sanguin = $_POST["groupe_sanguin"]; 
  $etat_civil = $_POST["etat_civil"]; 
  $tel = $_POST["tel"];

  // Requête SQL pour insérer les données dans la base de données
 // Requête SQL pour insérer les données dans la base de données
$sql = "INSERT INTO employees (cin, nom, prenom, age, adresse, nom_mere, date_naissance, id_unique, id_officier, grade, groupe_sanguin, etat_civil, tel) VALUES ('$cin', '$nom', '$prenom', '$age', '$adresse', '$nom_mere', '$date_naissance', '$id_unique', '$id_officier', '$grade', '$groupe_sanguin', '$etat_civil', '$tel')";

  if ($conn->query($sql) === TRUE) {
     echo '<script>alert("Nouvel employé ajouté avec succès"); window.location.href = "Ajouter_Emp.php";</script>'; 
        // Assurez-vous qu'il n'y a pas d'exécution de code PHP supplémentaire après la redirection
     exit(); // Assurez-vous de terminer le script après la redirection
  } else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
  }
}

// Récupérer le critère de recherche sélectionné
$search_criteria = $_GET['search_criteria'] ?? ''; 
// Récupérer le mot-clé de recherche
$keyword = $_GET['keyword'] ?? ''; 

$sql = "SELECT * FROM employees";

// Vérifiez si un critère de recherche est défini
if (!empty($search_criteria) && !empty($keyword)) {
    $sql .= " WHERE $search_criteria LIKE '%$keyword%'";
}

$result = $conn->query($sql);

// Fermeture de la connexion
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
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
  <h2>Ajouter Employé</h2>
  <br>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  
    <div class="form-group">
        <label for="cin">CIN :</label>
        <input type="text" id="cin" name="cin" required>
    </div>
    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
    </div>
    <div class="form-group">
        <label for="prénom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
    </div>
    <div class="form-group">
        <label for="age">Age :</label>
        <input type="text" id="age" name="age" required>
    </div>
    <div class="form-group">
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse">
    </div>
    <div class="form-group">
        <label for="nom_mére">Nom_mère :</label>
        <input type="text" id="nom_mere" name="nom_mere">
    </div>
    <div class="form-group">
        <label for="date_naissance">Date_naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance">
    </div>
    <div class="form-group">
        <label for="id_unique">id_unique :</label>
        <input type="text" id="id_unique" name="id_unique">
    </div>
    <div class="form-group">
        <label for="id_officier">id_officier :</label>
        <input type="text" id="id_officier" name="id_officier">
    </div>
    <div class="form-group">
        <label for="grade">Grade :</label>
        <input type="text" id="grade" name="grade">
    </div>
    <div class="form-group">
        <label for="groupe_sanguin">Groupe_sanguin :</label>
        <input type="text" id="groupe_sanguin" name="groupe_sanguin">
    </div>
    <div class="form-group">
        <label for="etat_civil">État_civil :</label>
        <input type="text" id="etat_civil" name="etat_civil">
    </div>
    <div class="form-group">
        <label for="tel">Téléphone :</label>
        <input type="text" id="tel" name="tel">
    </div>
    <button type="submit" style="background: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; margin-bottom: 10%; margin-top: 0%; width: 20%; padding: 10px; margin-left: 40%; border: 1px solid #ccc; border-radius: 5px;">Ajouter</button>
</form>

</div>
          </div>
        </main>
      
   
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