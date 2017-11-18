<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>Sys_user/simpan_json" id="form">
        <div class="form-body">
            <input type="hidden" name="user_id" id="user_id" />
            <div class="row">
                <div class="portlet light">
                    <div class="portlet-body">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Nama Panggilan <span class="required" aria-required="true">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" value="" name="nickname" id="nickname">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Nama Lengkap <span class="required" aria-required="true">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" value="" name="fullname" id="fullname">
                            </div>
                        </div>

						<div class="form-group">
                            <label class="col-lg-3 control-label">Biro</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" value="" name="biro" id="biro">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">No. Telp.</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" value="" name="usertelpno" id="usertelpno">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Status <span class="required" aria-required="true">*</span></label>
                            <div class="col-lg-9">
                                <select class="form-control select2" name="banned" id="banned">
                                	<option value="0">Aktif</option>
                                    <option value="1">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            Profil Pengguna
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Peran <span class="required" aria-required="true">*</span></label>
                            <div class="col-lg-9">
                                <select class="form-control select2" name="auth_level" id="auth_level">
                                	<option value="1">Administrator</option>
                                    <option value="2">User Biasa</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Username <span class="required" aria-required="true">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" value="" name="username" id="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email <span class="required" aria-required="true">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" value="" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Password</label>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" value="" name="passwd" id="passwd">
                                <span class="help-block">Password min: 8 karakter, 1 Huruf Besar, 1 Angka, 1 Huruf Kecil</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Ulangi Password</label>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" value="" name="re_passwd" id="re_passwd">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <span class="label label-danger">NOTE: </span>
                                &nbsp; Kosongan Password dan Ulangi Password pada saat 
                                <strong>Edit</strong> data jika tidak ada perubahan.
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>