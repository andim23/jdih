<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <?php $this->load->view('pages/include/breadcrumb') ?>
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">

                <!-- Begin: life time stats -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <?= $htitle ?>
                        </div>
                        <div class="actions">
                            <a href="#" id="add-new" class="btn default yellow-stripe btn-circle">
                                <i class="fa fa-plus"></i><span class="hidden-480"> Tambah</span>
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <?php include('table.php'); ?>
                        </div>
                    </div>
                </div>
                <!-- End: life time stats -->

                <!-- Modal -->
                <div class="modal fade bs-modal-lg" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="modal_formModalLabel" data-backdrop="static">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal_formModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <?php include('form.php'); ?>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-md-3 text-left"><span class="text-danger">*</span> Harus diisi</div>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary" id="save-btn">Simpan</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var grid = new Datatable();

    grid.init({
        src: $("#datatable"),
        onSuccess: function (grid) {
            // execute some code after table records loaded
        },
        onError: function (grid) {
            // execute some code on network or other general error  
        },
        loadingMessage: 'Loading...',
        dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 
            "lengthMenu": [
                [10, 20, -1],
                [10, 20, "All"] // change per page values here
            ],
            "pageLength": 10, // default record count per page
            "ajax": {
                "url": "<?= base_url() ?>Slideshow/admin_ajax_list", // ajax source,
            },
            "aaSorting": [],
            "columnDefs": [{
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<a href='#' class='detail'><i class='fa fa-lg fa-search'></i></a> &nbsp;&nbsp; <a href='#' class='delete'><i class='fa fa-lg fa-trash-o'></i></a>"
                }],
            "fnDrawCallback": function (oSettings) {
                var no = oSettings._iDisplayStart;
                for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++)
                {
                    $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr).html(i + 1);
                }
            },
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                // <set you align column here>
                $('td:eq(0)', nRow).attr("align", "right");
                $('td:eq(3)', nRow).attr("align", "center");
            },
        }
    });


    $("#add-new").click(function (e) {
        e.preventDefault();
        // load modal when success get JSON
        var modal = $('#modal_form').modal('show');

        // clear error mark
        $.clearErrorMark();
        // reset form
        $.clearInput();
		
		// upload hide
		$("#btn_gambar").show();
		$("#btn_gambar").next().show();
		$("#btn_gambar").next().next().show();
		$("#delete-file-content").hide();
		$("#gambar_content").empty();
		$("#gambar_progress .progress-bar").css({"width":"0%"});
    });

    $('#datatable tbody').on('click', '.detail', function (e) {

        e.preventDefault();

        var table = grid.getDataTable();
        var data = table.row($(this).parents('tr')).data();
        var id = data[0];

        $.ajax({
            cache: false,
            type: "get",
            url: "<?= base_url() ?>Slideshow/get_data_by_id_json",
            data: "id=" + id,
            success: function (response) {
                // load modal when success get JSON
                var modal = $('#modal_form').modal('show');

                // clear error mark
                $.clearErrorMark();
                // reset form
                $.clearInput();

				$("#gambar_content").empty();
				$("#gambar_progress .progress-bar").css({"width":"0%"});
				
                // get data
                // if your form containing textarea then
                // you can customize this code
                var data = JSON.parse(response);
                var judul = data[0].judul;
				var gambar = data[0].gambar;
				var id_slideshow = data[0].id_slideshow;
				
				$("#form #judul").val(judul);
				$("#form #gambar").val(gambar);
				$("#form #id_slideshow").val(id_slideshow);
								
				if( gambar != null ){
					$("#btn_gambar").hide();
					$("#btn_gambar").next().hide();
					$("#btn_gambar").next().next().hide();
					$("#delete-file-content").show();
					
					var tmp = 	'<img src="<?= base_url() ?>upload/slider/' + gambar + '" width="200">';
					$("#gambar_content").append(tmp);
				}else{
					$("#btn_gambar").show();
					$("#btn_gambar").next().show();
					$("#btn_gambar").next().next().show();
					$("#delete-file-content").hide();
				}
            }
        });
    });

    $('#datatable tbody').on('click', '.delete', function (e) {

        e.preventDefault();

        var table = grid.getDataTable();
        var data = table.row($(this).parents('tr')).data();
        var id = data[0];
        if (confirm('Anda yakin menghapus data ini ?')) {
            $.ajax({
                cache: false,
                type: "get",
                url: "<?= base_url() ?>Slideshow/hapus_json",
                data: "id=" + id,
                success: function (response) {
                    var data = JSON.parse(response);
                    var status = data.status;
                    var message = data.message;

                    if (status == '1') {
                        grid.getDataTable().ajax.reload();
                    } else {
                        alert('Gagal menghapus Data');
                    }
                }
            });
        }
    });

	$(".delete-file").click(function(e) {
		e.preventDefault();
		
        var id_slideshow = $("#form #id_slideshow").val();
		if (confirm('Anda yakin menghapus gambar ini ?')) {
            $.ajax({
                cache: false,
                type: "get",
                url: "<?= base_url() ?>Slideshow/hapus_gambar_json",
                data: "id_slideshow=" + id_slideshow,
                success: function (response) {
                    var data = JSON.parse(response);
                    var status = data.status;
                    var message = data.message;

                    if (status == '1') {
						$("#gambar_content").empty();
						
                        $("#btn_gambar").show();
						$("#btn_gambar").next().show();
						$("#btn_gambar").next().next().show();
						$("#delete-file-content").hide();
                    } else {
                        alert(message);
                    }
                }
            });
        }
    });
	
    $("#save-btn").click(function (e) {
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
                    $('#modal_form').modal('hide')
                    grid.getDataTable().ajax.reload();
                } else {
                    $.each(data.message, function (key, value) {
                        var element = $('#form #' + key);
                        console.log(element)
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger')
                                .remove();

                        element.after(value);
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
<script src="<?php echo base_url() ?>theme/assets/global/plugins/dropzone/dropzone.js"></script>
<script>
	// upload file
	var myDropzone = new Dropzone("#btn_gambar", { 
		url: "<?= base_url() ?>Upload/do_upload_sl",
		maxFiles:5,
		acceptedFiles:".jpg, .png, .jpeg",
		dictDefaultMessage:"Upload Berkas (jpg, jpeg, png)"
	});
		
	myDropzone.on("totaluploadprogress", function(progress) {
		$("#gambar_progress .progress-bar").css({"width":progress+"%"});
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
			
			$("#gambar_content").empty();
			var tmp = '<img src="<?= base_url() ?>upload/slider/'+file_name+'" width="200">';
			
			$("#gambar_content").append(tmp);
			$("#gambar").val(file_name);
		}
		this.removeFile(file);
	});
</script>