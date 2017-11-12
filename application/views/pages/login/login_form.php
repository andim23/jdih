<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.3.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Login Form | JDIH</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url() ?>theme/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>theme/assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url() ?>theme/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>theme/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>theme/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo base_url() ?>theme/assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>theme/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<!--<link rel="shortcut icon" href="<?= base_url() ?>theme/assets/admin/layout/img/icon.png" />-->
<style>
	.logo{
		margin-top:5% !important;
	}
</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<center>
        <a href="<?php echo base_url() ?>">
            <img src="<?php echo base_url() ?>theme/assets/admin/layout/img/logo.png" alt=""/>
        </a>
    </center>
<?php
if( ! isset( $on_hold_message ) )
{
?>
	<!-- BEGIN LOGIN FORM -->
	<?= form_open( $login_url, array('class' => 'login-form') );  ?>
        <?php
        	if( ! isset( $optional_login ) )
			{
				echo '<center><h3 class="form-title">Login ke JDIH</h3></center>';
			}
		?>
        <div>
        	<?php
            	if( isset( $login_error_mesg ) )
				{
					echo '
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							Login Error #' . $this->authentication->login_errors_count . 
							'/' . config_item('max_allowed_attempts') . 
							': Invalid Username, Email Address, or Password. Username, 
							email address and password are all case sensitive.
						</div>
					';
				}
				
				if( $this->input->get('logout') )
				{
					echo '
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							You have successfully logged out.
						</div>
					';
				}
			?>
        </div>
		
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username atau Email" name="login_string" id="login_string" maxlength="255" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
                <input type="password" name="login_pass" id="login_pass" class="form_input password form-control placeholder-no-fix" <?php 
					if( config_item('max_chars_for_password') > 0 )
						echo 'maxlength="' . config_item('max_chars_for_password') . '"'; 
				?> autocomplete="off" placeholder="Password" readonly onfocus="this.removeAttribute('readonly');" />
			</div>
		</div>
		<div class="form-actions">
			<?php
				if( config_item('allow_remember_me') )
				{
			?>
            	<label class="checkbox"><input type="checkbox" id="remember_me" name="remember_me" value="yes" /> Remember me </label>
            <?php
				}
			?>
			<button type="submit" class="btn  blue pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		<div class="forget-password">
			<h4>Lupa Password ?</h4>
			<p>
				Klik <a href="javascript:;" id="forget-password"> disini </a>
				untuk mendapatkan Password Baru.
			</p>
            <h4>Butuh Panduan ?</h4>
            <p>
            	Klik <a href="<?= base_url() ?>upload/guide/manual book.pdf" target="_blank">disini</a> untuk mengunduh Panduan
            </p>
		</div>
	</form>
	<!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
	<form class="forget-form" id="forget-form" action="#" method="post">
		<h3>Lupa Password ?</h3>
		<p>
			 Masukkan <strong>Email</strong> anda dibawah ini kemudian klik <strong>Kirim</strong>.
             Email baru akan dikirim ke alamat Email anda.
		</p>
		<div class="status">
        </div>
        <div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" id="email" />
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn"><i class="m-icon-swapleft"></i> Kembali </button>
			<button type="button" id="btn_kirim_password" class="btn blue pull-right">Kirim <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->
<?php
	}
	else
	{
		// EXCESSIVE LOGIN ATTEMPTS ERROR MESSAGE
		echo '
			<div class="note note-danger">
				<b>
					Excessive Login Attempts
				</b>
				
					You have exceeded the maximum number of failed login<br />
					attempts that this website will allow.
				
					Your access to login and account recovery has been blocked for ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes.
				
					Please use the <a href="/examples/recover">Account Recovery</a> after ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes has passed,<br />
					or contact us if you require assistance gaining access to your account.
				
			</div>
		';
	}
?>

	<center>
    	2017 &copy; JDIH - Komisi Yudisial
    </center>

</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url() ?>theme/assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url() ?>theme/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url() ?>theme/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>theme/assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url() ?>theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>theme/assets/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
  	Login.init();
       // init background slide images
   /* $.backstretch(
		[
			"<?php echo base_url() ?>theme/assets/admin/pages/media/bg/back-1.jpg",
			"<?php echo base_url() ?>theme/assets/admin/pages/media/bg/back-2.jpg",
			"<?php echo base_url() ?>theme/assets/admin/pages/media/bg/back-3.jpg"
        ], 
		{
          fade: 1000,
          duration: 8000
    	}
    );*/
	
	function kirm_password(){
		var email = $("#forget-form #email").val();
		$(".status").empty();
		if( email != '' ){
			$.ajax({
				type: "post",
				url: "<?= base_url() ?>Login/lupa_password_proses",
				data: "email=" + email,
				beforeSend: function(){
					$("#btn_kirim_password").text('Mohon tunggu...').attr('disabled', 'disabled');
				},
				success: function (response) {
					var data = JSON.parse(response);
					var status = data.status;
					var message = data.message;
					var tmp = '';
					if( status == '1' ){
						tmp = '<div class="alert alert-success">'+message+'</div>';
					}else{
						tmp = '<div class="alert alert-danger">'+message+'</div>';
					}
					$(".status").prepend(tmp);
				},
				complete: function(){
					$("#btn_kirim_password").text('').removeAttr('disabled').append('Kirim <i class="m-icon-swapright m-icon-white"></i>');
				},
				error: function(){
					tmp = '<div class="alert alert-danger">Proses Gagal. Refresh halaman kemudian ulangi proses atau hubungi Administrator anda.</div>';
					$(".status").prepend(tmp);
				}
			});
		}else{
			var tmp = '<div class="alert alert-danger">Inputkan alamat Email anda.</div>';
			$(".status").prepend(tmp);
		}
	}
	
	$("#btn_kirim_password").click(function(e) {
        kirm_password();
    });
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>