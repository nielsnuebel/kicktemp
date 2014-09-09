<?php defined( '_JEXEC' ) or die; 

include_once JPATH_THEMES . '/' . $this->template . '/magic.php'; // load magic.php


$contentclass = "col-md-12";
if ($this->countModules('sidebar-a') or  $this->countModules('sidebar-b')) $contentclass = $this->params->get('content-2-col','col-md-8');
if ($this->countModules('sidebar-a') and $this->countModules('sidebar-b')) $contentclass = $this->params->get('content-3-col','col-md-4');
$sidebar_a = $this->params->get('sidebar-a','col-md-4');
$sidebar_b = $this->params->get('sidebar-b','col-md-4');
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
  	<!--[if lte IE 9]>
    	<script src="<?php echo $tpath; ?>/js/html5.js"></script>
    	<script src="<?php echo $tpath; ?>/js/respond.js"></script>
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
  
	<?php require_once __DIR__ . '/index_' . $pagetype . '.php'; ?>

</html>

