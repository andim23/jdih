<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?= base_url() ?>theme/assets/global/plugins/respond.min.js"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?= base_url() ?>theme/assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?= base_url() ?>theme/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= base_url() ?>theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?= base_url() ?>theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?= base_url() ?>theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>theme/assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?= base_url() ?>theme/assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?= base_url() ?>theme/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?= base_url() ?>theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="<?php echo base_url() ?>theme/assets/global/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>theme/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>theme/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>theme/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>theme/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>theme/assets/global/scripts/datatable.js"></script>
<script src="<?php echo base_url() ?>theme/assets/global/scripts/helper.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>theme/assets/global/plugins/select2/select2.min.js"></script>
<script src="<?php echo base_url() ?>theme/assets/admin/pages/scripts/components-pickers.js"></script>

<script src="<?= base_url() ?>theme/assets/global/plugins/Highcharts/js/highcharts.js"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/Highcharts/js/highcharts-3d.js"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/Highcharts/js/modules/exporting.js"></script>


<script src="<?= base_url() ?>theme/assets/global/plugins/jquery-idle-timeout/jquery.idletimeout.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/global/plugins/jquery-idle-timeout/jquery.idletimer.js" type="text/javascript"></script>
<script src="<?= base_url() ?>theme/assets/admin/pages/scripts/ui-idletimeout.js"></script>
<script>
	jQuery(document).ready(function() {    
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		ComponentsPickers.init();
		
		Highcharts.setOptions({
			colors: ['#e74c3c', '#2ecc71', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
		});
		
		
		// timeout session
		// cache a reference to the countdown element so we don't have to query the DOM for it on each ping.
		/*var $countdown;

		$('body').append('<div class="modal fade" id="idle-timeout-dialog" data-backdrop="static"><div class="modal-dialog modal-small"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Session anda akan habis.</h4></div><div class="modal-body"><p><i class="fa fa-warning"></i> Anda tidak melakukan aktifitas dalam kurun waktu 2 menit. Halaman akan Logout otomatis dalam <span id="idle-timeout-counter"></span> detik.</p><p>Anda ingin tetap melanjutkan?</p></div><div class="modal-footer"><button id="idle-timeout-dialog-logout" type="button" class="btn btn-default">Tidak, Logout</button><button id="idle-timeout-dialog-keepalive" type="button" class="btn btn-primary" data-dismiss="modal">Ya, saya ingin melanjutkan</button></div></div></div></div>');*/
				
		// start the idle timer plugin
		/*$.idleTimeout('#idle-timeout-dialog', '.modal-content button:last', {
			idleAfter: 120, // 2 minutes
			timeout: 30000, //30 seconds to timeout
			pollingInterval: 5, // 5 seconds
			keepAliveURL: '#',
			serverResponseEquals: 'OK',
			onTimeout: function(){
				window.location = "<?= base_url() ?>auth/logout";
			},
			onIdle: function(){
				$('#idle-timeout-dialog').modal('show');
				$countdown = $('#idle-timeout-counter');

				$('#idle-timeout-dialog-keepalive').on('click', function () { 
					$('#idle-timeout-dialog').modal('hide');
				});

				$('#idle-timeout-dialog-logout').on('click', function () { 
					$('#idle-timeout-dialog').modal('hide');
					$.idleTimeout.options.onTimeout.call(this);
				});
			},
			onCountdown: function(counter){
				$countdown.html(counter); // update the counter
			}
		});*/
		
	});
	
	
</script>
<!-- END JAVASCRIPTS -->