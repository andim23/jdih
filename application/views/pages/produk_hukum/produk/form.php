<style>
	.dz-preview{
		display: none;
	}
</style>
<?php
	$x = $this->input->get('x');
	$y = $this->input->get('y');
	$r = $result;
	$id_produk_hukum = isset($r[0]->id_produk_hukum)?$r[0]->id_produk_hukum:"";
	$tanggal = isset($r[0]->tanggal)?ddmmyyyy($r[0]->tanggal):"";
	$id_kategori = isset($r[0]->id_kategori)?$r[0]->id_kategori:"";
	$produk_hukum = isset($r[0]->produk_hukum)?$r[0]->produk_hukum:"";
	$judul = isset($r[0]->judul)?$r[0]->judul:"";
	$subjudul = isset($r[0]->subjudul)?$r[0]->subjudul:"";
	$isi = isset($r[0]->isi)?$r[0]->isi:"";
	$abstrak = isset($r[0]->abstrak)?$r[0]->abstrak:"";
	$catatan = isset($r[0]->catatan)?$r[0]->catatan:"";
	$id_dokumen = isset($r[0]->id_dokumen)?$r[0]->id_dokumen:"";
	
?>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>Produk_hukum/simpan_json" id="form">
            <input type="hidden" name="id_produk_hukum" id="id_produk_hukum" value="<?= $id_produk_hukum ?>" />
            <input type="hidden" name="id_dokumen" id="id_dokumen" value="<?= $id_dokumen ?>" />

            <div class="form-group">
                <label class="col-md-2 control-label">Tanggal <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control"  name="tanggal" id="tanggal" value="<?= $tanggal ?>">
                        <span class="input-group-btn">
                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Jenis <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <select class="form-control" name="id_kategori" id="id_kategori">
                    	<?php foreach($kategori as $row){ ?>
                        <option value="<?= $row->id_kategori ?>"><?= $row->kategori ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Judul <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $judul ?>" name="judul" id="judul">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Sub Judul</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $subjudul ?>" name="subjudul" id="subjudul">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Abstrak</label>
                <div class="col-md-10">
                    <textarea name="abstrak" rows="10" id="abstrak" class="form-control wysihtml5"><?= $abstrak ?></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Isi <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <textarea name="isi" id="isi" rows="10" class="form-control wysihtml5"><?= $isi ?></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Catatan </label>
                <div class="col-md-10">
                    <textarea name="catatan" id="catatan" rows="10" class="form-control wysihtml5"><?= $catatan ?></textarea>
                </div>
            </div>
            <div class="form-group">
            	<div class="col-md-10 col-md-offset-2">
                	<h3>Berkas</h3>
                </div>
            </div>
            <div class="form-group">
            	<div class="col-md-10 col-md-offset-2">
                	<div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Perhatian!</strong> <br />
                        Tipe File yang diperbolehkan adalah: pdf, doc, docx, 
                        Maksimal 5 Berkas yang diupload dalam satu waktu
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-2">
                    <button type="button" class="btn btn-block green" id="upload_berkas">Unggah Berkas</button>
                    <div class="progress progress-striped" role="progressbar" id="berkas_progress" 
                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="height:10px;"
                    >
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
            	<div class="col-md-10 col-md-offset-2">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered" id="berkas_table">
                    <thead>
                      <tr class="heading">
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Ukuran</th>
                        <th width="30">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($berkas as $rb){ ?>
                    <tr>
                      <td>
                      	<a href="<?= base_url() ?>upload/produk_hukum/<?= $rb->filename ?>" target="_blank">
					  		<?= $rb->filename ?>
                      	</a>
                      </td>
                      <td align="center"><?= $rb->filetype ?></td>
                      <td align="right"><?= $rb->filesize ?></td>
                      <td align="center">
                      	<a href="#" file_name="<?= $rb->filename ?>" recid="<?= $rb->recid ?>" class="delete-file-data">
                      	<i class="fa fa-lg fa-trash-o"></i></a>
                      </td>
                    </tr>
					<?php } ?>
                    </tbody>
                    </table>
				</div>
            </div>
            <br /><br />
            <div class="form-action">
            	<div class="row">
                    <div class="col-lg-6">
                        <a href="<?= base_url() ?>Produk_hukum?x=<?= $x ?>&y=<?= $y ?>" class="btn btn-lg btn-block default">Kembali</a>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-lg btn-block blue" type="submit" id="save-btn">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo base_url() ?>theme/assets/global/plugins/dropzone/dropzone.js"></script>
<script>
	$(document).ready(function(e) {
        $("#id_kategori").select2();
		if("<?= $id_kategori ?>" != "")
			$("#id_kategori").select2('val', '<?= $id_kategori ?>');
			
		$('.wysihtml5').wysihtml5({
			"stylesheets": ["<?php echo base_url() ?>theme/assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
		});
		
		// upload file
		var myDropzone = new Dropzone("#upload_berkas", { 
			url: "<?= base_url() ?>Upload/do_upload_ph",
			maxFiles:5,
			acceptedFiles:".pdf, .doc, .docx",
			dictDefaultMessage:"Upload Berkas (pdf, doc, docx)"
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
				var file_type = obj.file_type;
				var file_size = obj.file_size;
				
				var tmp = 	'<tr>';
					tmp += 	'<td><a href="<?= base_url() ?>upload/produk_hukum/'+file_name+'" target="_blank">'+file_name+'</a><input type="hidden" name="file_name[]" value="'+file_name+'"></td>';
					tmp += 	'<td align="center">'+file_type+'<input type="hidden" name="file_type[]" value="'+file_type+'"></td>';
					tmp += 	'<td align="right">'+file_size+'<input type="hidden" name="file_size[]" value="'+file_size+'"></td>';
					tmp += 	'<td align="center"><a href="#" file_name="'+file_name+'" class="delete-file-only"><i class="fa fa-lg fa-trash-o"></i></a></td>';
					tmp += 	'</tr>'
				$("#berkas_table tbody").append(tmp);
			}
			this.removeFile(file);
		});
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
	
	$(".delete-file-data").click(function(e) {
        e.preventDefault();
		if(confirm("Anda yakin menghapus data ini ?")){
			var file_name = $(this).attr('file_name');
			var recid = $(this).attr('recid');
			data = 'file_name=' + file_name + "&recid=" + recid;
			$.ajax({
				cache: false,
				type: "get",
				url: "<?= base_url() ?>Produk_hukum/delete_fileph_json",
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
		
	$("#save-btn").click(function (e) {
		e.preventDefault();
        $("#form").submit();
    });

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
                    location.href = "<?= base_url() ?>Produk_hukum?x=<?= $x ?>&y=<?= $y ?>";
                } else {
                    $.each(data.message, function (key, value) {
                        var element = $('#form #' + key);
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger')
                                .remove();

                        element.after(value);
						$('#form #' + key).focus();
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