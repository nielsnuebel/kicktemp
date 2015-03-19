<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$document = JFactory::getDocument();
$renderer = $document->loadRenderer('module');
$chromestyle = $item->params->get('modstyle', 'none');
$modulid = $item->params->get('module_id', 0);

if($modulid)
{
	$db = JFactory::getDbo();
	$query = $db->getQuery(true)
		->select('m.*')
		->from('#__modules AS m')
		->where('m.published = 1')
		->where('m.id = ' . $modulid);

	$db->setQuery($query);
	$modul = $db->loadObject();
}

echo $renderer->render($modul, array('style' => $chromestyle));
