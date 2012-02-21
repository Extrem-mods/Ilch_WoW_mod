<?php
defined ('main') or die ( 'no direct access' );

switch($menu->get(2)){
case 'new':
	global $allgAr;
	if(!has_right($allgAr['wow_new_char'])){
			wd ('?wow-chars', 'Sie haben nicht die benötigten Rechte, einen neuen Char anzulegen.', 5); 
			exit();
	}
	$title = $allgAr['title'].' :: WOW Mod :: New Chars';
	$hmenu  = 'Charaktere >> neu';
	$design = new design ( $title , $hmenu);
	$design->addheader('<link rel="stylesheet" type="text/css" href="include/includes/css/char.css">');
	$design->header();
	$tpl = new tpl ('wow/new_char');
	if(empty($_POST['new_char_realm']) || empty($_POST['new_char_name'])){
		$tpl->set_ar_out(
		 array(
		  'msg' => '',
		  'REALM'=>(empty($_POST['new_char_realm'])?'':$_POST['new_char_realm']),
		  'NAME'=>(empty($_POST['new_char_name'])?'':$_POST['new_char_name'])
		 ), 0);
	}else{
		try{
			$char = Char::newChar(escape($_POST['new_char_realm'], 'string'), escape($_POST['new_char_name'], 'string'), $_SESSION['authid']);
		}catch(Exception $e){
			$tpl->set_ar_out(
			 array(
			  'msg'=>escape($e->getMessage(), 'string'),
			  'REALM'=>$_POST['new_char_realm'],
			  'NAME'=>$_POST['new_char_name']
			 ), 0);
			 $design->footer();
			 exit();
		}
		wd ('?wow-chars-'.$char->getCID(), 'Der Char "'.$char->getName().'" vom Realm "'.$char->getRealm().'" wurde erfolgreich angelegt',  5); 
		exit();		
	}
break;
case 'del':
	if(!is_numeric($menu->get(3))){
		wd ('?wow-chars', 'Kein char zum löchen Ausgewählt', 5); 
		exit();
	}
	try{
		$char = New Char($menu->get(3));
	}catch(Exception $e){
		wd ('?wow-chars',$e->getMessage(),  5); 
		exit();		
	}
	if(!($_SESSION['authid'] == $char->getAcc() || has_right($allgAr['wow_del_char']))){
		wd ('?wow-chars', 'Sie haben keine Berechtigung, diesen Char zu löschen', 5); 
		$design->footer();
		exit();
	}
	$id = $char->getCID();
	unset($char);
	if(db_query("DELETE FROM `prefix_chars` WHERE `cID` = {$id}")){
		wd ('?wow-chars', 'Der Ausgewählte Char wurde erfolgreich aus der Tabelle entfernt', 5);  // !!Achtung!! Funktioniert nur bei InnoDB-TAbellen mit Fremdschlüsseln (Install Script aus dem Extras Ordner) sicher, bei der Standartinstalation bleiben Daten in der Tabelle zurück, Wird in späteren Versionen Eventuell noch abgeändert.
		$design->footer();
		exit();
	}else{
		wd ('?wow-chars', 'Beim Löschen der Daten ist ein Fehler aufgetreten', 5);
		exit();
	}
break;
case 'show':
$char = new Char(intval($menu->get(3)), NULL, WITH_STATS);
	$out = $char->getAsArray();

	foreach($out as $k=>$v){
		if(is_array($v)){
			foreach($v as $k2=>$v2){
				$out[$k.'.'.$k2] = $v2;
			}
			unset($out[$k]);
		}
	}
	
	$title = $allgAr['title'].' :: WOW Mod :: '. $out['name'];
	$realm = new Realm($out[realm]);
	$hmenu  = '<a href="?wow-realm">Realmliste</a> &raquo; <a href="?wow-realm-'.$realm->getSlug().'">'.$realm->getName().'</a> &raquo; '. $out['name'];
	$design = new design ( $title , $hmenu);
	$design->addheader('<script type="text/javascript" src="include/includes/js/jquery.js"></script>');
	$design->addheader('<script type="text/javascript" src="include/includes/js/jquery.tablesorter.js"></script>');
	$design->addheader('<link rel="stylesheet" type="text/css" href="include/includes/css/char.css">');
	$design->header();
	$tpl = new tpl ('wow/char');
	
	$out['class_n'] = getClassByID($out['class']);
    $out['race_n'] = getRaceByID($out['race']);	
	
	if($out['stats.offHandDmgMax']>0){
		$out['dmg'] = ($out['stats.mainHandDmgMin'] + $out['stats.offHandDmgMin']). ' - '. ($out['stats.mainHandDmgMax'] + $out['stats.offHandDmgMax']);
		$out['dps'] = round($out["stats.mainHandDps"],1).'/'.round($out["stats.offHandDps"],1);
		$out['hitSpeed'] = round($out["stats.mainHandSpeed"],2).'/'.round($out["stats.offHandSpeed"],2);
		$out['expertise'] = $out["stats.mainHandExpertise"].'/'.$out["stats.offHandExpertise"];
		
	}else{
		$out['dmg'] = $out['stats.mainHandDmgMin']. ' - '.$out['stats.mainHandDmgMax'];
		$out['dps'] = round($out["stats.mainHandDps"],1);
		$out['hitSpeed'] = round($out["stats.mainHandSpeed"],2);
		$out['expertise'] = $out["stats.mainHandExpertise"];
	}
	if($out['stats.rangedDmgMin'] >0){
	$out['rdmg'] = $out['stats.rangedDmgMin'].'-'.$out['stats.rangedDmgMax'];
	$out['rdps'] = round($out['stats.rangedDps'],1);
	$out['stats.rangedSpeed']= round($out['stats.rangedSpeed'],2);
	
	}else{
	$out['rdmg'] = '--';
	$out['rdps'] = '--';
	$out['stats.rangedSpeed'] = '--';
	}
	
	var_dump($out);	
	$tpl->set_ar_out($out,0);  
break;
default:
// Charliste erstellen
	$title = $allgAr['title'].' :: WOW Mod :: Chars';
	$hmenu  = 'Charaktere';
	$design = new design ( $title , $hmenu);
	$design->addheader('<link rel="stylesheet" type="text/css" href="include/includes/css/char.css">');
	$design->header();
	$tpl = new tpl ('wow/charlist');
	$classes = getClassIds();
	$tpl->out(0);
	foreach($classes as $k=> $v){
		$tpl->set_ar_out(array('k_id' => $k, 'k_name' => $v), 1);
	}
	$tpl->out(2);
	if(is_numeric($menu->get(2)) && isset($classes[$menu->get(2)])){
		$k = $menu->get(2);
		$v = $classes[$menu->get(2)];
		$tpl->set_ar_out(array('klassid' => $k, 'klassname' => $v), 3);
		$chars = db_query('SELECT `cID`, `name`, `level`, `class`, `race`, `acc_id` FROM `ic1_chars` WHERE `class` ='. $k);
		while($row = mysql_fetch_array($chars)){
			$row['r_name'] = getRaceByID($row['race']);
			$tpl->set_ar_out($row, 4);
		}
		$tpl->out(5);
	}
	else{
		foreach($classes as $k=> $v){
			$tpl->set_ar_out(array('klassid' => $k, 'klassname' => $v), 3);
			$chars = db_query('SELECT `cID`, `name`, `level`, `class`, `race`, `acc_id` FROM `ic1_chars` WHERE `class` ='. $k);
			while($row = mysql_fetch_array($chars)){
				$row['r_name'] = getRaceByID($row['race']);
				$tpl->set_ar_out($row, 4);
			}
			$tpl->out(5);
		}
	}
	$tpl->out(6);
}
	$design->footer();
	