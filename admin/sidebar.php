<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar2.png" class="img-circle" alt="User Image">
        </div>
      <?php
      // Cek role user
      if($_SESSION['level'] == 'admin'){ // Jika role-nya admin
        ?>
        <div class="pull-left info">
          <p>Admin</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        <?php
        }
        ?>

      <?php
      // Cek role user
      if($_SESSION['level'] == 'staf'){ // Jika role-nya admin
        ?>
        <div class="pull-left info">
          <p>Staf</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        <?php
        }
        ?>
      </div>
      <!-- search form -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        

        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Home</span>
          </a>
        </li>

      <?php
      // Cek role user
      if($_SESSION['level'] == 'admin'){ // Jika role-nya admin
        ?>
        <li>
          <a href="kelola_pengguna.php">
            <i class="fa fa-files-o"></i> <span>Kelola Pengguna</span>
          </a>
        </li>
        <?php
        }
        ?>

      <?php
      // Cek role user
      if($_SESSION['level'] == 'staf'){ // Jika role-nya admin
        ?>
        <li>
          <a href="kelola_pengguna_unit.php">
            <i class="fa fa-files-o"></i> <span>Kelola Pengguna</span>
          </a>
        </li>
        <?php
        }
        ?> 

      <?php
      // Cek role user
      if($_SESSION['level'] == 'admin'){ // Jika role-nya admin
        ?>
        <li>
          <a href="kelola_unit.php">
            <i class="fa fa-files-o"></i> <span>Kelola Unit</span>
          </a>
        </li>
        <?php
        }
        ?>

        <li>
          <a href="kelola_kerjasama.php">
            <i class="fa fa-files-o"></i> <span>Kelola Kerjasama</span>
          </a>
        </li>      


        <li>
          <a href="kelola_visi&misi.php">
            <i class="fa fa-files-o"></i> <span>Kelola Visi & Misi</span>
          </a>
        </li>


        <li>
          <a href="kelola_album.php">
            <i class="fa fa-files-o"></i> <span>Kelola Album</span>
          </a>
        </li>

        <li>
          <a href="kelola_galeri.php">
            <i class="fa fa-files-o"></i> <span>Kelola Galeri</span>
          </a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>