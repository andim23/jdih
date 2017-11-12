<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <?php
        	// get Full Name by userid $auth_user_id is the global variable from CI Auth to get UserID
			$fullname = $this->auth_username;
			$photo = get_user_photo_by_id($auth_user_id);
		?>
        <li class="dropdown dropdown-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <?php if( $photo ) ?>
            	<img alt="" class="img-circle hide1" id="pp_picture_top" src="<?= base_url() ?>mpo_upload/<?= $photo ?>"/>
            <span class="username username-hide-on-mobile">
            <?= $fullname ?> </span>
            <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li id="user_profile">
                    <a href="<?= base_url() ?>user_profile?z=dropdownmenu">
                    <i class="icon-user"></i> Profil Saya </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>auth/logout">
                    <i class="icon-key"></i> Log Out </a>
                </li>
            </ul>
        </li>
    </ul>
</div>

<script>
	if( "<?= $this->input->get('z') ?>" != "" ){
		$(".dropdown-menu #<?= $this->uri->segment('1'); ?>").addClass('active');
	}
</script>