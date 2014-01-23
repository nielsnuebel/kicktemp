<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
// Note. It is important to remove spaces between elements.
$last_level_one_id = 0;
foreach ($list as $menu) {
    if ($menu->level == 1) {
        $last_level_one_id = $menu->id;
        break;
    }
}
$first_start = true;
$tag = null;
$ulid = null;
if ($params->get('tag_id') != null) {
    $tag = $params->get('tag_id');
    $ulid = 'id="'.$tag.'"';
}
echo '<ul class="nav menu'.$class_sfx.'" '.$ulid.'>'."\n";
    foreach ($list as $i => &$item) :
        //Codestyle
        $spacer = '    ';
        for($i=1;$i < $item->level;$i++){
            $spacer .= '    ';
        }
        if($item->level >1)$spacer .='    ';

        $class = 'item-' . $item->id . ' li' . $i;
        if ($item->id == $active_id) {
            $class .= ' current';
        }

        if (in_array($item->id, $path)) {
            $class .= ' active';
        } elseif ($item->type == 'alias') {
            $aliasToId = $item->params->get('aliasoptions');
            if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
                $class .= ' active';
            } elseif (in_array($aliasToId, $path)) {
                $class .= ' alias-parent-active';
            }
        }

        if ($item->type == 'separator') {
            $class .= ' divider';
        }

        ///start first last changes
        if ($first_start) {
            $class .= ' first';
            $first_start = false;
        }
        if ($item->shallower || $item == end($list) || $item->id == $last_level_one_id) {
            $class .= ' last';
        }

        if ($item->deeper) {
            $class .= ' deeper';
            $first_start = true;

        }

        if ($item->parent) {
            $class .= ' parent';
        }

        if (!empty($class)) {
            $class = ' class="' . trim($class) . '"';
        }

        echo $spacer.'<li' . $class. '>';
        // Render the menu item.
        switch ($item->type) :
            case 'separator':
            case 'url':
            case 'component':
            case 'heading':
                require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
                break;

            default:
                require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
                break;
        endswitch;

        // The next item is deeper.
        if ($item->deeper) {
            echo "\n".$spacer.'    <ul class="nav-child unstyled level' . $item->level . ' small">'."\n";
        } // The next item is shallower.
        elseif ($item->shallower) {
            echo '</li>'."\n";
            echo str_repeat(substr($spacer,0,-4).'</ul><!-- ul.level'.($item->level-1).' -->'."\n".substr($spacer,0,-8).'</li><!-- li.deeper -->'."\n", $item->level_diff);
        } // The next item is on the same level.
        else {
            echo '</li>'."\n";
        }
    endforeach;
    ?>
</ul><!-- end .nav.menu -->
