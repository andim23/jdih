<?php
	$nav = get_frontend_nav();
?>
<nav class="collapse collapsing navbar-collapse right-1024">
  <ul class="nav navbar-nav">
    
    <!-- MENU ITEM -->
    <?php foreach($nav as $row){ ?>
    <li class="parent "><!--current-->
    	<a href="<?= base_url() . $row->url ?>"><div class="main-menu-title"><?= strtoupper($row->displayname) ?></div></a>
        <?php if(!empty($row->sub)){ ?>
        <ul class="sub">
        	<?php foreach( $row->sub as $r ){ ?>
        	<li><a class="current" href="<?= base_url() . $r->url ?>"><?= strtoupper($r->displayname) ?></a></li>
        	<?php } ?>
        </ul>
        <?php } ?>
    </li>
    <?php } ?>
    	
  </ul>
</nav>