<?php
	$x = $this->input->get('x');
	$y = $this->input->get('y');
?>
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
                            <a href="<?= base_url() ?>Produk_hukum/form?x=<?= $x ?>&y=<?= $y ?>" id="add-new" class="btn default yellow-stripe btn-circle">
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
                                <h4 class="modal-title" id="modal_formModalLabel">Form Produk Hukum</h4>
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
                "url": "<?= base_url() ?>produk_hukum/admin_ajax_list", // ajax source,
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
                $('td:eq(5)', nRow).attr("align", "center");
            },
        }
    });

    $('#datatable tbody').on('click', '.detail', function (e) {

        e.preventDefault();

        var table = grid.getDataTable();
        var data = table.row($(this).parents('tr')).data();
        var id = data[0];
		var url = "<?= base_url() ?>Produk_hukum/form/" + id + '?x=<?= $x ?>&y=<?= $y ?>';
       	location.href = url;
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
                url: "<?= base_url() ?>produk_hukum/hapus_json",
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
	
	$("#btn-filter").click(function(e) {
        var id_kategori = $("#id_kategori").val();
		grid.clearAjaxParams();
        grid.setAjaxParam("id_kategori", id_kategori);
		grid.getDataTable().ajax.reload();
    });

    $("#id_kategori").select2();
</script>