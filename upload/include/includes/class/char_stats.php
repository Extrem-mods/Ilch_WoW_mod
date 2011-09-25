<?php

defined ('main') or die ( 'no direct access' );

class CharStats extends Api{
  private $_stats = array();
  
  public function __construct($cid){
    $this->_stats['cID'] = $cid;
    }
  
  protected function loadDatasByDb(){
    $result = db_query("SELECT `lastModified` FROM `prefix_chars` WHERE `cID` = {$this->_stats['cID']}");
    if($result = mysql_fetch_array($result) && $result[0] > (time()-$allgAr['wow_reload_time']*60 )){
		$sql = "SELECT * from `prefix_char_stats`  WHERE `cID` = {$this->_stats['cID']}";
		$result = db_query($sql);
		if($result = mysql_fetch_assoc($result)){
			$this->_stats = $result;
			return true;
		}
    }
	return false;	
  }
  /**Daten werden der Funktion uebergeben, nur im Notfall besteht die moeglchkeit sei aus der API zu holen
   *
   */     
	protected function loadDatasByapi($daten = NULL){
		if(!empty($daten['stats'])){
			$daten = $daten['stats'];
			$this->_stats = array(
				'health' =>$daten['health'] ,
				'powerType' =>$daten['powerType'],
				'power' =>$daten['power'] ,
				'str' =>$daten['str'] ,
				'agi' =>$daten['agi'] ,
				'sta' =>$daten['sta'] ,
				'int' =>$daten['int'] ,
				'spr' =>$daten['spr'] ,
				'attackPower' =>$daten['attackPower'] ,
				'rangedAttackPower' =>$daten['rangedAttackPower'] ,
				'mastery' =>$daten['mastery'] ,
				'masteryRating' =>$daten['masteryRating'] ,
				'crit' =>$daten['crit'] ,
				'critRating' =>$daten['critRating'] ,
				'hitRating' =>$daten['hitRating'] ,
				'hasteRating' =>$daten['hasteRating'] ,
				'expertiseRating' =>$daten['expertiseRating'] ,
				'spellPower' =>$daten['spellPower'] ,
				'spellPen' =>$daten['spellPen'] ,
				'spellCrit' =>$daten['spellCrit'] ,
				'spellCritRating' =>$daten['spellCritRating'] ,
				'mana5' =>$daten['mana5'] ,
				'mana5Combat' =>$daten['mana5Combat'] ,
				'armor' =>$daten['armor'] ,
				'dodge' =>$daten['dodge'] ,
				'dodgeRating' =>$daten['dodgeRating'] ,
				'parry' =>$daten['parry'] ,
				'parryRating' =>$daten['parryRating'] ,
				'block' =>$daten['block'] ,
				'blockRating' =>$daten['blockRating'] ,
				'resil' =>$daten['resil'] ,
				'mainHandDmgMin' =>$daten['mainHandDmgMin'] ,
				'mainHandDmgMax' =>$daten['mainHandDmgMax'] ,
				'mainHandSpeed' =>$daten['mainHandSpeed'] ,
				'mainHandDps' =>$daten['mainHandDps'] ,
				'mainHandExpertise' =>$daten['mainHandExpertise'] ,
				'offHandDmgMin' =>$daten['offHandDmgMin'] ,
				'offHandDmgMax' =>$daten['offHandDmgMax'] ,
				'offHandSpeed' =>$daten['offHandSpeed'] ,
				'offHandDps' =>$daten['offHandDps'] ,
				'offHandExpertise' =>$daten['offHandExpertise'] ,
				'rangedDmgMin' =>$daten['rangedDmgMin'] ,
				'rangedDmgMax' =>$daten['rangedDmgMax'] ,
				'rangedSpeed' =>$daten['rangedSpeed'] ,
				'rangedDps' =>$daten['rangedDps'] ,
				'rangedCrit' =>$daten['rangedCrit'] ,
				'rangedCritRating' =>$daten['rangedCritRating'] ,
				'rangedHitRating' =>$daten['rangedHitRating'] 
			);
			return true;
		}
		echo 'try to load stats form API fail';
		return false;	
	}

  
	public function loadDatas($daten= NULL){
		if(!empty($daten) && is_array($daten)){
			$erg = $this->loadDatasByapi($daten);
			if($erg) $erg = $this->saveDatas();
			return $erg;
		}else{
			return $this->loadDatasByDb();
		}    
	}
  
	public function saveDatas(){
	
	}
	public function getAsArray(){
		return $this->_stats;
	}
}