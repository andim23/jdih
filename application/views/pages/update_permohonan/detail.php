<div class="row">
    <div class="col-md-12">  
        <?php foreach($detail as $row){ ?>
        <form id="form" action="<?= base_url() ?>Update_permohonan/simpan_json" method="POST" class="form-horizontal">
        
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
            <label class="control-label col-md-3">Status</label> 
            <div class="col-md-9">
                <label class="control-label"><strong><?= $row->status ?></strong></label>
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
        
        <div class="form-group">
			<div class="col-md-12">
        		<hr />
        	</div>
        </div>
        
        <div class="form-group">
			<div class="col-md-12">
        		<h3>Update Permohonan</h3>
        	</div>
        </div>
        
        <div class="form-group">
        	<div class="col-md-12"><label>Status Terakhir</label></div>
            <div class="col-md-12">
                <select class="form-control" id="id_permohonan_status" name="id_permohonan_status">
                	<option value="">Pilih Status</option>
					<?php foreach($status as $r){ ?>
                    <option value="<?= $r->id_permohonan_status ?>"><?= $r->status ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
        	<div class="col-md-12"><label>Keterangan</label></div>
            <div class="col-md-12">
                <textarea class="form-control ckeditor" name="notes" id="notes"></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-6">
                <a href="<?= base_url() ?>update_permohonan?x=<?= $this->input->get('x') ?>&y=<?= $this->input->get('y') ?>" class="btn btn-lg default btn-block">Kembali</a>
            </div>
            
            <div class="col-md-6">
                <button type="submit" id="save-btn" class="btn btn-lg blue btn-block">Simpan</button>
            </div>
            
        </div>
        
        </form>
        <?php } ?>
    </div>
</div>

<script>
	$(document).ready(function(e) {
        $("#id_permohonan_status").select2();
		
    });
	
	$("#form").submit(function (e) {
        // prevent default action
        e.preventDefault();
        $("#save-btn").text('Menyimpan data ....').attr("disabled", "disabled");
        var url = $(this).attr("action");
		
		var notes = CKEDITOR.instances['notes'].getData();
		notes = encodeURIComponent(notes);
		var id_permohonan_status = $("#id_permohonan_status").val();
		var id_permohonan = "<?= $this->uri->segment(3) ?>";
		
        var data = "id_permohonan_status=" + id_permohonan_status + "&notes=" + notes + "&id_permohonan=" + id_permohonan;
		
        $.ajax({
            cache: false,
            type: "post",
            url: url,
            data: data,
            success: function (response) {
                $("#save-btn").text("Simpan").removeAttr("disabled");
                var data = JSON.parse(response);
                var status = data.status;
                var message = data.message;
                if (status == '1') {
					alert('Permohonan ter-update. Halaman akan di-refresh.')
					var url = "<?= base_url() ?>update_permohonan/status_detail/<?= $this->uri->segment(3) ?>";
					url = url + '?x=<?= $this->input->get('x') ?>';
					url = url + '&y=<?= $this->input->get('y') ?>';
					location.href = url;
                } else {
                    $.each(data.message, function (key, value) {
                        var element = $('#form #' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger')
                                .remove();

                        element.after(value);
						if(value.length > 0)
							element.focus();
                    });
                    $("#save-btn").text('Simpan').removeAttr("disabled");
                }
            },
            beforeSend: function () {
                $("#save-btn").val('Menyimpan data ....').attr("disabled", "disabled");
            },
            error: function () {
                $("#save-btn").text('Simpan').removeAttr("disabled");
            }
        });

    });
</script>
