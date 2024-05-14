<?php
// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "rh_db");

// Vérification de la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué: " . mysqli_connect_error());
}

// Récupérer le nombre d'employés
$sql_employes = "SELECT COUNT(*) AS total_employes FROM employees";
$result_employes = mysqli_query($conn, $sql_employes);
$row_employes = mysqli_fetch_assoc($result_employes);
$total_employes = $row_employes['total_employes'];

// Récupérer le nombre de congés
$sql_conges = "SELECT COUNT(*) AS total_conges FROM congees";
$result_conges = mysqli_query($conn, $sql_conges);
$row_conges = mysqli_fetch_assoc($result_conges);
$total_conges = $row_conges['total_conges'];

// Récupérer le nombre d'absences
$sql_absences = "SELECT COUNT(*) AS total_absences FROM abscences";
$result_absences = mysqli_query($conn, $sql_absences);
$row_absences = mysqli_fetch_assoc($result_absences);
$total_absences = $row_absences['total_absences'];

// Fermer la connexion à la base de données
mysqli_close($conn);
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
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<script src="../assets/js/preloader.js"></script>
  <div class="body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    
  <aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
    <div class="mdc-drawer__header">
      <a href="index.html" class="brand-logo">
       
      </a>
    </div>
    <div class="mdc-drawer__content">

      <div class="mdc-list-group">
        <nav class="mdc-list mdc-drawer-menu">
          <div class="mdc-list-item mdc-drawer-item">
            <a class="mdc-drawer-link" href="../demo/index.php">
              <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
              Dashboard
            </a>
          </div>
          <div class="mdc-list-item mdc-drawer-item">
            <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="sample-page-submenu-employees">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">group</i>
                Gestion Employés
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
            </a>
            <div class="mdc-expansion-panel" id="sample-page-submenu-employees">
                <nav class="mdc-list mdc-drawer-submenu">
                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="../pages_admin/Ajouter_Emp.php">
                            Ajouter employé
                        </a>
                    </div>
                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="../pages_admin/liste_Emp.php">
                            Liste des Employés
                        </a>
                    </div>
                </nav>
            </div>
        </div>
        
          
          <div class="mdc-list-item mdc-drawer-item">
            <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="sample-page-submenu">
              <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pages</i>
              Congés
              <i class="mdc-drawer-arrow material-icons">chevron_right</i>
            </a>
            <div class="mdc-expansion-panel" id="sample-page-submenu">
              <nav class="mdc-list mdc-drawer-submenu">
                <div class="mdc-list-item mdc-drawer-item">
                  <a class="mdc-drawer-link" href="../pages_admin/Ajouter_conge.php">
                    Ajouter congés
                  </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                  <a class="mdc-drawer-link" href="../pages_admin/liste_conge.php">
                  Liste des congés
                  </a>
                </div>
              </nav>
            </div>
          </div>
          <div class="mdc-list-item mdc-drawer-item">
            <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="sample-page-submenu-absences">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">event_busy</i>
                 Absences
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
            </a>
            <div class="mdc-expansion-panel" id="sample-page-submenu-absences">
                <nav class="mdc-list mdc-drawer-submenu">
                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="../pages_admin/abscence.php">
                            Ajouter absence
                        </a>
                    </div>
                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="../pages_admin/liste_abs.php">
                            Liste des Absences
                        </a>
                    </div>
                </nav>
            </div>
        </div>
        

        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="sample-page-submenu-consultations">
              <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">local_hospital</i>
              Consultations
              <i class="mdc-drawer-arrow material-icons">chevron_right</i>
          </a>
          <div class="mdc-expansion-panel" id="sample-page-submenu-consultations">
              <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                      <a class="mdc-drawer-link" href="../pages_admin/consultation.php">
                        Ajouter consultation
                      </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                      <a class="mdc-drawer-link" href="../pages_admin/liste_consultations.php">
                          Liste consultations
                      </a>
                  </div>
              </nav>
              
          </div>
               </div>

      <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="sample-page-submenu-sanctions">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">warning</i>
            Sanctions
            <i class="mdc-drawer-arrow material-icons">chevron_right</i>
        </a>
        <div class="mdc-expansion-panel" id="sample-page-submenu-sanctions">
            <nav class="mdc-list mdc-drawer-submenu">
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="../pages_admin/sanction.php">
                        Nouvelle sanction
                    </a>
                </div>
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="../pages_admin/liste_sanctions.php">
                        Liste des sanctions
                    </a>
                </div>
            </nav>
        </div>
    </div>
    
        
          
          
          
        </nav>
      </div>
      
      
    </div>
  </aside>
  
    <!-- partial -->
    <div class="main-wrapper mdc-drawer-app-content">
      <!-- partial:partials/_navbar.html -->
      <header class="mdc-top-app-bar">
        <div class="mdc-top-app-bar__row">
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
        
            <form method="GET" style="margin-top:2px; display: flex; justify-content: center; align-items: center;">
              <select name="search_criteria" style="padding: 10px; font-size: 16px; border: none; border-radius: 20px; margin-right: 10px; background-color: #f2f2f2;">
                  <option value="id_officier">ID Officer</option>
                  <option value="cin">CIN</option>
                  <option value="id_unique">ID Unique</option>
              </select>
              <input type="text" name="keyword" placeholder="Rechercher..." style="padding: 11px; font-size: 16px; border: none; border-radius: 20px; margin-right: 10px; background-color: #f2f2f2; width: 200px;">
              <button type="submit" style="padding: 10px 10px;margin-bottom: 2px; font-size: 16px; border: none; border-radius: 20px; background-color: #007bff; color: #fff; cursor: pointer; transition: background-color 0.3s ease;">Rechercher</button>
          </form>
          </div>
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
            <div class="menu-button-container menu-profile d-none d-md-block">
              <button class="mdc-button mdc-menu-button">
                <span class="d-flex align-items-center">
                  <span class="figure">
                    <img src="../assets/images/faces/téléchargement (2).jpg" alt="user" class="user">
                  </span>
                  <span class="user-name">Administrateur</span>
                </span>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
             
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <a href="../pages_admin/modifier_profil.php" class="item-content d-flex align-items-start">
                      <div class="item-thumbnail item-thumbnail-icon-only">
                        <i class="mdi mdi-account-edit-outline text-primary"></i>
                      </div>
                      <div class="item-content">
                        <h6 class="item-subject font-weight-normal">Edit profile</h6>
                      </div>
                    </a>
                  </li>
                  <li class="mdc-list-item" role="menuitem">
                    <a href="../pages_admin/logout.php" class="item-content d-flex align-items-start">
                      <div class="item-thumbnail item-thumbnail-icon-only">
                        <i class="mdi mdi-settings-outline text-primary"></i>                      
                      </div>
                      <div class="item-content">
                        <h6 class="item-subject font-weight-normal">Logout</h6>
                      </div>
                    </a>
                  </li>
                </ul>
                
              </div>
            </div>
            <div class="divider d-none d-md-block"></div>
            <div class="menu-button-container d-none d-md-block">
              <button class="mdc-button mdc-menu-button">
              </button>
              
            </div>
            <div class="menu-button-container">
              <button class="mdc-button mdc-menu-button">
                <i class="mdi mdi-bell"></i>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <h6 class="title"> <i class="mdi mdi-bell-outline mr-2 tx-16"></i> Notifications</h6>
                
              </div>
            </div>
            <div class="menu-button-container">
              <button class="mdc-button mdc-menu-button">
                <i class="mdi mdi-email"></i>
                <span class="count-indicator">
                  <span class="count">3</span>
                </span>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <h6 class="title"><i class="mdi mdi-email-outline mr-2 tx-16"></i> Messages</h6>
                
              </div>
            </div>
            
          </div>
        </div>
      </header>
     
      <!-- partial -->
  <div id="employee_data">
        <!-- Les données d'employés, de congés et d'absences seront affichées ici -->
   
    
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
    <br>
    <br>
    <h3 style="text-align: center;">Administrateur Dashboard</h3>
    <br>
    <br>
    <main class="content-wrapper">
        <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
    <div class="mdc-card info-card info-card--success">
        <div class="card-inner">
            <h5 class="card-title" >Employés</h5>
           
            <h5 class="font-weight-light pb-2 mb-1 border-bottom"><?php echo $total_employes; ?></h5>
            <div class="card-icon-wrapper">
                <i class="material-icons">people</i>
            </div>
        </div>
    </div>
</div>

                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                    <div class="mdc-card info-card info-card--info">
                        <div class="card-inner">
                            <h5 class="card-title">Congés</h5>
                        
                            <h5 class="font-weight-light pb-2 mb-1 border-bottom"><?php echo $total_conges; ?></h5>
                            <div class="card-icon-wrapper">
                                <i class="material-icons">credit_card</i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                    <div class="mdc-card info-card info-card--danger">
                        <div class="card-inner">
                            <h5 class="card-title">Absences</h5>
                           
                            <h5 class="font-weight-light pb-2 mb-1 border-bottom"><?php echo $total_absences; ?></h5>
                            <div class="card-icon-wrapper">
                                <i class="material-icons">warning</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</div>
       
  <!-- plugins:js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
