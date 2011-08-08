<?php 
#   Copyright by Manuel
#   Support www.ilch.de

defined ('main') or die ( 'no direct access' );

# load all needed classes
require_once('include/includes/class/tpl.php');
require_once('include/includes/class/design.php');
require_once('include/includes/class/menu.php');
require_once('include/includes/class/curl.php');
require_once('include/includes/class/api.php');
require_once('include/includes/class/realmlist.php');
require_once('include/includes/class/realm.php');
require_once('include/includes/class/char.php');
require_once('include/includes/class/item.php');
require_once('include/includes/class/item_tool.php');
require_once('include/includes/class/char_items.php');





# fremde classes laden
require_once('include/includes/class/xajax.inc.php');

# load all needed func
require_once('include/includes/func/db/mysql.php');

require_once('include/includes/func/calender.php');
require_once('include/includes/func/user.php');
require_once('include/includes/func/escape.php');
require_once('include/includes/func/allg.php');
require_once('include/includes/func/debug.php');
require_once('include/includes/func/bbcode.php');
require_once('include/includes/func/profilefields.php');
require_once('include/includes/func/statistic.php');
require_once('include/includes/func/listen.php');
require_once('include/includes/func/forum.php');
require_once('include/includes/func/warsys.php'); 
require_once('include/includes/func/ic_mime_type.php');
require_once('include/includes/func/wow_char_mod.php');


# load something else
require_once ('include/includes/lang/de.php');
?>
