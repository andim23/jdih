<html lang="en">
	<?php $this->load->view('templates/layout_horizontal_sidebar_menu/head') ?>
    <style>
		body { background:#FFFFFF !important; }
	</style>
<body>
<div class="page-container">
	<div class="col-md-12">
    <div class="page-content">
	<?php
        $page = isset($page)?$page:'templates/layout_horizontal_sidebar_menu/content_empty'; 
        $this->load->view($page); 
    ?>
    </div>
    </div>
</div>
</body>
<!-- END BODY -->

</html>