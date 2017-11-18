<?php
	$nav = get_frontend_nav();
?>
<nav class="collapse collapsing navbar-collapse right-1024">
  <ul class="nav navbar-nav">  
    <!-- MENU ITEM -->
    <?php foreach($nav as $row){ ?>
		<?php if(!empty($row->sub)){ ?>
            <li class="parent">
                <a href="<?= base_url() . $row->url ?>"><div class="main-menu-title"><?= strtoupper($row->displayname) ?></div></a>
                
                <ul class="sub">
                    <?php foreach( $row->sub as $r ){ ?>
                    <li><a class="current" href="<?= base_url() . $r->url ?>"><?= strtoupper($r->displayname) ?></a></li>
                    <?php } ?>
                </ul>
                
            </li>
        <?php }else{ ?>
        	<li>
                <a href="<?= base_url() . $row->url ?>"><div class="main-menu-title"><?= strtoupper($row->displayname) ?></div></a>   
            </li>
		<?php } ?>
    <?php } ?>
    	
  </ul>
</nav>