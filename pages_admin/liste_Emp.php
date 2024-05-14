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


// Récupérer le critère de recherche sélectionné et le mot-clé de recherche
$search_criteria = isset($_GET['search_criteria']) ? $_GET['search_criteria'] : '';
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Construction de la requête SQL
$sql = "SELECT * FROM employees";

// Vérifiez si un critère de recherche est défini
if (!empty($search_criteria) && !empty($keyword)) {
    $sql .= " WHERE $search_criteria LIKE '%$keyword%'";
}
// Opération de suppression d'un employé
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql_delete = "DELETE FROM employees WHERE id = $id";
  if ($conn->query($sql_delete) === TRUE) {
      echo '<script>alert("Employé supprimé avec succès"); window.location.href = "liste_Emp.php";</script>'; 
      exit(); // Assurer qu'il n'y a pas d'exécution supplémentaire du code PHP après la redirection
  } else {
      echo "Erreur lors de la suppression de l'employé : " . $conn->error;
  }
}

// Récupération de la liste des employés depuis la base de données
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Liste des Employés</title>
  <!-- CSS styles -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/css/demo/style.css">
  <link rel="stylesheet" href="liste.css">
  <!-- End CSS styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
  <style>
    /* Custom styles */
    .print-btn-container {
      text-align: right; /* Align to the right */
      margin-bottom: 20px; /* Add some space below the button */
    }
    .print-btn {
      padding: 10px 20px;
      background-color: #008080;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .print-btn:hover {
      background-color: #0056b3;
    }
    .hide-on-print {
      display: none; /* Hide elements when printing */
    }
  </style>
  <style>
    /* Custom styles */
    .print-btn-container {
      text-align: right; /* Align to the right */
      margin-bottom: 20px; /* Add some space below the button */
    }
    .print-btn {
      padding: 10px 20px;
      background-color: #008080;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-left: 1000px;
    }
    .print-btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <script src="../assets/js/preloader.js"></script>

  <?php include('header.html'); ?>
  <br>
  <br>
  <h2>Liste des Employés</h2>

  <!-- Print button -->
  <button onclick="printTable()" class="print-btn">Imprimer</button>


  <div style="overflow-x: auto;"> 
    <div class="container">
      <br>
      <table id="tableau-employes">
        <thead>
          <tr>
            <th>CIN</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Age</th>
            <th>Adresse</th>
            <th>Nom_mère</th>
            <th>Date_naissance</th>
            <th>id_unique</th>
            <th>id_officier</th> 
            <th>Grade</th>
            <th>Groupe_sanguin</th>
            <th>État_civil</th>
            <th>Téléphone</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?php echo $row["cin"]; ?></td>
                <td><?php echo $row["nom"]; ?></td>
                <td><?php echo $row["prenom"]; ?></td>
                <td><?php echo $row["age"]; ?></td>
                <td><?php echo $row["adresse"]; ?></td>
                <td><?php echo $row["nom_mere"]; ?></td>
                <td><?php echo $row["date_naissance"]; ?></td>
                <td><?php echo $row["id_unique"]; ?></td>
                <td><?php echo $row["id_officier"]; ?></td>
                <td><?php echo $row["grade"]; ?></td>
                <td><?php echo $row["groupe_sanguin"]; ?></td>
                <td><?php echo $row["etat_civil"]; ?></td>
                <td><?php echo $row["tel"]; ?></td>
                <td>
                  <a href="modifier.php?id=<?php echo $row['id']; ?>" class="edit-btn">Modifier</a>
                  <br>
                  <br>
                  <a href="?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé?')">Supprimer</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="13">Aucun employé trouvé</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- JavaScript plugins -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- Plugin js for this page-->
  <script src="../assets/vendors/chartjs/Chart.min.js"></script>
  <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- End plugin js for this page-->
  <!-- Custom js for this page-->
  <script src="../assets/js/material.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/dashboard.js"></script>
  <!-- End custom js for this page-->
  <script>
  function printTable() {
    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Table des Employés</title>');
    printWindow.document.write('<style>');
    printWindow.document.write('table { border-collapse: collapse; width: 100%; }');
    printWindow.document.write('th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }');
    printWindow.document.write('tr:nth-child(even) { background-color: #f2f2f2; }');
    printWindow.document.write('th { background-color: #4CAF50; color: white; }');
    printWindow.document.write('</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(document.querySelector('table').outerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
    window.onafterprint = function() {
      printWindow.close();
    }
  }
</script>



</body>
</html>
