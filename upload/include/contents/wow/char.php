<?php
defined ('main') or die ( 'no direct access' );
$charList = true;
$title = $allgAr['title'].' :: WOW Mod :: Chars';
$hmenu  = '<a href="?wow-realm">Realmliste</a> &raquo;  Chars';
$design = new design ( $title , $hmenu);
$design->addheader('<script type="text/javascript" src="include/includes/js/jquery.js"></script>');
$design->addheader('<script type="text/javascript" src="include/includes/js/jquery.tablesorter.js"></script>');

if($menu->get(2) != NULL){    //ein char ausgewählt
  $tpl = new tpl ('wow/char');
  if(is_numeric($menu->get(2))){ //cID gegegben
    echo 'erstelle Char KLasse mit CID = '.$menu->get(2);   
    $char = new Char($menu->get(2), NULL, WITH_ITEMS);
    echo $char->getLastError(); 
  }elseif($menu->get(3) != NULL){   //realm/name gegeben
    $char = new Char($menu->get(3), $menu->get(2), WITH_ITEMS);
    echo $char->getLastError();
  }
}
if($charList){
  $tpl = new tpl ('wow/charlist');
  $result = db_query('SELECT `cID` from `prefix_chars` WHERE `show` = 1');
  $tpl->out(0);
  while($row = mysql_fetch_array($result)){
    $tpl->set_ar_out($row, 1);
  }

$tpl->out(2);  
}

$design->footer();
