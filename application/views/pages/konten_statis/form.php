<style>
	.dz-preview{
		display: none;
	}

</style>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>Konten_statis/simpan_json" id="form">
            <input type="hidden" name="recid" id="recid" />
            <input type="hidden" name="id_gambar" id="id_gambar" value="" />
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Nama <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="" name="nama" id="nama">
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Judul <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="" name="judul" id="judul">
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Isi <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <textarea name="ckeditor" id="ckeditor" rows="25" class="form-control ckeditor" style="height:400px;"></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Gambar</label>
                <div class="col-md-10">
                	<button id="btn_gambar" name="btn_gambar" type="button" class="btn green btn-block">Unggah Gambar</button>
                    <div class="progress progress-striped" role="progressbar" id="gambar_progress" 
                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="height:10px;"
                    >
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                    
                    <span class="help-block">Tipe Gambar jpg, jpeg, png</span>
                    
                    <div id="gambar_content"></div>
                    
                    <div style="width:100px;" id="delete-file-content">
                    	<center><a href="#" class="delete-file"><i class="fa fa-trash-o"></i> Hapus</a></center>
                    </div>
                    <input type="hidden" name="gambar" id="gambar" />
                </div>
            </div>
        </form>
    </div>
</div>

