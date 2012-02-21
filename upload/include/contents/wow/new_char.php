<?php
defined ('main') or die ( 'no direct access' );
$title = $allgAr['title'].' :: WOW Mod :: Realmlist';
$hmenu  = 'Char Eintragen';
$design = new design ( $title , $hmenu, 1);
$design->header();
$tpl = new tpl ('wow/new_char');
if(!isset($_POST['new_char'])){
$realms = new Realmlist();
$realms = $realms->getAsArray();
$tmp= '<select name="realm">';
foreach($realms as $k => $v){
$tmp .="<option value=\"{$k}\">{$v['name']}</option>"
}
$tmp .='</select'>;
$out = array('realms'=>$tmp);
$tpl->set_ar_out($out,0);
}else{
$msg ='';
try{
$char = new Char($_POST['char'], $_POST['realm']);
}catch(Exception $e){
$msg ='Konnte den Char nicht anlegen('.$e->getMessage().')';
}
if(empty($msg){
$char->saveDatas();
$msg= 'Char erfolgreich angelegt.';
}
$tpl->set_ar_out(array('msg'=>$msg),1);
}
$design->footer();