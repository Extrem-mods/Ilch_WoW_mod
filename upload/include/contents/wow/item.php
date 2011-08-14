<?php
defined ('main') or die ( 'no direct access' );
if(is_numeric($menu->get(2))){
$iid = $menu->get(2);
}
else{
$iid = mt_rand();
}
$title = $allgAr['title'].' :: WOW Mod :: Item ('.$iid.')';
$hmenu  = 'Itemliste';
$design = new design ( $title , $hmenu, 1);
$design->header();
$item = new Item($iid);
$design->footer();