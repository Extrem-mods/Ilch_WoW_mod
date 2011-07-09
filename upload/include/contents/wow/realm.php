<?php
defined ('main') or die ( 'no direct access' );
if($menu->get(2) == NULL){
$title = $allgAr['title'].' :: WOW Mod :: Realmlist';
$hmenu  = ''
$design = new design ( $title , $hmenu, 1);
$design->header();

$tpl = new tpl ('wow/realmlist');
$tpl->set_out(0);
$realms = new Realmlist();
$realms->getDatas();
$slugs = $realms->getSlugs();
foreach($slugs as $slug){
  $realm = $realms->getRealm($slug);
  $out = $realm->getAsArray()
  $out['status'] = (($out['status'])?'<span class="true">Online</span>':'<span class="false">Offline</span>')
  $out['queue'] = (($out['queue'])?'<span class="true">Online</span>':'<span class="false">Offline</span>')
    
  $tpl->set_ar_out($out,1);
}
$tpl->set_out(2);
}else{
$slug= $menu->get(2)
$realm = new Realm($slug);
 
}

$design->footer();