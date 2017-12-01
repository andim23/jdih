<style>
	.dz-preview{
		display: none;
	}
</style>

<?php
	$no_permohonan = 'KY/P/' . date('Ymdhhis');
	$biro = isset($du[0]->biro)?$du[0]->biro:"";
?>

<div class="row">
    <div class="col-md-12">  
        <form id="form" action="<?= base_url() ?>Permohonan/simpan_json" method="POST" class="form-horizontal">
        <div class="status"></div>
        <div class="form-group">
            <label class="control-label col-md-3">No. Permohonan</label> 
            <div class="col-md-9">
                <input type="text" value="<?= $no_permohonan ?>" class="form-control" name="no_permohonan" id="no_permohonan" readonly="readonly">
                <span class="help-block">No ini dibuat secara otomatis oleh sistem</span>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-3">Pengusul <span class="required" aria-required="true"><span class="required" aria-required="true">*</span></span></label> 
            <div class="col-md-9">
                <input type="text" value="<?= $biro ?>" class="form-control" name="pengusul" id="pengusul" >
            </div>
        </div>
        
        <div class="form-group">
           	<label class="control-label col-md-3">Jenis Produk Hukum <span class="required" aria-required="true">*</span></label>
            <div class="col-md-9">
                <select name="id_kategori" id="id_kategori" class="form-control">
                    <?php foreach($dkategori as $rk){ ?>
                    <option value="<?= $rk->id_kategori ?>"><?= $rk->kategori ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-3">Judul Rancangan Produk Hukum <span class="required" aria-required="true">*</span></label> 
            <div class="col-md-9">
                <input type="text" value="" class="form-control" name="judul" id="judul" >
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
        	<label class="control-label col-md-3">Nomor <span class="required" aria-required="true">*</span></label>
            <div class="col-md-9">
            	<input type="text" value="" class="form-control" name="no_nota_dinas" id="no_nota_dinas">
            </div>
        </div>
        
        <div class="form-group">
        	<label class="control-label col-md-3">Tanggal <span class="required" aria-required="true">*</span></label>
            <div class="col-md-9">
                <div class="input-group input-large date date-picker" data-date-format="dd-mm-yyyy">
                    <input type="text" class="form-control"  name="tanggal_nota_dinas" id="tanggal_nota_dinas">
                    <span class="input-group-btn">
                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="form-group">
        	<label class="control-label col-md-3">Dokumen</label>
            <div class="col-md-9">
            	<div id="nota_dinas_upload_content">
                <button id="btn_nota_dinas" name="btn_nota_dinas" type="button" class="btn green btn-block">Unggah Dokumen Nota Dinas</button>
                    <div class="progress progress-striped" role="progressbar" id="nota_dinas_progress" 
                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="height:10px;"
                    >
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                    <span class="help-block">Tipe Dokumen jpg, jpeg, png, pdf. Ukuran Maksimal 50 MB</span>
                </div>
                <div id="nota_dinas_content"><input type="hidden" name="nota_dinas_file" id="nota_dinas_file" /></div>
            </div>
        </div>
        
        <div class="form-group">
        	<div class="col-md-11 col-md-offset-1">
        		<h4>2. Position Paper</h4>
        	</div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3">Dokumen</label>
            <div class="col-md-9">
            	<div id="position_paper_upload_content">
                    <button id="btn_position_paper" name="btn_position_paper" type="button" class="btn green btn-block">Unggah Dokumen Position Paper</button>
                    <div class="progress progress-striped" role="progressbar" id="position_paper_progress" 
                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="height:10px;"
                    >
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                    <span class="help-block">Tipe Dokumen jpg, jpeg, png, pdf</span>
                </div>
                <div id="position_paper_content">
                	<input type="hidden" name="position_paper_file" id="position_paper_file" />
                </div>
            </div>
        </div>
        
        <div class="form-group">
        	<div class="col-md-11 col-md-offset-1">
        		<h4>3. Draft Rancangan</h4>
        	</div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-3">Dokumen</label>
            <div class="col-md-9">
            	<div id="draft_rancangan_upload_content">
                    <button id="btn_draft_rancangan" name="btn_draft_rancangan" type="button" class="btn green btn-block">Unggah Dokumen Draft Rancangan</button>
                    <div class="progress progress-striped" role="progressbar" id="draft_rancangan_progress" 
                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="height:10px;"
                    >
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                    <span class="help-block">Tipe Dokumen jpg, jpeg, png, pdf</span>
                </div>
                <div id="draft_rancangan_content">
                	<input type="hidden" name="draft_rancangan_file" id="draft_rancangan_file" />
                </div>
            </div>
        </div>
        
        <div class="form-group">
        	<div class="col-md-11 col-md-offset-1">
        		<h4>4. Tahapan Pembahasan</h4>
        	</div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-3">Dokumen</label>
            <div class="col-md-9">
            	<div id="tahapan_pembahasan_upload_content">
                    <button id="btn_tahapan_pembahasan" name="btn_tahapan_pembahasan" type="button" class="btn green btn-block">
                    Unggah Dokumen Tahapan Pembahasan
                    </button>
                    <div class="progress progress-striped" role="progressbar" id="tahapan_pembahasan_progress" 
                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="height:10px;"
                    >
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                    <span class="help-block">Tipe Dokumen jpg, jpeg, png, pdf</span>
                </div>
                <div id="tahapan_pembahasan_content">
                	<input type="hidden" name="tahapan_pembahasan_file" id="tahapan_pembahasan_file" />
                </div>
            </div>
        </div>
        
        <div class="form-group">
			<div class="col-md-12">
        		<h3>Catatan Tambahan</h3>
        	</div>
        </div>
        
        <div class="form-group">
            <div class="col-md-12">
            	<textarea class="form-control" name="notes" id="notes" rows="5"></textarea>
            </div>
        </div>
        
        <div class="status"></div>
        
        <div class="form-action">
        	<button type="submit" id="save-btn" class="btn btn-primary btn-lg btn-block">Kirim Permohonan</button>
        </div>
        
        </form>	
    </div>
</div>

<script src="<?php echo base_url() ?>theme/assets/global/plugins/dropzone/dropzone.js"></script>

<script>
    $("#form").submit(function (e) {
        // prevent default action
        e.preventDefault();
        $("#save-btn").text('Menyimpan data ....').attr("disabled", "disabled");
        var url = $(this).attr("action");
        var data = $("#form").serialize();
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
					$("#form").empty();
					var tmp = '<div class="alert alert-success">' + message + '</div>';
					$("#form").append(tmp);
                } else {
					var pesan = "";
                    $.each(data.message, function (key, value) {
                        var element = $('#form #' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger')
                                .remove();

                        element.after(value);
						if( value )
							pesan += value + "";
                    });
					
					$(".status").empty();
					var tmp = '<div class="alert alert-danger"> <h4><i class="fa fa-lg fa-warning"></i> Perhatian! Form tidak lengkap.</h4>';
					tmp += 'Perhatikan baris-baris yang diberi tanda merah';
					tmp += '</div>';
					$(".status").append(tmp);
					
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

<script>
	$(document).ready(function(e) {
        $("#id_kategori").select2();
    });
	
	// upload nota dinas
	var dz_notadinas = new Dropzone("#btn_nota_dinas", { 
		url: "<?= base_url() ?>Upload/do_upload_permohonan",
		maxFiles:1,
		maxFilesize: 50,
		acceptedFiles:".pdf, .doc, .docx",
		dictDefaultMessage:"Upload Berkas (pdf, doc, docx)"
	});
	
	dz_notadinas.on("totaluploadprogress", function(progress) {
		$("#nota_dinas_progress .progress-bar").css({"width":progress+"%"});
	});
		
	dz_notadinas.on("success", function(file, response) {
		obj = JSON.parse(response);
		var info = obj.info;
		if( info == '0' ){
			alert(obj.message);
		}else{
			var file_name = obj.file_name;
			var file_type = obj.file_type;
			var file_size = obj.file_size;
			// hide btn upload
			$("#nota_dinas_upload_content").hide();
			// empty file download
			$("#nota_dinas_content").empty();
			var tmp = 	'';
				tmp += 	'<label><a href="<?= base_url() ?>upload/berkas_permohonan/'+file_name+'" target="_blank">'+file_name+'</a></label>&nbsp;&nbsp;';
				tmp += 	'<a href="#" class="delete_nota_dinas" id="delete_nota_dinas"><i class="fa fa-trash-o"></i></a>';
				tmp += 	'<input type="hidden" value="'+file_name+'" name="nota_dinas_file" id="nota_dinas_file" />';
			// add file download
			$("#nota_dinas_content").append(tmp);
			
			// delete file
			$("#delete_nota_dinas").click(function(e) {
				
				if(!confirm("Anda yakin menghapus berkas nota dinas ?"))
					return false;
				
				$.ajax({
					cache: false,
					type: "get",
					url: "<?= base_url() ?>Upload/delete_file_permohonan_json",
					data: "file_name=" + file_name,
					success: function (response) {
						var data = JSON.parse(response);
						var status = data.status;
						var message = data.message;
	
						if (status == '1') {
							$("#nota_dinas_upload_content").show();
							$("#nota_dinas_content").empty();
							// reduce progress to 0
							$("#nota_dinas_progress .progress-bar").css({"width":"0%"});
						} else {
							alert('Gagal menghapus Data');
						}
					}
				});
			});
		}
		this.removeFile(file);
	});
	// upload nota dinas
	
	// upload Position Paper
	var dz_position_paper = new Dropzone("#btn_position_paper", { 
		url: "<?= base_url() ?>Upload/do_upload_permohonan",
		maxFiles:1,
		maxFilesize: 50,
		acceptedFiles:".pdf, .doc, .docx",
		dictDefaultMessage:"Upload Berkas (pdf, doc, docx)"
	});
	
	dz_position_paper.on("totaluploadprogress", function(progress) {
		$("#position_paper_progress .progress-bar").css({"width":progress+"%"});
	});
		
	dz_position_paper.on("success", function(file, response) {
		obj = JSON.parse(response);
		var info = obj.info;
		if( info == '0' ){
			alert(obj.message);
		}else{
			var file_name = obj.file_name;
			var file_type = obj.file_type;
			var file_size = obj.file_size;
			// hide btn upload
			$("#position_paper_upload_content").hide();
			// empty file download
			$("#position_paper_content").empty();
			var tmp = 	'';
				tmp += 	'<label><a href="<?= base_url() ?>upload/berkas_permohonan/'+file_name+'" target="_blank">'+file_name+'</a></label>&nbsp;&nbsp;';
				tmp += 	'<a href="#" class="delete_position_paper" id="delete_position_paper"><i class="fa fa-trash-o"></i></a>';
				tmp += 	'<input type="hidden" value="'+file_name+'" name="position_paper_file" id="position_paper_file" />';
			// add file download
			$("#position_paper_content").append(tmp);
			
			// delete file
			$("#delete_position_paper").click(function(e) {
				
				if(!confirm("Anda yakin menghapus berkas posotion paper ?"))
					return false;
				
				$.ajax({
					cache: false,
					type: "get",
					url: "<?= base_url() ?>Upload/delete_file_permohonan_json",
					data: "file_name=" + file_name,
					success: function (response) {
						var data = JSON.parse(response);
						var status = data.status;
						var message = data.message;
	
						if (status == '1') {
							$("#position_paper_upload_content").show();
							$("#position_paper_content").empty();
							// reduce progress to 0
							$("#position_paper_progress .progress-bar").css({"width":"0%"});
						} else {
							alert('Gagal menghapus Data');
						}
					}
				});
			});
		}
		this.removeFile(file);
	});
	// upload Position Paper

	// upload Draft Perancangan
	var dz_draft_rancangan = new Dropzone("#btn_draft_rancangan", { 
		url: "<?= base_url() ?>Upload/do_upload_permohonan",
		maxFiles:1,
		maxFilesize: 50,
		acceptedFiles:".pdf, .doc, .docx",
		dictDefaultMessage:"Upload Berkas (pdf, doc, docx)"
	});
	
	dz_draft_rancangan.on("totaluploadprogress", function(progress) {
		$("#draft_rancangan_progress .progress-bar").css({"width":progress+"%"});
	});
		
	dz_draft_rancangan.on("success", function(file, response) {
		obj = JSON.parse(response);
		var info = obj.info;
		if( info == '0' ){
			alert(obj.message);
		}else{
			var file_name = obj.file_name;
			var file_type = obj.file_type;
			var file_size = obj.file_size;
			// hide btn upload
			$("#draft_rancangan_upload_content").hide();
			// empty file download
			$("#draft_rancangan_content").empty();
			var tmp = 	'';
				tmp += 	'<label><a href="<?= base_url() ?>upload/berkas_permohonan/'+file_name+'" target="_blank">'+file_name+'</a></label>&nbsp;&nbsp;';
				tmp += 	'<a href="#" class="delete_draft_rancangan" id="delete_draft_rancangan"><i class="fa fa-trash-o"></i></a>';
				tmp += 	'<input type="hidden" value="'+file_name+'" name="draft_rancangan_file" id="draft_rancangan_file" />';
			// add file download
			$("#draft_rancangan_content").append(tmp);
			
			// delete file
			$("#delete_draft_rancangan").click(function(e) {
				
				if(!confirm("Anda yakin menghapus berkas draft rancangan ?"))
					return false;
				
				$.ajax({
					cache: false,
					type: "get",
					url: "<?= base_url() ?>Upload/delete_file_permohonan_json",
					data: "file_name=" + file_name,
					success: function (response) {
						var data = JSON.parse(response);
						var status = data.status;
						var message = data.message;
	
						if (status == '1') {
							$("#draft_rancangan_upload_content").show();
							$("#draft_rancangan_content").empty();
							// reduce progress to 0
							$("#draft_rancangan_progress .progress-bar").css({"width":"0%"});
						} else {
							alert('Gagal menghapus Data');
						}
					}
				});
			});
		}
		this.removeFile(file);
	});
	// upload Draft Perancangan

	// upload Tahapan Pembahasan
	var dz_tahapan_pembahasan = new Dropzone("#btn_tahapan_pembahasan", { 
		url: "<?= base_url() ?>Upload/do_upload_permohonan",
		maxFiles:1,
		maxFilesize: 50,
		acceptedFiles:".pdf, .doc, .docx",
		dictDefaultMessage:"Upload Berkas (pdf, doc, docx)"
	});
	
	dz_tahapan_pembahasan.on("totaluploadprogress", function(progress) {
		$("#tahapan_pembahasan_progress .progress-bar").css({"width":progress+"%"});
	});
		
	dz_tahapan_pembahasan.on("success", function(file, response) {
		obj = JSON.parse(response);
		var info = obj.info;
		if( info == '0' ){
			alert(obj.message);
		}else{
			var file_name = obj.file_name;
			var file_type = obj.file_type;
			var file_size = obj.file_size;
			// hide btn upload
			$("#tahapan_pembahasan_upload_content").hide();
			// empty file download
			$("#tahapan_pembahasan_content").empty();
			var tmp = 	'';
				tmp += 	'<label><a href="<?= base_url() ?>upload/berkas_permohonan/'+file_name+'" target="_blank">'+file_name+'</a></label>&nbsp;&nbsp;';
				tmp += 	'<a href="#" class="delete_tahapan_pembahasan" id="delete_tahapan_pembahasan"><i class="fa fa-trash-o"></i></a>';
				tmp += 	'<input type="hidden" value="'+file_name+'" name="tahapan_pembahasan_file" id="tahapan_pembahasan_file" />';
			// add file download
			$("#tahapan_pembahasan_content").append(tmp);
			
			// delete file
			$("#delete_tahapan_pembahasan").click(function(e) {
				
				if(!confirm("Anda yakin menghapus berkas draft rancangan ?"))
					return false;
				
				$.ajax({
					cache: false,
					type: "get",
					url: "<?= base_url() ?>Upload/delete_file_permohonan_json",
					data: "file_name=" + file_name,
					success: function (response) {
						var data = JSON.parse(response);
						var status = data.status;
						var message = data.message;
	
						if (status == '1') {
							$("#tahapan_pembahasan_upload_content").show();
							$("#tahapan_pembahasan_content").empty();
							// reduce progress to 0
							$("#tahapan_pembahasan_progress .progress-bar").css({"width":"0%"});
						} else {
							alert('Gagal menghapus Data');
						}
					}
				});
			});
		}
		this.removeFile(file);
	});
	// upload Tahapan Pembahasan
</script>