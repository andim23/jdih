<div class="mb-10">
    <h2 class="section-title pr-0">	PRODUK HUKUM <span class="bold">TERBARU</span></h2>
</div>

<div class="row">  
    <!-- Post Item 1 -->
    <?php 
		foreach($terbaru as $rt){ 
		$arr_tanggal = explode(' ', TglIndoSaja($rt->tanggal));
		$tgl = $arr_tanggal[0];
		$bln = $arr_tanggal[1];
	?>
    <div class="col-md-12 wow fadeIn pb-30" >
        <div class="row">
            <div class="col-md-5 blog2-post-title-cont">
                <div class="post-prev-date-cont">
                    <span class="blog2-date-numb"><?= $tgl ?></span><span class="blog2-month"><?= $bln ?></span>
                </div>
                
                <div class="post-prev-title">
                    <h3><a href="<?= base_url() ?>frontend/detail/<?= $rt->id_kategori ?>/<?= $rt->id_produk_hukum ?>"><?= $rt->judul ?></a></h3>
                    <div class="post-prev-info">
                        <a href="<?= base_url() ?>frontend/produk_hukum_per_kategori/<?= $rt->id_kategori ?>"><?= $rt->kategori ?></a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-7">
                <div class="blog2-post-prev-text" style="text-align:justify;">                     
                    <?= PotongKata($rt->isi,50) ?>                   
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- Post Item 1 -->
</div>
