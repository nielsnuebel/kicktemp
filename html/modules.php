<?php  
/*------------------------------------------------------------------------
# author    your name or company
# copyright Copyright (C) 2011 example.com. All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.example.com
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

function modChrome_slider($module, &$params, &$attribs) {
	echo JHtml::_('sliders.panel',JText::_($module->title),'module'.$module->id);
	echo $module->content;
}

function modChrome_mystyle($module, &$params, &$attribs) { ?>
	<div class="moduletable <?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
		<div class="bghelper">
			<h3><?php echo JText::_( $module->title ); ?></h3>
			<div class="modulcontent"><?php echo $module->content; ?></div>
		</div>
	</div><?php
}
function modChrome_kickstartmodul($module, &$params, &$attribs){

	$moduleTag      = $params->get('module_tag', 'div');
	$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'));
	$count			= $attribs['modules'];
	$i 				= $attribs['count'];
	if(!$attribs['bootstrap']){
		$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
	}
	else {
        if($params->get('bootstrap_size') !=0){
            $bootstrapSize  = (int) $params->get('bootstrap_size', 0);
        }
        else
		$bootstrapSize = $attribs['bootstrap']/$count;
		if($bootstrapSize<2) $bootstrapSize=2;
	}

	$moduleClass    = $bootstrapSize != 0 ? ' col-md-' . $bootstrapSize : '';

	switch($i) {
		case '0': $moduleClass .= ' first';
			break;
		case ($i == $count-1):  $moduleClass .= '  last';
			break;
	}
	$moduleClass .= ' box'.$i;

	if (!empty ($module->content)) : ?>
		<<?php echo $moduleTag; ?> class="moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?><?php echo $moduleClass; ?>">

		<?php if ((bool) $module->showtitle) :?>
			<<?php echo $headerTag; ?> class="<?php echo $params->get('header_class'); ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
		<?php endif; ?>

		<?php echo $module->content; ?>

		</<?php echo $moduleTag; ?>>

	<?php endif;

}
?>