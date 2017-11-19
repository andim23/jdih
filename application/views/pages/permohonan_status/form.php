<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>Permohonan_status/simpan_json" id="form">
            <input type="hidden" name="id_permohonan_status" id="id_permohonan_status" />
            <div class="form-group">
                <label for="kategori" class="col-lg-3 control-label">Status <span class="required" aria-required="true">*</span></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" value="" name="status" id="status">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-lg-3 control-label">No Urut <span class="required" aria-required="true">*</span></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" value="" name="no_urut" id="no_urut">
                </div>
            </div>
        </form>
    </div>
</div>