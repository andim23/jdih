<div class="row">
    <div class="col-md-12">  
        <?php foreach($detail as $row){ ?>
        <form id="form" action="<?= base_url() ?>Permohonan/simpan_json" method="POST" class="form-horizontal">
        
        <div class="form-group">
			<div class="col-md-12">
        		<h3>Detail Permohonan</h3>
        	</div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-3">No. Permohonan</label> 
            <div class="col-md-9">
                <label class="control-label"><?= $row->no_permohonan ?></label>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-3">Pengusul</label> 
            <div class="col-md-9">
                <label class="control-label"><?= $row->pengusul ?></label>
            </div>
        </div>
        
        <div class="form-group">
           	<label class="control-label col-md-3">Jenis Produk Hukum</label>
            <div class="col-md-9">
                <label class="control-label"><?= $row->kategori ?></label>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-3">Judul Rancangan Produk Hukum</label> 
            <div class="col-md-9">
                <label class="control-label"><?= $row->judul ?></label>
            </div>
        </div>
        
        <div class="form-group">
			<div class="col-md-12">
        		<h3>Kelengkapan Dokumen</h3>
        	</div>
        </div>
        
        <div class="form-group">
        	<div class="col-md-11 col-md-offset-1">
        		<h4>1. Nota Dinas</h4>
        	</div>
        </div>
        
        <div class="form-group">
        	<label class="control-label col-md-3">Nomor</label>
            <div class="col-md-9">
            	<label class="control-label"><?= $row->no_nota_dinas ?></label>
            </div>
        </div>
        
        <div class="form-group">
        	<label class="control-label col-md-3">Tanggal</label>
            <div class="col-md-9">
                <label class="control-label"><?= TglOnlyIndo($row->tanggal_nota_dinas) ?></label>
            </div>
        </div>
        
        <div class="form-group">
        	<label class="control-label col-md-3">&nbsp;</label>
            <div class="col-md-9">
                <a href="<?= base_url() ?>upload/berkas_permohonan/<?= $row->berkas_nota_dinas ?>" target="_blank" class="red">
                    <i class="fa fa-download"></i> <?= $row->berkas_nota_dinas ?>
                </a>
            </div>
        </div>
        
        <div class="form-group">
        	<div class="col-md-11 col-md-offset-1">
        		<h4>2. Position Paper</h4>
        	</div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3">&nbsp;</label>
            <div class="col-md-9">
                <a href="<?= base_url() ?>upload/berkas_permohonan/<?= $row->berkas_position_paper ?>" target="_blank" class="red">
                    <i class="fa fa-download"></i> <?= $row->berkas_position_paper ?>
                </a>
            </div>
        </div>
        
        <div class="form-group">
        	<div class="col-md-11 col-md-offset-1">
        		<h4>3. Draft Rancangan</h4>
        	</div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-3">&nbsp;</label>
            <div class="col-md-9">
                <a href="<?= base_url() ?>upload/berkas_permohonan/<?= $row->berkas_draft_rancangan ?>" target="_blank" class="red">
               	 	<i class="fa fa-download"></i> <?= $row->berkas_draft_rancangan ?>
                </a>
            </div>
        </div>
        
        <div class="form-group">
        	<div class="col-md-11 col-md-offset-1">
        		<h4>4. Tahapan Pembahasan</h4>
        	</div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-3">&nbsp;</label>
            <div class="col-md-9">
                <a href="<?= base_url() ?>upload/berkas_permohonan/<?= $row->berkas_tahap_pembahasan ?>" target="_blank" class="red">
                    <i class="fa fa-download"></i> <?= $row->berkas_tahap_pembahasan ?>
                </a>
            </div>
        </div>
        
        <div class="form-group">
			<div class="col-md-12">
        		<h3>Catatan Tambahan</h3>
        	</div>
        </div>
        
        <div class="form-group">
            <div class="col-md-12">
            <label class="control-label">
            	<?= $row->notes ?>
            </label>
          </div>
        </div>
        
        </form>	
        <?php } ?>
    </div>
</div>
