<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>Hubungi_kami/simpan_json" id="form">
            <input type="hidden" name="recid" id="recid" />
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Nama</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" readonly="readonly" value="" name="nama" id="nama">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Email</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" readonly="readonly" value="" name="email" id="email">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Subjek</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" readonly="readonly" value="" name="subjek" id="subjek">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Pesan</label>
                <div class="col-md-10">
                    <textarea name="pesan" id="pesan" readonly="readonly" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Balas</label>
                <div class="col-md-10">
                    <textarea name="balas" id="balas" class="form-control ckeditor"></textarea>
                </div>
            </div>
        </form>
    </div>
</div>