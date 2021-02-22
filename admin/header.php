<header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Web</b></span>
      <?php
      // Cek role user
      if($_SESSION['level'] == 'admin'){ // Jika role-nya admin
      ?>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b></span>
      <?php
      }
      ?>

      <?php
      // Cek role user
      if($_SESSION['level'] == 'staf'){ // Jika role-nya admin
      ?>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Staf</b></span>
      <?php
      }
      ?>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <?php
            // Cek role user
            if($_SESSION['level'] == 'admin'){ // Jika role-nya admin
            ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/avatar2.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/avatar2.png" class="img-circle" alt="User Image">
                <p>
                  Admin
                  <small>
                <?php
$tanggal= mktime(date("m"),date("d"),date("Y"));
echo "Tanggal : <b>".date("d-M-Y", $tanggal)."</b> ";
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");
echo "| Pukul : <b>". $jam." "."</b>";
$a = date ("H");
if (($a>=6) && ($a<=11)){
echo "<b>, Selamat Pagi..</b>";
}
else if(($a>11) && ($a<=15))
{
echo ", Selamat Siang..";}
else if (($a>15) && ($a<=18)){
echo ", Selamat Sore!!";}
else { echo ", <b> Selamat Malam.. </b>";}
?> 

              </small>
              </p>

              <?php
                }
              ?>

            <?php
            // Cek role user
            if($_SESSION['level'] == 'staf'){ // Jika role-nya admin
            ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/avatar2.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Staf</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/avatar2.png" class="img-circle" alt="User Image">
                <p>
                  Staf
                  <small>
                <?php
$tanggal= mktime(date("m"),date("d"),date("Y"));
echo "Tanggal : <b>".date("d-M-Y", $tanggal)."</b> ";
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");
echo "| Pukul : <b>". $jam." "."</b>";
$a = date ("H");
if (($a>=6) && ($a<=11)){
echo "<b>, Selamat Pagi..</b>";
}
else if(($a>11) && ($a<=15))
{
echo ", Selamat Siang..";}
else if (($a>15) && ($a<=18)){
echo ", Selamat Sore!!";}
else { echo ", <b> Selamat Malam.. </b>";}
?> 

                </small>
                </p>

              <?php
                }
              ?>

              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
              <?php
              // Cek role user
              if($_SESSION['level'] == 'admin'){ // Jika role-nya admin
              ?>
                <div class="pull-left">
                  <a href="kelola_admin.php" class="btn btn-default btn-flat">kelola admin</a>
                </div>
              <?php
                }
              ?>
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">log out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>