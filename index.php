<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.kicktemp
 *
 * @author      Niels Nübel <info@niels-nuebel.de>
 * @copyright   Copyright (c) 2013-2016 niels-nuebel.de
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

$app                = JFactory::getApplication();
$doc                = JFactory::getDocument();
$user               = JFactory::getUser();
$this->language     = $doc->language;
$this->direction    = $doc->direction;

// Getting params from template
$params             = $app->getTemplate(true)->params;

// Template Params
$tpath              = $this->baseurl . '/templates/' . $this->template;
$layout             = $params->get('layout', 'default.php');
$pageclass          = $app->getParams()->get('pageclass_sfx');
$googlefont         = $params->get('googlefont');
$hidecontentwrapper = $params->get('hidecontentwrapper', 0);
$showsystemoutput   = $params->get('showsystemoutput', 1);
$cssfilename        = $params->get('cssfilename', 'kicktemp.min.css');
$jsfilename         = $params->get('jsfilename', 'kicktemp.min.js');

// Generator tag
$this->setGenerator(null);

if ($googlefont != '')
{
	$doc->addStyleSheet("https://fonts.googleapis.com/css?family=" . $googlefont);
}

// Add CSS and Javascript
$doc->addStyleSheet($tpath . '/css/' . $cssfilename);
$doc->addScript($tpath . '/js/' . $jsfilename);
$doc->setMetaData('viewport', 'width=device-width, minimum-scale=1.0,maximum-scale=1.0');

if ($this->countModules('sidebar-a') && $this->countModules('sidebar-b'))
{
	// Both Sidebar are active
	$contentclass   = $params->get('content-3-col', 'main col-md-6 col-md-push-3');
	$sidebar_a      = $params->get('sidebar-a-3-col', 'col-md-3 col-md-pull-6');
	$sidebar_b      = $params->get('sidebar-b-3-col', 'col-md-3');
}
elseif ($this->countModules('sidebar-a'))
{
	// Sidebar A is active
	$contentclass   = $params->get('content-2-col-a', 'main col-md-8 col-lg-offset-1 col-md-push-4 col-lg-push-3');
	$sidebar_a      = $params->get('sidebar-a', 'col-md-4 col-lg-3 col-md-pull-8 col-lg-pull-9');
}
elseif ($this->countModules('sidebar-b'))
{
	// Sidebar B is active
	$contentclass   = $params->get('content-2-col-b', 'main col-md-8');
	$sidebar_b      = $params->get('sidebar-b', 'col-md-4 col-lg-3 col-lg-offset-1');
}
else
{
	// No Sidebar is active
	$contentclass   = $params->get('content-1-col', 'main col-md-12');
}

?>
<!DOCTYPE html>
<html <?php echo 'lang="' . $this->language . '" dir="' . $this->direction; ?>">
<head>
	<jdoc:include type="head" />
	<!--[if lte IE 9]>
	<script src="<?php echo $tpath; ?>/js/html5shiv.min.js"></script>
	<script src="<?php echo $tpath; ?>/js/respond.min.js"></script>
	<![endif]-->
	<?php
	if ($params->get('googleanalytics') && $params->get('googleanalyticscode') != '')
	{
	?>
		<script>
			(function (i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] || function () {
						(i[r].q = i[r].q || []).push(arguments)
					}, i[r].l = 1 * new Date();
				a = s.createElement(o),
					m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
			ga('create', '<?php echo $this->params->get('googleanalyticscode');?>', 'auto');
			ga('set', 'anonymizeIp', true);
			<?php
			if ($params->get('googlelinkid'))
			{
				echo "ga('require', 'linkid', 'linkid.js');";
			}
			?>
			<?php
			if ($params->get('googledisplayfeatures'))
			{
				echo "ga('require', 'displayfeatures');";
			}
			?>
			ga('send', 'pageview');
		</script>
	<?php
	};
	?>
	<?php
	if ($params->get('googletagmanager') && $params->get('googletagmanagercode') != '')
	{
		echo $this->params->get('googletagmanagercode');
	}
	?>
</head>
<body class="<?php echo $pageclass . ' ' . $this->language; ?>">
<?php require_once __DIR__ . '/tpls/' . $layout; ?>
<jdoc:include type="modules" name="debug" />
</body>
</html>