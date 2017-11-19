<?php
	$biro = isset($user[0]->biro)?$user[0]->biro.'<br>':'';
?>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
        	<div class="col-md-12" align="center">
            	<h1>
                	<?= $biro ?>
                	Tahun <?= date('Y') ?>
                </h1>
            </div>
        </div>
        <?php if( $this->auth_role != 'admin' ){ ?>
        <div class="row margin-top-20 margin-bottom-20">
        	<?php include('latest_permohonan.php'); ?>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-6">
				<?php include('summary_permohonan_status.php') ?>
            </div>
 
            <div class="col-md-6">
				<?php include('summary_kategori_produk.php') ?>
            </div>
        </div>
    </div>
</div>