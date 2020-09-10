<?php

$logoSrc = "../dist/img/AdminLTELogo.png";
$userImageSrc = "../dist/img/user2-160x160.jpg";
$userName = "Alexander Pierce";

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
      
    <!-- Brand Logo -->
    <a href="../dashboard.php" class="brand-link"> 
      <img src="<?php echo $logoSrc; ?>" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">eRisiko</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $userImageSrc; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $userName; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a id="item-dashboard" href="../index/dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
            <!--- PENGGUNA -->
          <li class="nav-header">MODUL PENGGUNA</li>
              <li class="nav-item">
                <a id="item-semakan-isu" href="../modul_pengguna/semakan_isu.php?t=Semakan Isu" class="nav-link">
                  <i class="fas fa-edit nav-icon"></i>
                  <p>Semakan Risiko</p>
                </a>
              </li>
            <li class="nav-item">
                <a id="item-dokumen-isu" href="../modul_pengguna/isu_terkini.php?t=Isu" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Dokumen isu</p>
                </a>
              </li>
            <!--- URUSETIA -->
          <li class="nav-header">MODUL URUSETIA</li>
            <li class="nav-item">
                <a id="item-tetapan-semakan-isu" href="../modul_urusetia/tetapan_semakan_isu.php?t=Tetapan Semakan Isu" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Tetapan Semakan Isu</p>
                </a>
              </li>
            <li class="nav-item">
                <a id="item-tetapan-keluaran-isu" href="../modul_urusetia/tetapan_keluaran_isu.php?t=Tetapan Keluaran Isu" class="nav-link">
                  <i class="fas fa-outdent nav-icon"></i>
                  <p>Tetapan Keluaran Isu</p>
                </a>
              </li>

            <!--- JK RISIKO -->
          <li class="nav-header">MODUL JAWATANKUASA RISIKO</li>
            <li class="nav-item">
                <a id="item-sejarah-bilangan" href="../modul_jkrisiko/sejarah_bilangan.php?t=Sejarah Bilangan" class="nav-link">
                  <i class="fas fa-history nav-icon"></i>
                  <p>Sejarah Bilangan</p>
                </a>
              </li>
            <li class="nav-item">
                <a id="item-luluskan-bilangan" href="../modul_jkrisiko/luluskan_bilangan.php?t=Luluskan Bilangan" class="nav-link">
                  <i class="fas fa-clipboard-check nav-icon"></i>
                  <p>Luluskan Bilangan</p>
                </a>
              </li>
            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>