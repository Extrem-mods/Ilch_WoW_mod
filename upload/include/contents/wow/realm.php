<?php
defined ('main') or die ( 'no direct access' );
if($menu->get(2) == NULL){
$title = $allgAr['title'].' :: WOW Mod :: Realmlist';
$hmenu  = '';
$design = new design ( $title , $hmenu, 1);
$design->header();

$tpl = new tpl ('wow/realmlist');
$tpl->out(0);
$realms = new Realmlist();
$realms->getDatas();
$slugs = $realms->getSlugs();
foreach($slugs as $slug){
  $realm = $realms->getRealm($slug);
  $out = $realm->getAsArray();
  $out['status'] = (($out['status'])?'<span class="true">Online</span>':'<span class="false">Offline</span>');
  $out['queue'] = (($out['queue'])?'<span class="true">Online</span>':'<span class="false">Offline</span>');
    
  $tpl->set_ar_out($out,1);
}
$tpl->set_out(2);
}else{
$slug= $menu->get(2);
$realm = new Realm($slug);

$title = $allgAr['title'].' :: WOW Mod :: Details zu ' . htmlentities($realm->getName());
$hmenu  = '';
$design = new design ( $title , $hmenu, 1);
$design->header();

$tpl = new tpl ('wow/realm_details');
  $out = $realm->getAsArray();
  $out['status'] = (($out['status'])?'<span class="true">Online</span>':'<span class="false">Offline</span>');
  $out['queue'] = (($out['queue'])?'<span class="true">Online</span>':'<span class="false">Offline</span>');
  $tpl->set_ar_out($out,0);
  $tpl->set_out(1);
  //
  $chars = db_query("SELECT `cID` FROM `prefix_chars` WHERE `realm` LIKE '{$slug}')");
  if($char = mysql_fetch_assoc($chars)){
    $char = new Char($char);
    $out = $char->getAsArray();
    $tpl->set_ar_out($out,2);
  }
  $tpl->set_out(3);
 
}

$design->footer();