<?php defined( '_JEXEC' ) or die; 

include_once JPATH_THEMES . '/' . $this->template . '/logic.php'; // load logic.php
include_once JPATH_THEMES . '/' . $this->template . '/include/template.php'; // load logic.php

// check modules
$show_menu			= ($this->countModules('menu'));
$show_logo			= ($this->countModules('logo'));
$show_top			= ($this->countModules('top'));
$show_bottom		= (blankmodul('bottom','blank',12));
$show_inner_top		= ($this->countModules('inner-top'));
$show_inner_bottom	= ($this->countModules('inner-bottom'));
$show_sidebar_a		= (blankmodul('sidebar-a','blank',false));
$show_sidebar_b		= (blankmodul('sidebar-b','blank',false));
$show_footer		= (blankmodul('footer','blank',12));

$contentclass = "col-md-12";
if($show_sidebar_a or $show_sidebar_b) $contentclass = "col-md-8";
if ($show_sidebar_a and $show_sidebar_b)$contentclass = "col-md-4";


?>

<!doctype html>
<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<head>
	<?php if (!$this->params->get('meta-viewport')):?>
  		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<?php endif; ?>
	<jdoc:include type="head" />
  	<link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/images/apple-touch-icon-57x57-precomposed.png">
  	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/images/apple-touch-icon-72x72-precomposed.png">
  	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/images/apple-touch-icon-114x114-precomposed.png">
  	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $tpath; ?>/images/apple-touch-icon-144x144-precomposed.png">
  	<!--[if lte IE 8]>
    	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    	<?php if ($pie==1) : ?>
      		<style>
        		{behavior:url(<?php echo $tpath; ?>/js/PIE.htc);}
      		</style>
    	<?php endif; ?>
  	<![endif]-->
	<?php if ($this->params->get('googleanalytics') && $this->params->get('googleanalyticscode')!='') : ?>
		<!-- GOOGLEANAYLTICS -->
		<script type="text/javascript">

			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo $this->params->get('googleanalyticscode');?>']);
			_gaq.push(['_gat._anonymizeIp']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();

		</script>
	<?php endif; ?>
</head>
  
<body class="<?php echo (($menu->getActive() == $menu->getDefault()) ? ('front') : ('page')).' '.$active->alias.' '.$pageclass; ?>">

<div class="container">
<!-- RESPONSIVE MENU-->
    <?php if ($show_menu): ?>
		<nav class="navbar navbar-default" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand" href="<?php echo $this->baseurl; ?>/"><?php echo $app->getCfg('sitename'); ?></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<jdoc:include type="modules" name="menu" />
				<jdoc:include type="modules" name="search" />
			</div><!-- /.navbar-collapse -->
	    </nav>
    <?php endif;?>

    <?php if ($show_top): ?>
        <!-- TOP -->
        <div class="row top">
            <?php echo blankmodul('top','blank',false);?>
        </div><!-- div.row -->
    <?php endif;?>

    <!-- CONTENT -->
    <div class="content">
	    <div class="row">
		<?php if ($show_sidebar_a): ?>
			<div class="col-md-4 col-lg-4 sidebar-a">
				<?php echo $show_sidebar_a;?>
			</div>
		<?php endif;?>

		<div class="<?php echo $contentclass; ?>">
			<?php if ($show_inner_top): ?>
				<div class="row inner-top">
					<?php echo blankmodul('inner-top','blank',12);?>
				</div>
			<?php endif;?>
			<jdoc:include type="message" />
			<jdoc:include type="component" />
			<?php if ($show_inner_bottom): ?>
				<div class="row inner-bottom">
					<?php echo blankmodul('inner-bottom','blank',12);?>
				</div>
			<?php endif;?>
		</div>
		<?php if ($show_sidebar_b): ?>
			<div class="col-md-4 col-lg-4 sidebar-b">
				<?php echo $show_sidebar_b;?>
			</div>
		<?php endif;?>
	    </div><!-- div.row -->
    </div> <!-- div.content -->

    <?php if ($show_bottom): ?>
	<!-- BOTTOM -->
		<div class="row bottom hidden-xs">
			<?php echo $show_bottom;?>
		</div><!-- div.row -->
    <?php endif;?>

    <?php if ($show_footer): ?>
        <!-- FOOTER -->
        <footer>
            <div class="row footer">
                <?php echo $show_footer;?>
            </div>
         </footer>
    <?php endif;?>

    <div class="row copyright">
        <div class="col-md-12 col-lg-12"><?php echo '&copy; '.date('Y').' - '.$app->getCfg('sitename');?>
    </div>


  	<jdoc:include type="modules" name="debug" />

  	<?php if ($this->params->get('bootstrap')==1 && $this->params->get('bootstrapmenu')) : ?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				// dropdown
			  	$('nav .menu > .deeper').addClass('dropdown');
			  	$('nav .menu > .deeper > a').addClass('dropdown-toggle');
				//$('nav .menu > .deeper > a').addClass('dropdown-toggle disabled'); allow click
				$('nav .menu > .deeper > a').attr('data-toggle', 'dropdown');
				$('nav .menu > .deeper > a').attr('href', '#');
			  	$('nav .menu > .deeper > a').append('<span  class="caret"></span>');
			  	$('nav .menu > .deeper > ul').addClass('dropdown-menu');
			});
	  	})(jQuery);
	</script>
  	<?php endif; ?>
    <?php if ($this->params->get('holder')==1) : ?>
        <script src="<?php echo $tpath.'/js/holder.js';?>"></script>
    <?php endif; ?>
</body>

</html>

