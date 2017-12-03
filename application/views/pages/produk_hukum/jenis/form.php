<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>produk_hukum_kategori/simpan_json" id="form">
            <input type="hidden" name="id_kategori" id="id_kategori" />
            <div class="form-group">
                <label for="kategori" class="col-lg-3 control-label">Jenis <span class="required" aria-required="true">*</span></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" value="" name="kategori" id="kategori">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-lg-3 control-label">Untuk Permohonan <span class="required" aria-required="true">*</span></label>
                <div class="col-lg-9">
                    <select name="is_permohonan" id="is_permohonan" class="form-control">
                    	<option value="Y">Ya</option>
                        <option value="N">Tidak</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-lg-3 control-label">Deskripsi</label>
                <div class="col-lg-9">
                    <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                </div>
            </div>
        </form>
    </div>
</div>