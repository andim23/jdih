<div class="row">
	<div class="col-md-8">
        <form action="<?= base_url() ?>user_profile/ganti_password_json" id="form_ganti_password">
            <div class="alert alert-success hide">
                <button type="button" class="close" data-dismiss="alert"></button>
                Proses Ganti Password Berhasil.
            </div>
            <div class="form-group">
                <label class="control-label">Password Lama</label>
                <input type="password" class="form-control" name="old_userpass" id="old_userpass" />
            </div>
            <div class="form-group">
                <label class="control-label">Password Baru</label>
                <input type="password" class="form-control" name="userpass" id="userpass" />
            </div>
            <div class="form-group">
                <label class="control-label">Ulang Password Baru</label>
                <input type="password" class="form-control" name="re_userpass" id="re_userpass" />
            </div>
            <div class="margin-top-10">
                <button type="submit" class="btn green" id="ganti_password_btn">Ganti Password</button>
            </div>
        </form>
    </div>
    <div class="col-md-4">
    	<h3>Informasi</h3>
        <p>Password harus memiliki:</p>
    	<ul>
        	<li>Minimal 8 karakter</li>
            <li>1 angka</li>
            <li>1 huruf kecil</li>
            <li>1 huruf besar</li>
        </ul>
    </div>
</div>


<script>
	$("#form_ganti_password").submit(function(e) {
        e.preventDefault();
        $("#ganti_password_btn").text('Menyimpan data ....').attr("disabled", "disabled");
        var url = $(this).attr("action");
        var data = $("#form_ganti_password").serialize();
        $.ajax({
            type: "post",
            url: url,
            data: data,
            success: function (response) {
                $("#ganti_password_btn").text("Ganti Password").removeAttr("disabled");
                var data = JSON.parse(response);
                var status = data.status;
                var message = data.message;
                if (status == '1') {
                    $("#form_ganti_password .text-danger").remove();
					$("#form_ganti_password .form-group").removeClass("has-error");
					$("#form_ganti_password .form-group").removeClass("has-success");
					$(".alert-success").removeClass('hide');
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
					
                    $("#ganti_password_btn").text('Ganti Password').removeAttr("disabled");
                }
				$('#form_ganti_password').find('input[type=password]').val('');
            },
            beforeSend: function () {
                $("#ganti_password_btn").val('Menyimpan data ....').attr("disabled", "disabled");
            },
            error: function () {
                $("#ganti_password_btn").text('Ganti Password').removeAttr("disabled");
            }
        });
    });
</script>