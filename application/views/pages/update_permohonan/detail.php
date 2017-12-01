<style>
	.dz-preview{
		display: none;
	}
</style>
<div class="row">
    <div class="col-md-12">  
        <?php foreach($detail as $row){ ?>
        <form id="form" action="<?= base_url() ?>Update_permohonan/simpan_json" method="POST" class="form-horizontal">
        <input type="hidden" name="id_permohonan" id="id_permohonan" value="<?= $this->uri->segment(3) ?>" />
        
        <?php
        	if( $row->status == 'Publish' ){
		?>
        	<div class="alert alert-info">
            	<b>Informasi.</b>
                Data ini telah dipublish.
            </div>
        <?php } ?>
        
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
            <label class="control-label col-md-3">Status Terakhir</label> 
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
        		<h3>Keterangan Terakhir</h3>
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
        
        <?php if( $row->status != "Publish" ){ ?>
        <div class="form-group">
			<div class="col-md-12">
        		<h3>Update Permohonan</h3>
        	</div>
        </div>
        
        <div class="form-group">
        	<div class="col-md-12"><label>Status</label></div>
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
                <textarea class="form-control ckeditor" name="txtnotes" id="txtnotes"></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-12 margin-bottom-20">
                <button type="button" name="upload_berkas" id="upload_berkas" class="btn btn-block green">Unggah Berkas Pendukung</button>
                <div class="progress progress-striped" role="progressbar" id="berkas_progress" 
                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="height:10px;"
                >
                  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
                <span class="help-block">
                	Tipe Gambar pdf, doc, docx, ppt, pptx.
                	Maksimal 5 Berkas yang diupload dalam satu waktu.
                </span>
                <div id="berkas_content"></div>
            </div>
        </div>
        <?php
			}else{
		?>
        	<div class="alert alert-info">
            	<b>Informasi.</b>
                Data ini telah dipublish.
            </div>
        <?php
			}
		?>
        <div class="form-group">
            <div class="col-md-6 margin-top-20">
                <a href="<?= base_url() ?>update_permohonan?x=<?= $this->input->get('x') ?>&y=<?= $this->input->get('y') ?>" class="btn btn-lg default btn-block">Kembali</a>
            </div>
            
            <div class="col-md-6 margin-top-20">
                <button type="submit" id="save-btn" class="btn btn-lg blue btn-block">Simpan</button>
            </div>
            
        </div>
        
        </form>
        <?php } ?>
    </div>
</div>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/dropzone/dropzone.js"></script>
<script>
	$(document).ready(function(e) {
        $("#id_permohonan_status").select2();	
    });
	
	// upload file
	var myDropzone = new Dropzone("#upload_berkas", { 
		url: "<?= base_url() ?>Upload/do_upload_ph",
		maxFiles:5,
		acceptedFiles:".pdf, .doc, .docx, .ppt, .pptx",
		dictDefaultMessage:"Upload Berkas (pdf, doc, docx, ppt, spptx)"
	});
	
	myDropzone.on("totaluploadprogress", function(progress) {
		$("#berkas_progress .progress-bar").css({"width":progress+"%"});
	});
		
	myDropzone.on("success", function(file, response) {
		obj = JSON.parse(response);
		var info = obj.info;
		if( info == '0' ){
			alert(obj.message);
		}else{
			var file_name = obj.file_name;
			//$("#berkas_content").empty();
			var  tmp = "";
				tmp += 	'<table class="table" width="100%">'
				tmp += 	'<tr>';
				tmp += 	'<td>';
				tmp	+=	'<a href="<?= base_url() ?>upload/produk_hukum/'+file_name+'" target="_blank">'+file_name+'</a>';
				tmp	+=	'<input type="hidden" name="file_name[]" value="'+file_name+'">';
				tmp	+= 	' | ';
				tmp += 	'<a href="#" file_name="'+file_name+'" class="delete-file-only"><i class="fa fa-lg fa-trash-o"></i></a>';
				tmp	+=	'</td>';
				tmp += 	'</tr>'
				tmp	+= 	'</table>'
			$("#berkas_content").append(tmp);
		}
		this.removeFile(file);
	});
	
	$('.delete-file-only').live('click', function(e) {
		e.preventDefault();
		if(confirm("Anda yakin menghapus data ini ?")){
			var file_name = $(this).attr('file_name');
			data = 'file_name=' + file_name;
			$.ajax({
				cache: false,
				type: "get",
				url: "<?= base_url() ?>upload/delete_fileph_json",
				data: data,
				success: function (response) {
					var data = JSON.parse(response);
					var status = data.status;
					var message = data.message;
					if (status == '1') {
						
					} else {
						alert('Gagal hapus file')
					}
				}
			 });
			 $(this).parent().parent().remove();
		}
	});
	
	$("#form").submit(function (e) {
        // prevent default action
        e.preventDefault();
        $("#save-btn").text('Menyimpan data ....').attr("disabled", "disabled");
        var url = $(this).attr("action");
		
		var notes = CKEDITOR.instances['txtnotes'].getData();
		notes = encodeURIComponent(notes);
        var data = $("#form").serialize();
		data += "&notes=" + notes;
		
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
