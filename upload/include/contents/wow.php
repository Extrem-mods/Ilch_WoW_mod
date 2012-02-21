<?php 

defined ('main') or die ( 'no direct access' );

switch($menu->get(1)) {
	         case 'chars':   $wowDatei = 'char';  break;
	         case 'item':   $wowDatei = 'item';  break;
	default: case 'realm':  $wowDatei = 'realm'; break;
}
 
require_once('include/contents/wow/'.$wowDatei.'.php');
