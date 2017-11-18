<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <?php $this->load->view('pages/include/breadcrumb') ?>
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <!-- Begin: life time stats -->
                <div class="portlet light">
                    <div class="portlet-body">
                        <div class="table-container">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs ">
                                    <li class="active">
                                        <a href="#tab_15_1" data-toggle="tab">
                                        Detail Permohonan </a>
                                    </li>
                                    <li class="">
                                        <a href="#tab_15_2" data-toggle="tab">
                                        Status Permohonan </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_15_1">
                                        <?php include('detail.php') ?>
                                    </div>
                                    <div class="tab-pane" id="tab_15_2">
                                        <?php include('detail_histori.php') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End: life time stats -->
            </div>
        </div>
    </div>
</div>

