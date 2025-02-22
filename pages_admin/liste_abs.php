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
$sql = "SELECT * FROM abscences";

// Vérifiez si un critère de recherche est défini
if (!empty($search_criteria) && !empty($keyword)) {
    $sql .= " WHERE $search_criteria LIKE '%$keyword%'";
}

// Opération de suppression d'une absence
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql_delete = "DELETE FROM abscences WHERE id_abscence = $id";
  if ($conn->query($sql_delete) === TRUE) {
      echo '<script>alert("Absence supprimée avec succès"); window.location.href = "liste_abs.php";</script>'; 
      exit(); // Assurez-vous qu'aucun autre code PHP ne s'exécute après la redirection
  } else {
      echo "Erreur lors de la suppression de l'absence : " . $conn->error;
  }
}

// Récupération de la liste des absences depuis la base de données
$result = $conn->query($sql);
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
  <link rel="stylesheet" href="liste.css">
  <!-- End layout styles -->
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
      margin-left: 630px;
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
      <h3>Liste des Abscences</h3>
        <!-- Print button -->
  <button onclick="printTable()" class="print-btn">Imprimer</button>
   <div style="overflow-x: auto;"> 
   <div class="container" >
  
    <br>
   
    <table>
    <thead>
        <tr>
            <th>cin</th>
            <th>nom</th>
            <th>prénom</th>
            <th>grade</th>
            <th>durée</th>
            <th>date Absence</th>
            <th>id_officier</th>
            <th>cause</th>
         
       
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
                    <td><?php echo $row["grade"]; ?></td>
                    <td><?php echo $row["duree"]; ?></td>
                    <td><?php echo $row["date_absence"]; ?></td>
                    <td><?php echo $row["id_officier"]; ?></td>
                    <td><?php echo $row["cause"]; ?></td>
                
                    
                    <td>
                    <a href="modifier_absence.php?id=<?php echo $row['id_abscence']; ?>" class="edit-btn">Modifier</a>
                        <br>
                        <br>
                      
                        <a href="?delete=<?php echo $row['id_abscence']; ?>" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette absence?')">Supprimer</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">Aucune absence trouvée</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>




   </div>
   </div>
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
