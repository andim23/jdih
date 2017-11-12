<!DOCTYPE html>
<html>
 	<head>
		<title>JDIH - Komisi Yudisial</title>
		<meta charset=utf-8 >
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
		<meta name="robots" content="index, follow" > 
		<meta name="keywords" content="HTML5 Template" > 
		<meta name="description" content="Haswell - Responsive HTML5 Template" > 
		<meta name="author" content="Vladimir Azarushkin">

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php include('css.php') ?>
		<?php include('js.php') ?>
	</head>
	<body>
		<!-- LOADER -->	
		<div id="loader-overflow">
      		<div id="loader3">Please enable JS</div>
    	</div>	

		<div id="wrap" class="boxed ">
			<div class="grey-bg"> 
            <!-- Grey BG  -->	
            
            <!--[if lte IE 8]>
            <div id="ie-container">
                <div id="ie-cont-close">
                    <a href='#' onclick='javascript&#058;this.parentNode.parentNode.style.display="none"; return false;'><img src='images/ie-warn/ie-warning-close.jpg' style='border: none;' alt='Close'></a>
                </div>
                <div id="ie-cont-content" >
                    <div id="ie-cont-warning">
                        <img src='images/ie-warn/ie-warning.jpg' alt='Warning!'>
                    </div>
                    <div id="ie-cont-text" >
                        <div id="ie-text-bold">
                            You are using an outdated browser
                        </div>
                        <div id="ie-text">
                            For a better experience using this site, please upgrade to a modern web browser.
                        </div>
                    </div>
                    <div id="ie-cont-brows" >
                        <a href='http://www.firefox.com' target='_blank'><img src='images/ie-warn/ie-warning-firefox.jpg' alt='Download Firefox'></a>
                        <a href='http://www.opera.com/download/' target='_blank'><img src='images/ie-warn/ie-warning-opera.jpg' alt='Download Opera'></a>
                        <a href='http://www.apple.com/safari/download/' target='_blank'><img src='images/ie-warn/ie-warning-safari.jpg' alt='Download Safari'></a>
                        <a href='http://www.google.com/chrome' target='_blank'><img src='images/ie-warn/ie-warning-chrome.jpg' alt='Download Google Chrome'></a>
                    </div>
                </div>
            </div>
            <![endif]-->
				
            <!-- HEADER 1 NO-TRANSPARENT -->
            <?php include('header.php'); ?>

        	<?php
				
            	if(!empty($page)){
					$this->load->view($page);
				}
			?>

            <!-- FOOTER 2 -->
            <?php include('footer.php'); ?>
            
            <!-- BACK TO TOP -->
            <p id="back-top">
              <a href="#top" title="Back to Top"><span class="icon icon-arrows-up"></span></a>
            </p>
        
			</div><!-- End BG -->	
		</div>
        <!-- End wrap -->	
	</body>
</html>		