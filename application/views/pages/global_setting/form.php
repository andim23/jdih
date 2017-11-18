<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>Sys_globalvar/simpan_json" id="form">
            <input type="hidden" name="varid" id="varid" />
            <div class="form-group">
                <label class="col-lg-3 control-label">Variabel <span class="required" aria-required="true">*</span></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" value="" name="varname" id="varname">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Nilai (Integer)</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" value="" name="val_int" id="val_int">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label">Nilai (Float)</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" value="" name="val_float" id="val_float">
                    <span class="help-block">Gunakan '.' (titik) sebagai pemisah desimal. Contoh: 2.3</span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label">Nilai (Varchar)</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" value="" name="val_varchar" id="val_varchar">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label">Nilai (Date)</label>
                <div class="col-lg-9">
                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control"  name="val_date" id="val_date">
                        <span class="input-group-btn">
                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label">Nilai (Date Time)</label>
                <div class="col-lg-9">
                    <div class="input-group date form_datetime input-medium">
                        <input type="text"  class="form-control" name="val_datetime" id="val_datetime">
                        <span class="input-group-btn">
                        <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label">Nilai (Date From)</label>
                <div class="col-lg-9">
                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control"  name="val_datefrom" id="val_datefrom">
                        <span class="input-group-btn">
                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label">Nilai (Date Until)</label>
                <div class="col-lg-9">
                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control" name="val_dateto" id="val_dateto">
                        <span class="input-group-btn">
                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label">Nilai (Text)</label>
                <div class="col-lg-9">
                    <textarea name="val_text" id="val_text" class="form-control wysihtml5">
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-12">Petunjuk</label>
                <div class="col-lg-12">
                    <textarea class="form-control" rows="10" readonly="readonly" name="guide" id="guide"></textarea>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
	$('.wysihtml5').wysihtml5({
		"stylesheets": ["<?php echo base_url() ?>theme/assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
	});
	
	$('.date-picker').datepicker({
		rtl: Metronic.isRTL(),
		orientation: "left",
		autoclose: true
	});
	
	$(".form_datetime").datetimepicker({
		autoclose: true,
		isRTL: Metronic.isRTL(),
		format: "dd-mm-yyyy hh:ii:ss",
		pickerPosition: (Metronic.isRTL() ? "bottom-right" : "bottom-left")
	});
</script>