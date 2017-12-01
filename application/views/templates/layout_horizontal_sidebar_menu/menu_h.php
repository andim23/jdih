<?php 
	$nav = get_top_navigation($this->auth_level)
?>

<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
		<!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) sidebar menu below. So the horizontal menu has 2 seperate versions -->
<div class="hor-menu hidden-sm hidden-xs">
    <ul class="nav navbar-nav" id="top_nav">
        <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
        <?php 
			foreach( $nav as $row ){ 
			$page = !empty($row->url)?$row->url:'page/get_left_menu';
		?>
        <li id="<?= $row->sitemapid ?>">
            <a href="<?= base_url() . $page . '?x=' . $row->sitemapid ?>"><?= $row->icon ?> <?= $row->displayname ?></a>
        </li>
        <?php } ?>
    </ul>
</div>

<script>
	function set_active_topnav(){
		if( "<?= $this->input->get("x") ?>" != "" ){
			$("#top_nav #<?= $this->input->get("x") ?>").addClass('active');
			$("#top_nav #<?= $this->input->get("x") ?> a").append('<span class="selected"></span>')
		}
		else{
			//$("#top_nav li").first().addClass("active");
			//$("#top_nav li").first().append('<span class="selected"></span>');
		}
	}
	
	$(document).ready(function(e) {
		set_active_topnav();
    });
</script>