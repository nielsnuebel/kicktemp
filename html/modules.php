<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.beez3
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

function modChrome_kicktemp ($module, &$params, &$attribs)
{
	$params = changeparams($module);

	$moduleTag      = $params->get('module_tag', 'div');
	$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'));

	// Temporarily store header class in variable
	$headerClass	= $params->get('header_class');
	$headerClass	= !empty($headerClass) ? ' class="' . htmlspecialchars($headerClass) . '"' : '';

	if (!empty ($module->content)) : ?>
		<<?php echo $moduleTag; ?> class="moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx')) . htmlspecialchars($params->get('kicktemp_sfx')); ?>">
		<?php if ((bool) $module->showtitle) :?>
			<<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>>
		<?php endif; ?>
		<?php echo $module->content; ?>
		</<?php echo $moduleTag; ?>>
		<?php if($params->get('clearfix'))  echo '<div class="clearfix"></div>'; ?>
	<?php endif;
	
}

function modChrome_kicktemponepage ($module, &$params, &$attribs)
{
	$params = changeparams($module);

	$moduleTag      = $params->get('module_tag', 'section');
	$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'));

	// Temporarily store header class in variable
	$headerClass	= $params->get('header_class');
	$headerClass	= !empty($headerClass) ? ' class="' . htmlspecialchars($headerClass) . '"' : '';

	if (!empty ($module->content)) : ?>
		<<?php echo $moduleTag; ?> <?php echo ($params->get('onepage_id') != null)?' id="'.$params->get('onepage_id').'"':''; ?> <?php echo ($params->get('onepage_class') != null)?' class="'.$params->get('onepage_class').'"':''; ?>>
		<?php
		if($params->get('onepage_container')) echo '<div class="container">';
		if($params->get('onepage_row')) echo '<div class="row">';
		?>
	<div class="moduletable <?php echo htmlspecialchars($params->get('moduleclass_sfx')); if(!$params->get('onepage_noclass')) echo  htmlspecialchars($params->get('kicktemp_sfx')); ?>">
		<?php if ((bool) $module->showtitle) :?>
			<<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>>
		<?php endif; ?>
		<?php echo $module->content;
		if($params->get('onepage_row')) echo "</div>";
		if($params->get('onepage_container')) echo "</div>";
		?>
		</div>
		</<?php echo $moduleTag; ?>>
	<?php endif;
}

function changeparams($module) {
	
	$params = new JRegistry;
	$params->loadString($module->params);

	$kicktemp_sfx = '';

	//Standard col-xs-12 when nothing is set
	if(!$params->get('extra_small_devices_grid') and !$params->get('small_devices_grid') and !$params->get('medium_devices_grid') and !$params->get('large_devices_grid')){
		if($params->get('bootstrap_size'))
			$kicktemp_sfx .=' col-xs-'.$params->get('bootstrap_size');
		else
			$kicktemp_sfx .=' col-xs-12';
	}

	//Bootstrap Grid
	if($params->get('extra_small_devices_grid'))
		$kicktemp_sfx .=' col-xs-'.$params->get('extra_small_devices_grid');

	if($params->get('small_devices_grid'))
		$kicktemp_sfx .=' col-sm-'.$params->get('small_devices_grid');

	if($params->get('medium_devices_grid'))
		$kicktemp_sfx .=' col-md-'.$params->get('medium_devices_grid');

	if($params->get('large_devices_grid'))
		$kicktemp_sfx .=' col-lg-'.$params->get('large_devices_grid');

	//Bootstrap Offset
	if($params->get('extra_small_devices_offset'))
		$kicktemp_sfx .=' col-xs-offset-'.$params->get('extra_small_devices_offset');

	if($params->get('small_devices_offset'))
		$kicktemp_sfx .=' col-sm-offset-'.$params->get('small_devices_offset');

	if($params->get('medium_devices_offset'))
		$kicktemp_sfx .=' col-md-offset-'.$params->get('medium_devices_offset');

	if($params->get('large_devices_offset'))
		$kicktemp_sfx .=' col-lg-offset-'.$params->get('large_devices_offset');

	//visible and hidden
	if($params->get('extra_small_devices_available') == 1)
		$kicktemp_sfx .=' hidden-xs';

	if($params->get('extra_small_devices_available') == 2)
		$kicktemp_sfx .=' visible-xs';

	if($params->get('small_devices_available') == 1)
		$kicktemp_sfx .=' hidden-sm';

	if($params->get('small_devices_available') == 2)
		$kicktemp_sfx .=' visible-sm';

	if($params->get('medium_devices_available') == 1)
		$kicktemp_sfx .=' hidden-md';

	if($params->get('medium_devices_available') == 2)
		$kicktemp_sfx .=' visible-md';

	if($params->get('large_devices_available') == 1)
		$kicktemp_sfx .=' hidden-lg';

	if($params->get('large_devices_available') == 2)
		$kicktemp_sfx .=' visible-lg';

	//Print
	if($params->get('bootstrap_print') == 1)
		$kicktemp_sfx .=' hidden-print';

	if($params->get('bootstrap_print') == 2)
		$kicktemp_sfx .=' visible-print';

	$params->set('kicktemp_sfx',$kicktemp_sfx);

	//set new Parameter
	$module->params = $params;
	return $params;
}