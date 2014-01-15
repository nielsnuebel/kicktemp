<?php defined( '_JEXEC' ) or die; 

include_once JPATH_THEMES . '/' . $this->template . '/logic.php'; // load logic.php
include_once JPATH_THEMES . '/' . $this->template . '/include/kickmodulrender.php'; // load logic.php

//Alternativ to <jdoc:include type="modules" name="top" style="html5"/> use PHP echo kickstartmodul('top',kickstartmodul,12);

//Set Component Grid CSS
$contentclass = "col-md-12";
if ($this->countModules('sidebar-a') or  $this->countModules('sidebar-b')) $contentclass = "col-md-8";
if ($this->countModules('sidebar-a') and $this->countModules('sidebar-b')) $contentclass = "col-md-4";

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
        <?php if($this->params->get('googleanalyticsdomain')){?>
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', '<?php echo $this->params->get('googleanalyticscode');?>', '<?php echo $this->params->get('googleanalyticsdomain');?>');
                ga('set', 'anonymizeIp', true);
                ga('send', 'pageview');
            </script>
        <?php
        }//if
        else {
        ?>
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
        <?php
        }//else
    endif;
    ?>
</head>
  
<body class="<?php echo (($menu->getActive() == $menu->getDefault()) ? ('front') : ('page')).' '.$active->alias.' '.$pageclass; ?>">

<div class="container">
    <?php if ($this->countModules('logo')): ?>
        <!-- Logo -->
        <div class="row logo">
            <jdoc:include type="modules" name="logo" style="html5"/>
        </div><!-- div.row -->
    <?php endif;?>

    <!-- RESPONSIVE MENU-->
    <?php if ($this->countModules('menu')): ?>
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
				<jdoc:include type="modules" name="menu"/>
				<jdoc:include type="modules" name="search" />
			</div><!-- /.navbar-collapse -->
	    </nav>
    <?php endif;?>

    <?php if ($this->countModules('top')): ?>
        <!-- TOP -->
        <div class="row top">
            <jdoc:include type="modules" name="top" style="html5"/>
        </div><!-- div.row -->
    <?php endif;?>

    <!-- CONTENT -->
    <div class="content">
	    <div class="row">
            <?php if ($this->countModules('sidebar-a')): ?>
			<div class="col-md-4 col-lg-4 sidebar-a">
                <div class="row">
                    <jdoc:include type="modules" name="sidebar-a" style="html5"/>
                </div>
			</div><!-- .sidebar-a -->
		    <?php endif;?>

		    <div class="<?php echo $contentclass; ?> middle">
                <?php if ($this->countModules('inner-top')): ?>
				<div class="row inner-top">
                    <jdoc:include type="modules" name="inner-top" style="html5"/>
				</div><!-- .inner-top -->
			    <?php endif;?>

                <jdoc:include type="message" />
                <?php if (!preg_match('/nocontent/',$pageclass)) {?>
                    <!-- Component Start -->
                    <jdoc:include type="component" />
                    <!-- Component End -->
                <? }?>

                <?php if ($this->countModules('inner-bottom')): ?>
				<div class="row inner-bottom">
                    <jdoc:include type="modules" name="inner-bottom" style="html5"/>
				</div><!-- .inner-bottom -->
			    <?php endif;?>
		    </div><!-- .middle -->

            <?php if ($this->countModules('sidebar-b')): ?>
                <div class="col-md-4 col-lg-4 sidebar-b">
                    <div class="row">
                        <jdoc:include type="modules" name="sidebar-b" style="html5"/>
                    </div>
                </div><!-- .sidebar-b -->
            <?php endif;?>
	    </div><!-- div.row -->
    </div><!-- div.content -->

    <?php if ($this->countModules('bottom')): ?>
    <!-- BOTTOM -->
	<div class="row bottom">
        <jdoc:include type="modules" name="bottom" style="html5"/>
    </div><!-- div.row -->
    <?php endif;?>

    <?php if ($this->countModules('footer')): ?>
    <!-- FOOTER -->
    <footer>
        <div class="row footer">
            <jdoc:include type="modules" name="footer" style="html5"/>
        </div><!-- .footer -->
    </footer>
    <?php endif;?>

    <div class="row copyright">
        <div class="col-md-12 col-lg-12"><?php echo '&copy; '.date('Y').' - '.$app->getCfg('sitename');?></div>
    </div><!-- .copyright -->
</div><!-- .container -->

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

