<?php
defined ('main') or die ( 'no direct access' );

switch($menu->get(2)){
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
	$design->footer();
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
		$chars = db_query('SELECT `cID`, `name`, `level`, `class`, `race`, `account` FROM `ic1_chars` WHERE `class` ='. $k);
		while($row = mysql_fetch_array($chars)){
			$row['r_name'] = getRaceByID($row['race']);
			$tpl->set_ar_out($row, 4);
		}
		$tpl->out(5);
	}
	else{
		foreach($classes as $k=> $v){
			$tpl->set_ar_out(array('klassid' => $k, 'klassname' => $v), 3);
			$chars = db_query('SELECT `cID`, `name`, `level`, `class`, `race`, `account` FROM `ic1_chars` WHERE `class` ='. $k);
			while($row = mysql_fetch_array($chars)){
				$row['r_name'] = getRaceByID($row['race']);
				$tpl->set_ar_out($row, 4);
			}
			$tpl->out(5);
		}
	}
	$tpl->out(6);
	$design->footer();  
}
