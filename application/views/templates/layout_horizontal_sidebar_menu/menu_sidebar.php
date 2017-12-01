<?php
	$sitemapid = $this->input->get('x');
	$sitemapid = isset($sitemapid)?$sitemapid:NULL;
	$snav = get_left_navigation($sitemapid, $this->auth_level);
?>
<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU1 -->
        <ul class="page-sidebar-menu hidden-sm hidden-xs" data-auto-scroll="true" data-slide-speed="200" id="sidebar">
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <!-- DOC: This is mobile version of the horizontal menu. The desktop version is defined(duplicated) in the header above -->
            
            <?php 
				foreach( $snav as $row ){ 
					if( empty($row->sub) )
					{
						$icon = !empty($row->icon)?$row->icon:'<i class="fa fa-circle-o"></i>';
			?>
                    <li id="<?= $row->sitemapid ?>">
                        <a href="<?= base_url() . $row->url . '?x=' . $sitemapid . '&y=' . $row->sitemapid ?>" id="<?= $row->name ?> "> 
                        <?= $icon ?> <span class="title"> <?= $row->displayname ?> </span>
                        </a>
                    </li>
            <?php
					}else{
			?>
            		<li>
                        <a href="#">
                        	<i class="fa fa-circle-o"></i>  
                            <span class="title"><?= $row->displayname ?></span> 
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                            <?php foreach( $row->sub as $r ){ ?>
                            <li id="<?= $r->sitemapid ?>">
                                <a href="<?= base_url() . $r->url . '?x=' . $sitemapid . '&y=' . $r->sitemapid ?>" id="<?= $r->name ?> ">
                                <span class="title"><?= $r->displayname ?> </span> </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
            <?php
					}
				} 
			?>
            
        </ul>
        <!-- END SIDEBAR MENU1 -->
        <!-- BEGIN RESPONSIVE MENU FOR HORIZONTAL & SIDEBAR MENU -->
        <?php 
			$tnav = get_top_navigation($this->auth_level)
		?>
        <ul class="page-sidebar-menu visible-sm visible-xs" data-slide-speed="200" data-auto-scroll="true">
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <!-- DOC: This is mobile version of the horizontal menu. The desktop version is defined(duplicated) in the header above -->
            <?php 
				foreach( $tnav as $trow ){ 
				
				$sitemapid = $trow->sitemapid;
				$snav = get_left_navigation($sitemapid, $this->auth_level);
				
				$page = !empty($trow->url)?$trow->url:'page/get_left_menu';
			?>
            <?php if( !empty($snav) ){ ?>
            <li>
                <a href="#"><?= $trow->displayname ?></a>
                <ul class="sub-menu">
                    <?php foreach( $snav as $srow ){ ?>
                    <?php
                    	if( !empty($srow->sub) ){
					?>
                    <li>
                        <a href="javascript:;"><?= $srow->displayname ?> <span class="arrow"></span></a>
                        <ul class="sub-menu">
                        	<?php foreach( $srow->sub as $ssrow ){ ?>
                            <li>
                            	<a href="<?= base_url() . $ssrow->url . '?x=' . $sitemapid . '&y=' . $ssrow->sitemapid ?>" id="<?= $ssrow->name ?> ">
                                    <span class="title"><?= $ssrow->displayname ?> </span>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php }else{ ?>
                    <li> 
                    	<a href="<?= base_url() . $srow->url . '?x=' . $sitemapid . '&y=' . $srow->sitemapid ?>" id="<?= $srow->name ?> ">
                        	<span class="title"><?= $srow->displayname ?> </span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php } ?>
                </ul>
            </li>
            <?php }else{ ?>
            <li><a href="<?= base_url() . $page . '?x=' . $trow->sitemapid ?>"><?= $trow->displayname ?></a></li>
            <?php } ?>
            <?php } ?>
        </ul>
        <!-- END RESPONSIVE MENU FOR HORIZONTAL & SIDEBAR MENU -->
    </div>
</div>
<script>
	function set_active_sidebar(){
		if( "<?= $this->input->get('y') ?>" != ""){
			$("#sidebar #<?= $this->input->get('y') ?>").addClass("active");
			var c = $("#sidebar #<?= $this->input->get('y') ?>").parent().attr("class");
			if( c == 'sub-menu' ){
				$("#sidebar #<?= $this->input->get('y') ?>").parent().parent().addClass("active");
				$("#sidebar #<?= $this->input->get('y') ?>").parent().parent().find('a').append('<span class="selected"></span>');
			}else{
				$("#sidebar #<?= $this->input->get('y') ?> a").append('<span class="selected"></span>');
			}
		}
	}

	$(document).ready(function(e) {
		set_active_sidebar();
	});
</script>