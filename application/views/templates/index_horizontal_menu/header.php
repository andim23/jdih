<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
			<?php $this->load->view('templates/index_horizontal_menu/logo') ?>
		<!-- END LOGO -->
		<!-- BEGIN HORIZANTAL MENU -->
			<?php $this->load->view('templates/layout_horizontal_sidebar_menu/menu_h') ?>
		<!-- END HORIZANTAL MENU -->
		<!-- BEGIN HEADER SEARCH BOX -->
			<?php $this->load->view('templates/layout_horizontal_sidebar_menu/search_box') ?>
		<!-- END HEADER SEARCH BOX -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
			<?php $this->load->view('templates/layout_horizontal_sidebar_menu/menu_tnav') ?>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>