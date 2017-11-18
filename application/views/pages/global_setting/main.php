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
                                <h4 class="modal-title" id="modal_formModalLabel">Form <?= $htitle ?></h4>
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
                "url": "<?= base_url() ?>Sys_globalvar/admin_ajax_list", // ajax source,
            },
            "aaSorting": [],
            "columnDefs": [{
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<a href='#' class='detail'><i class='fa fa-lg fa-search'></i></a> &nbsp;&nbsp; <a href='#' class='delete'><i class='fa fa-lg fa-trash-o'></i></a>"
                }],
            "fnDrawCallback": function (oSettings) {
                for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++)
                {
                    $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr).html(i + 1);
                }
            },
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                // <set you align column here>
                $('td:eq(0)', nRow).attr("align", "right");
				$('td:eq(2)', nRow).attr("align", "right");
				$('td:eq(3)', nRow).attr("align", "right");
                $('td:eq(7)', nRow).attr("align", "center");
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
    });

    $('#datatable tbody').on('click', '.detail', function (e) {

        e.preventDefault();

        var table = grid.getDataTable();
        var data = table.row($(this).parents('tr')).data();
        var id = data[0];

        $.ajax({
            cache: false,
            type: "get",
            url: "<?= base_url() ?>Sys_globalvar/get_data_by_id_json",
            data: "id=" + id,
            success: function (response) {
                // load modal when success get JSON
                var modal = $('#modal_form').modal('show');

                // clear error mark
                $.clearErrorMark();
                // reset form
                $.clearInput();

                // get data
                // if your form containing textarea then
                // you can customize this code
                var data = JSON.parse(response);
                var varid = data[0].varid;
				var varname = data[0].varname;
				var val_int = data[0].val_int;
				var val_float = data[0].val_float;
				var val_date = data[0].val_date_char;
				var val_datefrom = data[0].val_datefrom_char;
				var val_dateto = data[0].val_dateto_char;
				var val_datetime = data[0].val_datetime_char;
				var val_varchar = data[0].val_varchar;
				var val_text = data[0].val_text;
				var guide = data[0].guide;
				
				
				$("#varid").val(varid);
				$("#varname").val(varname);
				$("#val_int").val(val_int);
				$("#val_float").val(val_float);
				$("#val_date").val(val_date);
				$("#val_datefrom").val(val_datefrom);
				$("#val_dateto").val(val_dateto);
				$("#val_datetime").val(val_datetime);
				$("#val_varchar").val(val_varchar);
				$('#val_text').data("wysihtml5").editor.setValue(val_text);
				$("#guide").val(guide);
				
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
                url: "<?= base_url() ?>Sys_globalvar/hapus_json",
                data: "id=" + id,
                success: function (response) {
                    var data = JSON.parse(response);
                    var status = data.status;
                    var message = data.message;

                    if (status == '1') {
                        grid.getDataTable().ajax.reload();
                        //grid.clearAjaxParams();
                    } else {
                        alert('Gagal menghapus Data');
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
                    //grid.clearAjaxParams();
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