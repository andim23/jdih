<h2 class="section-title mb-50"><?= isset($title)?strtoupper($title):""; ?></h2>

<?php
	$filename = isset($result[0]->filename)?$result[0]->filename:"";
?>
<?php
	if( !empty($filename) ){
?>
    <div class="post-prev-img">
      <a href="<?= base_url() ?>upload/konten_statis/<?= $filename ?>"><img src="<?= base_url() ?>upload/konten_statis/<?= $filename ?>" alt="img"></a>
    </div>
<?php } ?>

<?= isset($result[0]->isi)?$result[0]->isi:""; ?>