<?php
defined ('main') or die ( 'no direct access' );
if($menu->get(2) == NULL){
$title = $allgAr['title'].' :: WOW Mod :: Realmlist';
$hmenu  = 'Realmliste';
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
  $out['queue'] = (($out['queue'])?'<span class="true">Vorhanden</span>':'<span class="false">Leer</span>');
  $out['slug'] = urlencode($out['slug']);
    
  $tpl->set_ar_out($out,1);
}
$tpl->out(2);
}else{
$i = 2;
$slug = '';
while($menu->get($i) != NULL){
$slug .= $menu->get($i).'-';
$i++;
}
$slug = urldecode(mb_substr($slug,0,-1, 'UTF-8')); 
$realm = new Realm($slug);
if($realm->getLastError() == ''){
$title = $allgAr['title'].' :: WOW Mod :: Details zu ' . $realm->getName();
$hmenu  = '<a href="?wow-realm">Realmliste</a> &raquo; ' . $realm->getName();
$design = new design ( $title , $hmenu, 1);
$design->header();

$tpl = new tpl ('wow/realm_details');
  $out = $realm->getAsArray();
  $out['status'] = (($out['status'])?'<span class="true">Online</span>':'<span class="false">Offline</span>');
  $out['queue'] = (($out['queue'])?'<span class="true">Vorhanden</span>':'<span class="false">Leer</span>');
  $tpl->set_ar_out($out,0);

  $chars = db_query("SELECT `cID` FROM `prefix_chars` WHERE `realm` LIKE '{$slug}'");
  $tpl->set_out('anz',mysql_num_rows ($chars),1);
  if(mysql_num_rows ($chars) > 0){
  $tpl->out(2);
  while($char = mysql_fetch_assoc($chars)){ 
    $char = new Char($char['cID']);
    if($char->getLastError()== ''){
    $out = $char->getAsArray();
    $out['color'] =getClassColor($out['class']);     
    $out['class'] = getClassByID($out['class']);
    $out['race'] = getRaceByID($out['race']);
    $out['gender'] = ($out['gender'] == 1?'Weiblich':'Männlich');
    $tpl->set_ar_out($out,3);
    }else{
    echo '<tr><td colspan="6">'.$char->getLastError().'</td></tr>';
    }
    unset($char);
  }
  $tpl->out(4);
  }
}else{
$title = $allgAr['title'].' :: WOW Mod :: Kein Realm gefunden';
$hmenu  = '<a href="?wow-realm">Realmliste</a> &raquo; Fehler ';
$design = new design ( $title , $hmenu, 1);
$design->header();
echo 'Kein Realm mit dem Slug \''.$realm->getSlug().'\' gefunden.';
}
}

$design->footer();