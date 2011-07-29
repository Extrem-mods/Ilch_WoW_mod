<?php
function getRaceByID($raceID){
  $ID = array(
  1   =>  'Mensch',
  2   =>  'Ork',
  3   =>  'Zwerg',
  4   =>  'Nachtelf',
  5   =>  'Untoter',
  6   =>  'Tauren',
  7   =>  'Gnom',
  8   =>  'Troll',
  10  => 	'Blutelf',
  11 	=>  'Draenei'
  );
  return $ID[$classID]; 
} 

function getClassByID($classID){		
	$ID = array(
	1 => 'Krieger',
	2 => 'Paladin',
	3 => 'Jäger',
	4 => 'Schurke',
	5 => 'Priester',
	6 => 'Todesritter',
	7 => 'Shamane',
	8 => 'Magier',
	9 => 'Hexenmeister',
	11 =>'Druide'
	);
	return $ID[$classID];
}

function getClassColor($classID){		
	$ID = array(
	1 => '#C79C6E',	// Warrior
	2 => '#F58CBA',	// Paladin
	3 => '#ABD473',	// Hunter
	4 => '#FFF569',	// Rogue
	5 => '#FFFFFF',	// Priest
	6 => '#C41F3B',	// DK
	7 => '#0070DE',	// Shaman
	8 => '#69CCF0',	// Mage
	9 => '#9482C9',	// Warlock
	11 => '#FF7D0A'	// Druid
	);
	return $ID[$classID];
}
