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

// Set KICKTEMP Variables
$menu               = $app->getMenu();
$active             = $app->getMenu()->getActive();
$pageclass          = $app->getParams()->get('pageclass_sfx');
$tpath              = $this->baseurl.'/templates/'.$this->template;
$googlefont         = $params->get('googlefont');
$pagetype           = $params->get('pagetype', 'multipage');
$hidecontentwrapper = $params->get('hidecontentwrapper', 0);
$showsystemoutput   = $params->get('showsystemoutput', 1);
$filename           = $params->get('filename', 'kicktemp');

$isFrontpage        = false;
$active_alias       = '';

if ($active)
{
    $defaultmenuitems = array($menu->getDefault()->id, $menu->getDefault(JFactory::getLanguage()->getTag())->id);
    $isFrontpage = in_array($active->id, $defaultmenuitems);
    $active_alias = $active->alias;
}
// generator tag
$this->setGenerator(null);

if ($googlefont !='') $doc->addStyleSheet("https://fonts.googleapis.com/css?family=".$googlefont);
//Add CSS and Javascript
$doc->addStyleSheet($tpath . '/css/' . $filename . '.css');
$doc->addScript($tpath.'/js/' . $filename . '.js');

$contentclass = $params->get('content-1-col','col-md-12');
if ($this->countModules('sidebar-a') or  $this->countModules('sidebar-b')) $contentclass = $params->get('content-2-col','col-md-8');
if ($this->countModules('sidebar-a') and $this->countModules('sidebar-b')) $contentclass = $params->get('content-3-col','col-md-4');
$sidebar_a = $params->get('sidebar-a','col-md-4');
$sidebar_b = $params->get('sidebar-b','col-md-4');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta name="x-ua-compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<jdoc:include type="head" />
<link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/images/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/images/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/images/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $tpath; ?>/images/apple-touch-icon-144x144-precomposed.png">
<!--[if lte IE 9]>
<script src="<?php echo $tpath; ?>/js/html5shiv.min.js"></script>
<script src="<?php echo $tpath; ?>/js/respond.min.js"></script>
<![endif]-->
<?php
if ($params->get('googleanalytics') && $params->get('googleanalyticscode')!='') :
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', '<?php echo $this->params->get('googleanalyticscode');?>', 'auto');
  ga('set', 'anonymizeIp', true);
  <?php if ($params->get('googlelinkid')) echo "ga('require', 'linkid', 'linkid.js');\n" ?>
  <?php if ($params->get('googledisplayfeatures')) echo "ga('require', 'displayfeatures');\n" ?>
  ga('send', 'pageview');
</script>
<?php
endif;
?>
</head>
<?php require_once __DIR__ . '/index_' . $pagetype . '.php'; ?>
<jdoc:include type="modules" name="debug" />
</html>
