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
  return $ID[$raceID]; 
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
	getClassByID(1) => '#C79C6E',
	2 => '#F58CBA',	// Paladin
	getClassByID(2) => '#F58CBA',
	3 => '#ABD473',	// Hunter
	getClassByID(3) => '#ABD473',
	4 => '#FFF569',	// Rogue
	getClassByID(4) => '#FFF569',
	5 => '#FFFFFF',	// Priest
	getClassByID(5) => '#FFFFFF',
	6 => '#C41F3B',	// DK
	getClassByID(6) => '#C41F3B',
	7 => '#0070DE',	// Shaman
	getClassByID(7) => '#0070DE',
	8 => '#69CCF0',	// Mage
	getClassByID(8) => '#69CCF0',
	9 => '#9482C9',	// Warlock
	getClassByID(9) => '#9482C9',
	11 => '#FF7D0A',	// Druid
	getClassByID(11) =>'#FF7D0A',
	);
	return $ID[$classID];
}
