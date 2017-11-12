<link href="<?= base_url() ?>theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url() ?>theme/assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>

<?php
	$row = isset($profile[0])?$profile[0]:array();
?>

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
        	<div class="col-md-12">
            	<!-- BEGIN PAGE CONTENT-->
                <div class="row profile">
                    <div class="col-md-12">
                        <!--BEGIN TABS-->
                        <div class="tabbable tabbable-custom tabbable-full-width">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1_1" data-toggle="tab">Informasi </a></li>
                                <li><a href="#tab_1_3" data-toggle="tab">Akun </a></li>
                                <!--<li><a href="#tab_1_4" data-toggle="tab">Projects </a></li>
                                <li><a href="#tab_1_6" data-toggle="tab">Help </a></li>-->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="list-unstyled profile-nav">
                                                <li>
                                                    <img src="#" 
                                                    	class="img-responsive img" alt="" id="pp_overview"
                                                    />
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-12 profile-info">
                                                    <?php include('profile-info.php'); ?>
                                                </div>
                                                <!--end col-md-8-->
                                                <!--<div class="col-md-4">
                                                    <div class="portlet sale-summary">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                 User Rating
                                                            </div>
                                                            <div class="tools">
                                                                <a class="reload" href="javascript:;">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="portlet-body">
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <span class="sale-info">
                                                                    TODAY SOLD <i class="fa fa-img-up"></i>
                                                                    </span>
                                                                    <span class="sale-num">
                                                                    23 </span>
                                                                </li>
                                                                <li>
                                                                    <span class="sale-info">
                                                                    WEEKLY SALES <i class="fa fa-img-down"></i>
                                                                    </span>
                                                                    <span class="sale-num">
                                                                    87 </span>
                                                                </li>
                                                                <li>
                                                                    <span class="sale-info">
                                                                    TOTAL SOLD </span>
                                                                    <span class="sale-num">
                                                                    2377 </span>
                                                                </li>
                                                                <li>
                                                                    <span class="sale-info">
                                                                    EARNS </span>
                                                                    <span class="sale-num">
                                                                    $37.990 </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <!--end col-md-4-->
                                            </div>
                                            <!--end row-->
                                            <div class="tabbable tabbable-custom tabbable-custom-profile">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_11" data-toggle="tab">Aktifitas Terakhir</a>
                                                    </li>
                                                    <!--<li>
                                                        <a href="#tab_1_22" data-toggle="tab">
                                                        Feeds </a>
                                                    </li>-->
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_1_11">
                                                        <div class="portlet-body">
                                                            <?php include('last_activity_table.php') ?>
                                                        </div>
                                                    </div>
                                                    <!--tab-pane-->
                                                    
                                                    <!--tab-pane-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--tab_1_2-->
                                <div class="tab-pane" id="tab_1_3">
                                    <div class="row profile-account">
                                        <div class="col-md-3">
                                            <ul class="ver-inline-menu tabbable margin-bottom-10">
                                                <li class="active">
                                                    <a data-toggle="tab" href="#tab_1-1">
                                                    <i class="fa fa-cog"></i> Personal Info </a>
                                                    <span class="after">
                                                    </span>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#tab_2-2">
                                                    <i class="fa fa-picture-o"></i> Ganti Avatar </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#tab_3-3">
                                                    <i class="fa fa-lock"></i> Ganti Password </a>
                                                </li>
                                                <!--<li>
                                                    <a data-toggle="tab" href="#tab_4-4">
                                                    <i class="fa fa-eye"></i> Privacity Settings </a>
                                                </li>-->
                                            </ul>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="tab-content">
                                                <div id="tab_1-1" class="tab-pane active">
                                                    <?php include('personal-info.php'); ?>
                                                </div>
                                                <div id="tab_2-2" class="tab-pane">
                                                    <?php include('ganti_avatar.php'); ?>
                                                </div>
                                                <div id="tab_3-3" class="tab-pane">
                                                    <?php include('ganti_password_form.php') ?>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <!--end col-md-9-->
                                    </div>
                                </div>
                                <!--end tab-pane-->
                                
                                <!--end tab-pane-->
                                
                                <!--end tab-pane-->
                            </div>
                        </div>
                        <!--END TABS-->
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
        </div>
    </div>
</div>