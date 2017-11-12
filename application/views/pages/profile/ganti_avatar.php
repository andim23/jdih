<style>
	.dz-preview{
		display: none;
	}
</style>
<?php 
	if( !empty($profile[0]->userphoto) )
		$foto = base_url() . 'mpo_upload/thumb_' . unsset_to_empty($profile[0]->userphoto);
	else
		$foto = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
?>
<form action="#" role="form">
    <div class="form-group">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 162px;">
                <img src="<?= $foto ?>" alt="" id="pp_content" />
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
            </div>
            <div>
            	<div class="progress progress-striped" role="progressbar" id="pp_progress" 
                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="height:5px; margin-bottom:0px;"
                >
                  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
                <button type="button" class="btn red btn-block btn-sm" id="ganti_pp"><i class="fa fa-camera"></i> Ganti Gambar</button>
            </div>
        </div>
        <div class="clearfix margin-top-10">
            <span class="label label-danger">NOTE!</span>
            <span>
            	Format file yang diperbolehkan adalah JPG atau PNG dengan ukuran maksimal 2 MB.
            </span>
        </div>
    </div>
</form>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/dropzone/dropzone.js"></script>
<script>
	var myDropzone_pp = new Dropzone("#ganti_pp", { 
		url: "<?= base_url() ?>User_profile/do_upload_profil_picture",
		acceptedFiles:"image/*",
		dictDefaultMessage:"Upload Gambar (png, jpg)"
	});
    
	// Update the total progress bar
	myDropzone_pp.on("totaluploadprogress", function(progress) {
		$("#pp_progress .progress-bar").css({"width":progress+"%"});
	});
	    
	myDropzone_pp.on("success", function(file, response) {
		obj = JSON.parse(response);
		var info = obj.info;
		if( info == '0' ){
			alert(obj.message);
		}else{
			var file_name = obj.file_name;
			var thumb_file_name = obj.thumb_file_name;
			// set on preview template			
			$("#pp_content").attr('src', '<?= base_url() ?>mpo_upload/' + thumb_file_name);
			$("#pp_picture_top").attr('src', '<?= base_url() ?>mpo_upload/' + thumb_file_name);
			$("#pp_overview").attr('src', '<?= base_url() ?>mpo_upload/' + file_name);
		}
		this.removeFile(file);
	});
</script>