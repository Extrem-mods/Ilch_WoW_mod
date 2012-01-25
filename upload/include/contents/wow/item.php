<?php
defined ('main') or die ( 'no direct access' );
if(is_numeric($menu->get(2))){
$iid = $menu->get(2);
}
else{
$iid = 77188;
}
$title = $allgAr['title'].' :: WOW Mod :: Test der Item Klasse ';
$hmenu  = 'Itemliste';
$design = new design ( $title , $hmenu, 1);
$design->header();
$item = new Item($iid);
$design->footer();