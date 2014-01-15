<?php
function kickstartmodul($modul,$style,$bootstrap="12"){
	$document = JFactory::getDocument();
	$modules = JModuleHelper::getModules($modul);
	$renderer = $document->loadRenderer('module');
	$count = count($modules);
	$show = false;
	$return = "";
	$i = 0;
	foreach($modules as $mod) {
		$return .= $renderer->render($mod,array(
			'style' => $style,
			'modules' => $count,
			'count' => $i,
			'bootstrap' => $bootstrap
		));
		$i++;
	}
	return (!empty ($return))?$return:$show;
}