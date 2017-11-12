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
                    <div class="modal-dialog modal-full" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal_formModalLabel">Form Konten Statis</h4>
                            </div>
                            <div class="modal-body scroll">
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
                "url": "<?= base_url() ?>Konten_statis/admin_ajax_list", // ajax source,
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
                $('td:eq(3), td:eq(4)', nRow).attr("align", "center");
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
		
		$('#form #isi').val("");
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
            url: "<?= base_url() ?>Konten_statis/get_data_by_id_json",
            data: "id=" + id,
            success: function (response) {
                // load modal when success get JSON
                var modal = $('#modal_form').modal('show');

                // clear error mark
                $.clearErrorMark();
                // reset form
                $.clearInput();
				// image content
				$("#gambar_content").empty();
				$("#gambar_progress .progress-bar").css({"width":"0%"});
				
                // get data
                // if your form containing textarea then
                // you can customize this code
                var data = JSON.parse(response);
                var recid = data[0].recid;
				var id_gambar = data[0].id_gambar;
				var nama = data[0].nama;
				var judul = data[0].judul;
				var isi = data[0].isi;
				var filename = data[0].filename;
				
				$("#form #recid").val(recid);
				$("#form #id_gambar").val(id_gambar);
				$("#form #nama").val(nama);
				$("#form #judul").val(judul);
				//$('#form #ckeditor').text(isi);
				
				CKEDITOR.instances.ckeditor.setData( isi );
				//alert(filename)
				if( filename != null ){
					$("#btn_gambar").hide();
					$("#btn_gambar").next().hide();
					$("#btn_gambar").next().next().hide();
					$("#delete-file-content").show();
					
					var tmp = 	'<img src="<?= base_url() ?>upload/konten_statis/' + filename + '" width="200">';
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
                url: "<?= base_url() ?>Konten_statis/hapus_json",
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
		
        var id_gambar = $("#form #id_gambar").val();
		if (confirm('Anda yakin menghapus gambar ini ?')) {
            $.ajax({
                cache: false,
                type: "get",
                url: "<?= base_url() ?>Konten_statis/hapus_gambar_json",
                data: "id_gambar=" + id_gambar,
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
		var isi = CKEDITOR.instances['ckeditor'].getData()
 		data = data + "&isi=" + encodeURIComponent(isi);
		
		
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
	$(document).ready(function(e) {
        $('.wysihtml5').wysihtml5({
			"stylesheets": ["<?php echo base_url() ?>theme/assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"],
			"toolbar": true
		});
    });
	
	// upload file
	var myDropzone = new Dropzone("#btn_gambar", { 
		url: "<?= base_url() ?>Upload/do_upload_ks",
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
			var tmp = '<img src="<?= base_url() ?>upload/konten_statis/'+file_name+'" width="200">';
			
			$("#gambar_content").append(tmp);
			$("#gambar").val(file_name);
		}
		this.removeFile(file);
	});
</script>