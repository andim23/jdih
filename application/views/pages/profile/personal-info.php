<form role="form" action="#" id="personal_info_form">
	<div class="status"></div>
	<h3>Informasi Umum</h3>
    <div class="form-group">
        <label class="control-label">Username</label>
        <input type="text"
        	class="form-control" name="username" id="username" readonly value="<?= isset($profile[0]->username)?$profile[0]->username:''; ?>" 
        />
    </div>
    <div class="form-group">
        <label class="control-label">Nama Lengkap</label>
        <input type="text" placeholder="<?= isset($profile[0]->fullname)?$profile[0]->fullname:''; ?>" 
        	class="form-control" name="fullname" id="fullname" value="<?= isset($profile[0]->fullname)?$profile[0]->fullname:''; ?>" 
        />
    </div>
    <div class="form-group">
        <label class="control-label">Nama Panggilan</label>
        <input type="text"
        	class="form-control" name="nickname" id="nickname" value="<?= isset($profile[0]->nickname)?$profile[0]->nickname:''; ?>" 
        />
    </div>
    <div class="form-group">
        <label class="control-label">Telp.</label>
        <input type="text"
        	class="form-control" name="usertelpno" id="usertelpno" value="<?= isset($profile[0]->usertelpno)?$profile[0]->usertelpno:''; ?>" 
        />
    </div>
    <div class="form-group">
        <label class="control-label">Email</label>
        <input type="text" 
        	class="form-control" name="useremail" readonly value="<?= isset($profile[0]->email)?$profile[0]->email:''; ?>" 
        />
    </div>

    
    <div class="margiv-top-10">
        <a href="#" class="btn blue" id="simpan_perubahan">Simpan Perubahan</a>
    </div>
</form>

<script>
	function simpanPerubahan(){
		$("#simpan_perubahan").text('Menyimpan data ....').attr("disabled", "disabled");
        var url = '<?= base_url() ?>User_profile/simpan_json';
        var data = $("#personal_info_form").serialize();
        $.ajax({
            type: "post",
            url: url,
            data: data,
            success: function (response) {
                var data = JSON.parse(response);
                var status = data.status;
                var message = data.message;
                if (status == '1') {
					var tmp = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Data berhasil tersimpan</div>';
                } else {
					$.each( data.message, function(key, value){
						var element = $('#' + key);
						element.closest('div.form-group')
						.removeClass('has-error')
						.addClass( value.length > 0 ? 'has-error' : 'has-success')
						.find('.text-danger')
						.remove();
						element.after(value);
					});
					
					var tmp = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Data gagal tersimpan</div>';
					
					
                }
				$("#username").focus();
				$(".status").append(tmp);
				$(".status").focus();
				$("#simpan_perubahan").text('Simpan Perubahan').removeAttr("disabled");
            },
            beforeSend: function () {
				$(".status").empty();
                $("#simpan_perubahan").val('Menyimpan data ....').attr("disabled", "disabled");
            },
            error: function () {
                $("#simpan_perubahan").text('Simpan Perubahan').removeAttr("disabled");
            }
        });
	}
	
	$("#simpan_perubahan").click(function(e) {
		e.preventDefault();
        simpanPerubahan();
    });
	
	$(document).ready(function(e) {
        $("#dinasid").select2();
		
		$("#dinasid").select2('val', '<?= isset($profile[0]->dinasid)?$profile[0]->dinasid:''; ?>');
    });
</script>