<!-- PAGE TITLE SMALL -->
<!--background-image: url(<?= base_url() ?>theme/templates/frontend2/images/about-me.jpg)-->
<div class="page-title-cont page-title-large grey-dark-bg page-title-img  pt-100" 
	style="background-image: url(<?= base_url() ?>theme/templates/frontend2/images/about-me.jpg"
>
  	<?php $this->load->view('pages/frontend/pencarian/cari_single'); ?>
</div>

<!-- COTENT CONTAINER -->
<div class="container mt-20">
	<?php include("slider.php"); ?>
</div>
<div class="container">
	<?php include("latest_news.php"); ?>
</div>


<?php include("about_jdih.php"); ?>