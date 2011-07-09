<?php
defined ('main') or die ( 'no direct access' );
if($menu->get(2) == NULL){
$title = $allgAr['title'].' :: WOW Mod :: Realmlist';
$hmenu  = ''
$design = new design ( $title , $hmenu, 1);
$design->header();

$tpl = new tpl ('wow/realmlist');

$realms = new Realmlist();
$realms->getDatas();
$slugs = $realms->getSlugs();
foreach($slugs as $slug){
  $realm = $realms->getRealm($slug);
  
  $tpl->set_ar_out($realm->getAsArray(),1);
}


}else{
$slug= $menu->get(2) 
}

$design->footer();