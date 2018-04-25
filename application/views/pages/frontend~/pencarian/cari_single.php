<div class="relative container align-left">
    <div class="row">
        <div class="col-md-12">
            <h1 style="color:#FFFFFF; font-weight:bold;">
                JDIH Jaringan Dokumentasi Dan Informasi Hukum
                Komisi Yudisial
            </h1>
             
            <h3 style="color:#FFFFFF;">Pencarian dokumen</h3>
        </div>
    </div>
    <div class="row">
    	<form method="get" action="<?= base_url() ?>frontend/hasil_pencarian">
            <div class="col-md-10">
                <input type="text" class="form-control input-lg" name="kueri" value="<?= $this->input->get('kueri') ?>" placeholder="Masukkan Kata Kunci anda disini" />
            </div>
            <div class="col-md-2">
                <input type="submit" value="Cari Dokumen" class="button medium gray" data-loading-text="Loading...">
            </div>
        </form>
    </div>
</div>