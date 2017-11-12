<header id="nav" class="header header-1 no-transparent mobile-no-transparent">
          
  <div class="header-wrapper">
    <div class="container-m-30 clearfix">
      <div class="logo-row">
      
        <!-- LOGO --> 
        <div class="logo-container-2">
            <div class="logo-2">
              <a href="index.html" class="clearfix">
                <img src="<?= base_url() ?>theme/assets/admin/layout/img/logo.png" class="logo-img" alt="Logo">
              </a>
            </div>
        </div>
        <!-- BUTTON --> 
        <div class="menu-btn-respons-container">
            <button type="button" class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target="#main-menu .navbar-collapse">
                <span aria-hidden="true" class="icon_menu hamb-mob-icon"></span>
            </button>
        </div>
     </div>
    </div>

    <!-- MAIN MENU CONTAINER -->
    <div class="main-menu-container">
        <div class="container-m-30 clearfix">	
            <!-- MAIN MENU -->
            <div id="main-menu">
                  <div class="navbar navbar-default" role="navigation">
                    <!-- MAIN MENU LIST -->
                    <?php include("tnav.php") ?>
                  </div>
            </div>
            <!-- END main-menu -->
        </div>
        <!-- END container-m-30 --> 
    </div>
    <!-- END main-menu-container -->
    
  </div>
  <!-- END header-wrapper -->
  
</header>