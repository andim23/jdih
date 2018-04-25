<?php
	foreach($sekilas as $row){
?>
<div class="page-section grey-light-bg clearfix">
  <div class="fes7-img-cont col-md-5">
    <div class="fes7-img" style="background-image: url(<?= base_url() ?>upload/konten_statis/<?= $row->filename ?>)" ></div>
  </div>
  
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-6 fes7-text-cont p-80-cont">
        <h1><span class="font-light"><?= $row->judul ?></span></h1>
        <p class="mb-60">
          <?= $row->isi ?>
        </p>
      </div>
    </div><!--end of row-->
  </div>
</div> 
<?php
	}
?>