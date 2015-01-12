<?php
/**
 * KICKTEMP
 * 
 * @package     Joomla.Site
 * @subpackage  Templates.kicktemp
 *
 * @author      Niels Nübel <n.nuebel@nn-medienagentur.de>
 * @copyright   Copyright (c) 2015 NN-Medienagentur.de
 * @license     GNU General Public License version 2 or later
 */

defined( '_JEXEC' ) or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option     = $app->input->getCmd('option', '');
$view       = $app->input->getCmd('view', '');
$layout     = $app->input->getCmd('layout', '');
$task       = $app->input->getCmd('task', '');
$itemid     = $app->input->getCmd('Itemid', '');
$sitename   = $app->get('sitename');

// Set KICKTEMP Variables
$menu               = $app->getMenu();
$active             = $app->getMenu()->getActive();
$pageclass          = $app->getParams()->get('pageclass_sfx');
$headdata           = $doc->getHeadData();
$tpath              = $this->baseurl.'/templates/'.$this->template;
$assets             = $tpath . '/assets';
$googlefont         = $params->get('googlefont');
$pagetype           = $params->get('pagetype', 'multipage');
$hidecontentwrapper = $params->get('hidecontentwrapper', 0);
$showsystemoutput   = $params->get('showsystemoutput', 1);

$isFrontpage        = false;
$active_alias       = '';

if ($active)
{
    $defaultmenuitems = array($menu->getDefault()->id, $menu->getDefault(JFactory::getLanguage()->getTag())->id);
    $isFrontpage = in_array($active->id, $defaultmenuitems);
    $active_alias = $active->alias;
}

// advanced parameter
if ($app->isSite())
{
    // disable js
    if ( $params->get('disablejs') )
    {
        $fnjs=$params->get('fnjs');
        if (trim($fnjs) != '')
        {
            $filesjs=explode(',', $fnjs);
            $head = (array) $headdata['scripts'];
            $newhead = array();

            foreach($head as $key => $elm)
            {
                $add = true;
                foreach ($filesjs as $dis)
                {
                    if (strpos($key,$dis) !== false)
                    {
                        $add=false;
                        break;
                    }
                }

                if ($add) $newhead[$key] = $elm;
            }

            $headdata['scripts'] = $newhead;
        }
    }
    // disable css
    if ( $params->get('disablecss') )
    {
        $fncss=$params->get('fncss');
        if (trim($fncss) != '')
        {
            $filescss=explode(',', $fncss);
            $head = (array) $headdata['styleSheets'];
            $newhead = array();
            foreach($head as $key => $elm)
            {
                $add = true;
                foreach ($filescss as $dis)
                {
                    if (strpos($key,$dis) !== false)
                    {
                        $add=false;
                        break;
                    }
                }

                if ($add) $newhead[$key] = $elm;
            }

            $headdata['styleSheets'] = $newhead;
        }
    }

    $doc->setHeadData($headdata);
}

// generator tag
$this->setGenerator(null);

// force latest IE & chrome frame
$doc->setMetadata('x-ua-compatible', 'IE=edge,chrome=1');


if ($googlefont !='') $doc->addStyleSheet("https://fonts.googleapis.com/css?family=".$googlefont);

//Add CSS and Javascript
$doc->addStyleSheet($tpath.'/css/style.css');
$doc->addScript($tpath.'/js/frontend.js');

$jquerypath = $tpath.'/js/frontend.js';
$tmpScripts = array();
$tmpScripts = $doc->_scripts;


unset( $tmpScripts[$this->baseurl.'/media/widgetkit/js/jquery.js'] );
unset( $tmpScripts[$this->baseurl.'/media/jui/js/jquery.min.js'] );
unset( $tmpScripts[$this->baseurl.'/media/jui/js/jquery-migrate.min.js'] );
unset( $tmpScripts[$this->baseurl.'/media/jui/js/jquery-noconflict.js'] );
//unset( $tmpScripts[$this->baseurl.'/media/system/js/caption.js'] );

$neuScript = array();

$neuScript[$jquerypath] = $tmpScripts[$jquerypath];
foreach($tmpScripts as $key=> $value)
{
    if($key != $jquerypath)
    {
        $neuScript[$key] = $value;
    }
}
$doc->_scripts = $neuScript;


$contentclass = "col-md-12";
if ($this->countModules('sidebar-a') or  $this->countModules('sidebar-b')) $contentclass = $this->params->get('content-2-col','col-md-8');
if ($this->countModules('sidebar-a') and $this->countModules('sidebar-b')) $contentclass = $this->params->get('content-3-col','col-md-4');
$sidebar_a = $this->params->get('sidebar-a','col-md-4');
$sidebar_b = $this->params->get('sidebar-b','col-md-4');
?>

<!DOCTYPE html>
<!--[if lte IE 8]> <html class="oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 9]> <html class="ie9" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="<?php echo $this->language; ?>"> <!--<![endif]-->
<head>
	<?php if (!$this->params->get('meta-viewport')):?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php endif; ?>
	<jdoc:include type="head" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/images/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/images/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/images/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $tpath; ?>/images/apple-touch-icon-144x144-precomposed.png">
  	<!--[if lte IE 9]>
    	<script src="<?php echo $tpath; ?>/js/html5shiv.js"></script>
    	<script src="<?php echo $tpath; ?>/js/respond.js"></script>
  	<![endif]-->
    <?php
        if ($this->params->get('googleanalytics') && $this->params->get('googleanalyticscode')!='') :
    ?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', '<?php echo $this->params->get('googleanalyticscode');?>', 'auto');
        ga('set', 'anonymizeIp', true);
        ga('send', 'pageview');
    </script>
    <?php
        endif;
    ?>
</head>

	<?php require_once __DIR__ . '/index_' . $pagetype . '.php'; ?>

	<jdoc:include type="modules" name="debug" />

	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				// dropdown
				$('nav .menunav > .deeper').addClass('dropdown');
				$('nav .menunav > .deeper > a').addClass('dropdown-toggle');
				//$('nav .menunav > .deeper > a').addClass('dropdown-toggle disabled');
				$('nav .menunav > .deeper > a').attr('data-toggle', 'dropdown');
				//$('nav .menunav > .deeper > a').attr('href', '#');
				$('nav .menunav > .deeper > ul').addClass('dropdown-menu');
			});
		})(jQuery);
	</script>

	<?php if ($this->params->get('holder')==1) : ?>
		<script src="<?php echo $tpath.'/js/holder.js';?>"></script>
	<?php endif; ?>
	</body>
</html>
