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
                            
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <?php include('form.php'); ?>
                        </div>
                    </div>
                </div>
                <!-- End: life time stats -->
            </div>
        </div>
    </div>
</div>