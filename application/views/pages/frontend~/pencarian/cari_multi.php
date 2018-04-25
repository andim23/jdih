<div class="relative container align-left">
    <div class="row">
        <div class="col-md-12">
            <h1 style="color:#FFFFFF; font-weight:bold;">
                <?= isset($kategori[0]->kategori)?$kategori[0]->kategori:""; ?>
            </h1>
        </div>
    </div>
    <div class="row">
        <form method="get" action="<?= base_url() ?>frontend/hasil_pencarian">
            <div class="col-md-2">
                <select class="form-control input-lg" name="tahun" id="tahun">
                    <option value="">Tahun</option>
                    <?php foreach($tahun as $rt){ ?>
                    <option value="<?= $rt->tahun ?>"><?= $rt->tahun ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-control input-lg" name="id_kategori" id="id_kategori">
                    <option value="">Jenis</option>
                    <?php foreach($dkategori as $rdk){ ?>
                    <option value="<?= $rdk->id_kategori ?>"><?= $rdk->kategori ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control input-lg" value="<?= $this->input->get('kueri') ?>" name="kueri" id="kueri" placeholder="Masukkan Kata Kunci anda disini" />
            </div>
            <div class="col-md-2">
                <input type="submit" value="Cari Dokumen" class="button medium gray" data-loading-text="Loading...">
            </div>
        </form>
    </div>
</div>

<script>
	$(document).ready(function(e) {
        if("<?= $this->input->get('tahun') ?>" != "")
			$("#tahun").val("<?= $this->input->get('tahun') ?>");
		
		if("<?= $this->input->get('id_kategori') ?>" != "")
			$("#id_kategori").val("<?= $this->input->get('id_kategori') ?>");
    });
</script>