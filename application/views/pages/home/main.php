<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
        	<div class="col-md-12" align="center">
            	<h1>Tahun <?= date('Y') ?></h1>
            </div>
        </div>
        
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